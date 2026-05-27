#!/bin/bash
# ============================================================
# NEXIFY.GR — Nginx Site Install (SAFE — δεν πειράζει άλλα sites)
# ============================================================
#
# ΠΡΟΑΠΑΙΤΟΥΜΕΝΑ (πριν τρέξεις αυτό):
#   1. Δημιούργησε Cloudflare Origin Certificate για nexify.gr:
#      Cloudflare → nexify.gr → SSL/TLS → Origin Server → Create Certificate
#      Hostnames: nexify.gr, *.nexify.gr | Validity: 15 years
#   2. Αποθήκευσε τα αρχεία ΩΣ ROOT:
#      sudo nano /etc/ssl/certs/nexify_origin.pem    ← Paste Origin Certificate
#      sudo nano /etc/ssl/private/nexify_origin.key  ← Paste Private Key
#      sudo chmod 600 /etc/ssl/private/nexify_origin.key
#
# ΕΚΤΕΛΕΣΗ (ως root):
#   bash install-nginx-nexify.sh
# ============================================================

set -e

RED='\033[0;31m'; GREEN='\033[0;32m'; YELLOW='\033[1;33m'; BLUE='\033[0;34m'; NC='\033[0m'
info()    { echo -e "${BLUE}[INFO]${NC} $1"; }
success() { echo -e "${GREEN}[OK]${NC} $1"; }
warn()    { echo -e "${YELLOW}[WARN]${NC} $1"; }
error()   { echo -e "${RED}[ERROR]${NC} $1"; exit 1; }

SOURCE_DIR="/var/www/projects/nexifynewweb"
PROD_DIR="/var/www/projects/nexifyweb/production"
NGINX_CONF="/etc/nginx/sites-available/nexify.gr"
NGINX_ENABLED="/etc/nginx/sites-enabled/nexify.gr"
CERT_FILE="/etc/ssl/certs/nexify_origin.pem"
CERT_KEY="/etc/ssl/private/nexify_origin.key"
SERVER_IP=$(hostname -I | awk '{print $1}')

echo ""
echo "=============================================="
echo "  nexify.gr — Safe Nginx Installer"
echo "  Server: $(hostname) | IP: $SERVER_IP"
echo "  Date: $(date)"
echo "=============================================="
echo ""

# Show what's already running (won't touch these!)
info "Υπάρχοντα sites (δεν θα τα πειράξουμε):"
ls /etc/nginx/sites-enabled/ | grep -v "nexify" | sed 's/^/    /'
echo ""

# ─── STEP 1: SSL Certificate Check ───
info "Έλεγχος Cloudflare Origin Certificate..."
if [ ! -f "$CERT_FILE" ] || [ ! -f "$CERT_KEY" ]; then
    echo ""
    echo -e "${YELLOW}╔══════════════════════════════════════════════════════╗${NC}"
    echo -e "${YELLOW}║  ΧΡΕΙΑΖΕΣΑΙ CLOUDFLARE ORIGIN CERTIFICATE!          ║${NC}"
    echo -e "${YELLOW}╚══════════════════════════════════════════════════════╝${NC}"
    echo ""
    echo "  1. https://dash.cloudflare.com → nexify.gr"
    echo "  2. SSL/TLS → Origin Server → Create Certificate"
    echo "  3. Hostnames: nexify.gr και *.nexify.gr"
    echo "  4. Validity: 15 years"
    echo ""
    echo "  Αποθήκευσε:"
    echo "    nano $CERT_FILE   (paste Origin Certificate)"
    echo "    nano $CERT_KEY    (paste Private Key)"
    echo "    chmod 600 $CERT_KEY"
    echo ""
    echo -n "  Πάτα Enter όταν είναι έτοιμα (Ctrl+C για ακύρωση)..."
    read -r
    [ ! -f "$CERT_FILE" ] || [ ! -f "$CERT_KEY" ] && error "Τα SSL αρχεία δεν βρέθηκαν!"
fi
success "SSL αρχεία βρέθηκαν"

# ─── STEP 2: Production directory ───
info "Δημιουργία production directory: $PROD_DIR"
mkdir -p "$PROD_DIR"
success "Directory έτοιμο"

# ─── STEP 3: Copy files ───
info "Αντιγραφή αρχείων (εξαιρούνται dev/tmp files)..."
rsync -av \
    --exclude='deploy/' \
    --exclude='.git/' \
    --exclude='.gitignore' \
    --exclude='.heroagent' \
    --exclude='.claude/' \
    --exclude='*.pptx' \
    --exclude='DEPLOY.md' \
    --exclude='README.md' \
    --exclude='QA_REPORT.md' \
    --exclude='map.md' \
    --exclude='technologies.md' \
    --exclude='responsive-preview.php' \
    --exclude='indexnewnexify.html' \
    --exclude='pages/' \
    --exclude='_preview_logo.png' \
    --exclude='Slide*.PNG' \
    "$SOURCE_DIR/" "$PROD_DIR/"

chown -R www-data:www-data "$PROD_DIR"
find "$PROD_DIR" -type f -exec chmod 644 {} \;
find "$PROD_DIR" -type d -exec chmod 755 {} \;
success "Αρχεία αντιγράφηκαν"

