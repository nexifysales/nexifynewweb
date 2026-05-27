#!/bin/bash
# ============================================================
# NEXIFY.GR — ΒΗΜΑ 3: SSL Certificate (Let's Encrypt)
# ============================================================
# Τρέξε ΣΤΟΝ HETZNER SERVER ως root:
#   bash 3-ssl.sh
#
# ΠΡΟΑΠΑΙΤΟΥΜΕΝΟ:
#   Τα DNS να έχουν αλλάξει (A record → Hetzner IP)
#   Verification: nslookup nexify.gr → πρέπει να δείχνει το Hetzner IP
# ============================================================

set -e

DOMAIN="nexify.gr"
EMAIL="info@nexify.gr"

GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m'

echo ""
echo "=============================================="
echo " NEXIFY.GR — SSL Certificate Setup"
echo "=============================================="
echo ""

# ─────────────────────────────────────────
# Έλεγχος: DNS propagation
# ─────────────────────────────────────────
MY_IP=$(curl -4 -s ifconfig.me)
DNS_IP=$(dig +short nexify.gr A | tail -1)

echo " Server IP:  $MY_IP"
echo " DNS points: $DNS_IP"
echo ""

if [ "$MY_IP" != "$DNS_IP" ]; then
    echo -e "${RED}❌ DNS ΔΕΝ έχει ακόμα αλλάξει!${NC}"
    echo ""
    echo "Το nexify.gr δείχνει σε: $DNS_IP"
    echo "Αλλά αυτός ο server είναι: $MY_IP"
    echo ""
    echo "Περίμενε να γίνει DNS propagation και τρέξε ξανά."
    echo "Συνήθως 5-30 λεπτά μετά την αλλαγή στο Cloudflare."
    echo ""
    echo "Έλεγχος: nslookup nexify.gr"
    echo ""
    exit 1
fi

echo -e "${GREEN}✅ DNS OK - nexify.gr → $MY_IP${NC}"
echo ""
echo "Πάτα ENTER για να ξεκινήσει η έκδοση SSL..."
read -r

# ─────────────────────────────────────────
# Certbot SSL
# ─────────────────────────────────────────
echo -e "${BLUE}[INFO]${NC} Εκδίδω SSL certificate..."

certbot --nginx \
    -d "$DOMAIN" \
    -d "www.$DOMAIN" \
    --email "$EMAIL" \
    --agree-tos \
    --non-interactive \
    --redirect

echo ""
echo -e "${GREEN}✅ SSL Certificate εκδόθηκε!${NC}"

# ─────────────────────────────────────────
# Auto-renew test
# ─────────────────────────────────────────
echo -e "${BLUE}[INFO]${NC} Test auto-renewal..."
certbot renew --dry-run
echo -e "${GREEN}✅ Auto-renewal λειτουργεί${NC}"

# ─────────────────────────────────────────
# Reload Nginx
# ─────────────────────────────────────────
systemctl reload nginx
echo -e "${GREEN}✅ Nginx reloaded${NC}"

# ─────────────────────────────────────────
# Ενεργοποίηση Cloudflare Proxy (optional)
# ─────────────────────────────────────────
echo ""
echo "=============================================="
echo -e " ${GREEN}✅ SSL ΟΛΟΚΛΗΡΩΘΗΚΕ!${NC}"
echo "=============================================="
echo ""
echo " Site URL: https://nexify.gr"
echo ""
echo "ΤΩΡΑ ΜΠΟΡΕΙΣ (optional):"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "Ενεργοποίηση Cloudflare Proxy (orange cloud):"
echo "  - Πήγαινε: https://dash.cloudflare.com"
echo "  - DNS → Άλλαξε τα A records σε Proxied"
echo "  - Αυτό δίνει CDN + DDoS protection"
echo "  - SSL Mode: Full (strict)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# ─────────────────────────────────────────
# Final check
# ─────────────────────────────────────────
echo -e "${BLUE}[INFO]${NC} Final checks..."
echo ""
echo "SSL Certificate:"
certbot certificates | grep -A 3 "nexify.gr" || true
echo ""
echo "Nginx status:"
systemctl is-active nginx
echo ""
echo "PHP status:"
systemctl is-active php8.3-fpm
echo ""
echo -e "${GREEN}🎉 Το nexify.gr είναι LIVE!${NC}"
echo ""
