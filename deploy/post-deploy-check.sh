#!/bin/bash
# ============================================================
# Nexify.gr - Post-Deploy Verification
# Εκτέλεσε ΣΤΟΝ HETZNER SERVER μετά την μεταφορά για να
# επαληθεύσεις ότι όλα δουλεύουν σωστά
# ============================================================

DOMAIN="${1:-nexify.gr}"
SITE_DIR="/var/www/nexify"

echo "=============================================="
echo " Post-Deploy Verification: $DOMAIN"
echo "=============================================="

PASS=0
FAIL=0

check() {
    local desc="$1"
    local result="$2"
    if [ "$result" = "ok" ]; then
        echo "  ✅ $desc"
        PASS=$((PASS+1))
    else
        echo "  ❌ $desc: $result"
        FAIL=$((FAIL+1))
    fi
}

# Nginx
if systemctl is-active --quiet nginx; then
    check "Nginx running" "ok"
else
    check "Nginx running" "NOT RUNNING - run: systemctl start nginx"
fi

# PHP-FPM
if systemctl is-active --quiet php8.3-fpm; then
    check "PHP 8.3 FPM running" "ok"
else
    check "PHP 8.3 FPM running" "NOT RUNNING - run: systemctl start php8.3-fpm"
fi

# MySQL
if systemctl is-active --quiet mysql; then
    check "MySQL running" "ok"
else
    check "MySQL running" "NOT RUNNING - run: systemctl start mysql"
fi

# Site directory
if [ -d "$SITE_DIR" ]; then
    check "Site directory exists" "ok"
else
    check "Site directory exists" "MISSING: $SITE_DIR"
fi

# index.php
if [ -f "$SITE_DIR/index.php" ]; then
    check "index.php exists" "ok"
else
    check "index.php exists" "MISSING - transfer not complete?"
fi

# .env
if [ -f "$SITE_DIR/.env" ]; then
    check ".env file exists" "ok"
else
    check ".env file exists" "MISSING - create it!"
fi

# PHP syntax check
if php8.3 -l "$SITE_DIR/index.php" &>/dev/null; then
    check "PHP syntax OK" "ok"
else
    check "PHP syntax OK" "ERRORS found"
fi

# Nginx config test
if nginx -t &>/dev/null; then
    check "Nginx config valid" "ok"
else
    check "Nginx config valid" "ERRORS - run: nginx -t"
fi

# HTTP response
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" "http://$DOMAIN/" 2>/dev/null || echo "000")
if [ "$HTTP_CODE" = "200" ] || [ "$HTTP_CODE" = "301" ] || [ "$HTTP_CODE" = "302" ]; then
    check "HTTP response ($HTTP_CODE)" "ok"
else
    check "HTTP response" "Got $HTTP_CODE (DNS not propagated yet?)"
fi

# SSL check (only if DNS is set)
if [ "$HTTP_CODE" != "000" ]; then
    HTTPS_CODE=$(curl -sk -o /dev/null -w "%{http_code}" "https://$DOMAIN/" 2>/dev/null || echo "000")
    if [ "$HTTPS_CODE" = "200" ]; then
        check "HTTPS/SSL active" "ok"
    else
        check "HTTPS/SSL active" "Got $HTTPS_CODE - Run certbot first"
    fi
fi

# File permissions
OWNER=$(stat -c "%U" "$SITE_DIR" 2>/dev/null || echo "unknown")
if [ "$OWNER" = "www-data" ]; then
    check "File permissions (www-data)" "ok"
else
    check "File permissions" "Owner is $OWNER, run: chown -R www-data:www-data $SITE_DIR"
fi

# Summary
echo ""
echo "=============================================="
echo " Results: $PASS passed, $FAIL failed"
echo "=============================================="

if [ "$FAIL" -eq 0 ]; then
    echo " 🎉 All checks passed! Site is ready!"
else
    echo " ⚠️  Fix the issues above and re-run this script"
fi

echo ""
echo "Recent error logs:"
tail -5 /var/log/nginx/nexify.error.log 2>/dev/null || echo "(no errors)"