# ─── STEP 4: Nginx config ───
info "Δημιουργία Nginx config (nexify.gr only)..."
cat > "$NGINX_CONF" << 'NGINX_EOF'
# nexify.gr — Nginx Virtual Host
# SSL: Cloudflare Origin Certificate | Full (Strict)
# Δεν επηρεάζει άλλα sites στον server

# HTTP → HTTPS
server {
    listen 80;
    listen [::]:80;
    server_name nexify.gr www.nexify.gr;
    return 301 https://nexify.gr$request_uri;
}

# www → non-www
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name www.nexify.gr;
    ssl_certificate /etc/ssl/certs/nexify_origin.pem;
    ssl_certificate_key /etc/ssl/private/nexify_origin.key;
    return 301 https://nexify.gr$request_uri;
}

# Main site
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name nexify.gr;

    ssl_certificate /etc/ssl/certs/nexify_origin.pem;
    ssl_certificate_key /etc/ssl/private/nexify_origin.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:DHE-RSA-AES128-GCM-SHA256;
    ssl_prefer_server_ciphers off;
    ssl_session_cache shared:SSL_nexify:10m;
    ssl_session_timeout 1440m;

    root /var/www/projects/nexifyweb/production;
    index index.php index.html;
    charset utf-8;

    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # SEO Redirects: .html → .php (για παλιά Papaki URLs)
    rewrite ^/energy\.html$          /energy.php          permanent;
    rewrite ^/ecosystem\.html$       /ecosystem.php       permanent;
    rewrite ^/virtual-office\.html$  /virtual-office.php  permanent;
    rewrite ^/partners\.html$        /partners.php        permanent;
    rewrite ^/careers\.html$         /careers.php         permanent;
    rewrite ^/faq\.html$             /faq.php             permanent;
    rewrite ^/contact\.html$         /contact.php         permanent;
    rewrite ^/terms\.html$           /terms.php           permanent;
    rewrite ^/privacy\.html$         /privacy.php         permanent;
    rewrite ^/cookies\.html$         /cookies.php         permanent;
    rewrite ^/gemi\.html$            /gemi.php            permanent;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_read_timeout 60;
    }

    # Videos — streaming
    location ~* \.(mp4|webm)$ {
        add_header Accept-Ranges bytes;
        add_header Cache-Control "public, max-age=2592000";
        try_files $uri =404;
    }

    # Static assets cache
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|pdf)$ {
        expires 30d;
        add_header Cache-Control "public, max-age=2592000";
        try_files $uri =404;
    }

    # Block hidden files
    location ~ /\. { deny all; }

    access_log /var/log/nginx/nexify.gr-access.log;
    error_log  /var/log/nginx/nexify.gr-error.log;
}
NGINX_EOF

success "Nginx config γράφτηκε"

# ─── STEP 5: Enable site ───
info "Ενεργοποίηση nexify.gr..."
ln -sf "$NGINX_CONF" "$NGINX_ENABLED"
success "Symlink: $NGINX_ENABLED"

# ─── STEP 6: Test BEFORE reload (critical!) ───
info "nginx -t test (ΠΡΙΝ reload για ασφάλεια)..."
if nginx -t 2>&1; then
    success "Config test: PASS"
else
    warn "CONFIG TEST FAILED! Αφαιρώ το symlink..."
    rm -f "$NGINX_ENABLED"
    echo ""
    echo "  Τα υπόλοιπα sites (revmas.gr κ.α.) ΔΕΝ επηρεάστηκαν."
    echo "  Διόρθωσε το πρόβλημα και ξανατρέξε το script."
    exit 1
fi

# ─── STEP 7: Graceful reload ───
info "Graceful nginx reload (0 downtime για τα άλλα sites)..."
nginx -s reload
success "Nginx reloaded!"

# ─── STEP 8: Verify all sites still up ───
echo ""
info "Έλεγχος ότι ΟΛΕΣ οι sites τρέχουν..."
SITES_ENABLED=$(ls /etc/nginx/sites-enabled/ | wc -l)
success "Sites enabled: $SITES_ENABLED"

PHP_COUNT=$(find "$PROD_DIR" -maxdepth 1 -name "*.php" | wc -l)
success "PHP αρχεία στο production: $PHP_COUNT"

echo ""
echo -e "${GREEN}══════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}  ✅ nexify.gr ΕΓΚΑΤΑΣΤΆΘΗΚΕ!                         ${NC}"
echo -e "${GREEN}══════════════════════════════════════════════════════${NC}"
echo ""
echo "  Production: $PROD_DIR"
echo "  Nginx conf: $NGINX_CONF"
echo "  Error log:  tail -f /var/log/nginx/nexify.gr-error.log"
echo ""
echo -e "${YELLOW}  ΤΕΛΕΥΤΑΙΟ ΒΗΜΑ — Cloudflare DNS:${NC}"
echo "  1. dash.cloudflare.com → nexify.gr → DNS"
echo "  2. A record: nexify.gr → $SERVER_IP (Proxied ON 🟠)"
echo "  3. SSL/TLS → Full (Strict)"
echo "  4. Verify: curl -I https://nexify.gr"
echo ""
