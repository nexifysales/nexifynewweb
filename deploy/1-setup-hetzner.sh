#!/bin/bash
# ============================================================
# NEXIFY.GR — ΒΗΜΑ 1: Εγκατάσταση Server (Hetzner)
# ============================================================
# Εκτέλεσε ΣΤΟΝ HETZNER SERVER ως root:
#   bash 1-setup-hetzner.sh
#
# ΤΙ ΚΑΝΕΙ:
#   - Εγκαθιστά Nginx + PHP 8.3-FPM
#   - Εγκαθιστά MySQL (για chatbot logging στο μέλλον)
#   - Ρυθμίζει Nginx για nexify.gr
#   - Ρυθμίζει Firewall (UFW)
#   - Εγκαθιστά Certbot για SSL
# ============================================================

set -e  # Σταμάτα αν υπάρξει error

DOMAIN="nexify.gr"
SITE_DIR="/var/www/nexify"
EMAIL="info@nexify.gr"

# ─────────────────────────────────────────
# Χρώματα για output
# ─────────────────────────────────────────
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

info()    { echo -e "${BLUE}[INFO]${NC} $1"; }
success() { echo -e "${GREEN}[OK]${NC} $1"; }
warn()    { echo -e "${YELLOW}[WARN]${NC} $1"; }
error()   { echo -e "${RED}[ERROR]${NC} $1"; exit 1; }

# ─────────────────────────────────────────
# Έλεγχος: τρέχει ως root;
# ─────────────────────────────────────────
if [ "$EUID" -ne 0 ]; then
    error "Τρέξε ως root: sudo bash 1-setup-hetzner.sh"
fi

# Βρες το IP του server
SERVER_IP=$(curl -4 -s ifconfig.me 2>/dev/null || hostname -I | awk '{print $1}')

echo ""
echo "=============================================="
echo " NEXIFY.GR — Hetzner Server Setup"
echo "=============================================="
echo ""
echo " Domain:     $DOMAIN"
echo " Site dir:   $SITE_DIR"
echo " Server IP:  $SERVER_IP"
echo " PHP:        8.3-FPM"
echo ""
echo "=============================================="
echo ""
echo "Πάτα ENTER για να ξεκινήσεις ή Ctrl+C για ακύρωση..."
read -r

# ─────────────────────────────────────────
# 1. Update system
# ─────────────────────────────────────────
info "Βήμα 1/7: Ενημέρωση system packages..."
apt update -qq
apt upgrade -y -qq
success "System updated"

# ─────────────────────────────────────────
# 2. Install Nginx + PHP 8.3
# ─────────────────────────────────────────
info "Βήμα 2/7: Εγκατάσταση Nginx + PHP 8.3..."
apt install -y \
    nginx \
    php8.3-fpm \
    php8.3-curl \
    php8.3-gd \
    php8.3-mbstring \
    php8.3-xml \
    php8.3-zip \
    php8.3-intl \
    php8.3-bcmath \
    php8.3-json \
    certbot \
    python3-certbot-nginx \
    rsync \
    curl \
    unzip \
    ufw \
    fail2ban \
    -qq

success "Nginx + PHP 8.3 εγκαταστάθηκαν"

# MySQL (optional - για chatbot logging στο μέλλον)
info "Εγκατάσταση MySQL..."
apt install -y mysql-server php8.3-mysql -qq
success "MySQL εγκαταστάθηκε"

# ─────────────────────────────────────────
# 3. Δημιουργία site directory
# ─────────────────────────────────────────
info "Βήμα 3/7: Δημιουργία /var/www/nexify..."
mkdir -p "$SITE_DIR"
chown -R www-data:www-data "$SITE_DIR"
chmod 755 "$SITE_DIR"
success "Site directory: $SITE_DIR"

# ─────────────────────────────────────────
# 4. Nginx Configuration
# ─────────────────────────────────────────
info "Βήμα 4/7: Ρύθμιση Nginx..."

cat > /etc/nginx/sites-available/$DOMAIN << 'NGINXCONF'
# ============================================================
# Nginx config για nexify.gr
# ============================================================

# HTTP → HTTPS redirect
server {
    listen 80;
    listen [::]:80;
    server_name nexify.gr www.nexify.gr;

    # Let's Encrypt challenge
    location /.well-known/acme-challenge/ {
        root /var/www/nexify;
        allow all;
    }

    # Redirect to HTTPS
    location / {
        return 301 https://nexify.gr$request_uri;
    }
}

# www HTTPS → non-www HTTPS
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name www.nexify.gr;

    ssl_certificate /etc/letsencrypt/live/nexify.gr/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/nexify.gr/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;

    return 301 https://nexify.gr$request_uri;
}

# Main HTTPS server
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name nexify.gr;

    root /var/www/nexify;
    index index.php index.html;

    # SSL (Certbot θα τα συμπληρώσει αυτόματα)
    ssl_certificate /etc/letsencrypt/live/nexify.gr/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/nexify.gr/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    add_header Permissions-Policy "camera=(), microphone=(), geolocation=()" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;

    # Gzip Compression
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types
        text/plain text/css text/xml text/javascript
        application/javascript application/json
        application/xml+rss image/svg+xml;

    # Large file support (videos)
    client_max_body_size 100M;
    client_body_timeout 300s;

    # PHP Processing
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_read_timeout 300;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
    }

    # Static files - long cache
    location ~* \.(jpg|jpeg|png|gif|ico|svg|webp|woff|woff2|ttf|eot|PNG|SVG)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
        access_log off;
    }

    location ~* \.(css|js)$ {
        expires 7d;
        add_header Cache-Control "public";
        access_log off;
    }

    # MP4 videos - range requests (για video player)
    location ~* \.mp4$ {
        add_header Accept-Ranges bytes;
        add_header Cache-Control "public, max-age=604800";
        mp4;
        mp4_buffer_size 1m;
        mp4_max_buffer_size 5m;
        access_log off;
    }

    # PDF files
    location ~* \.pdf$ {
        add_header Cache-Control "public, max-age=86400";
        add_header Content-Disposition "inline";
    }

    # Security - Block dev/sensitive files
    location ~ /\. {
        deny all;
        access_log off;
        log_not_found off;
    }

    # Block access to deploy folder
    location ~* ^/deploy {
        deny all;
        return 404;
    }

    # Block sensitive file extensions
    location ~* \.(sql|log|env|sh|bak|md)$ {
        deny all;
        access_log off;
        log_not_found off;
    }

    # Block dev-only files
    location ~* (responsive-preview|ticket_files|test_file) {
        deny all;
        return 404;
    }

    # Main location
    location / {
        try_files $uri $uri/ $uri.php =404;
    }

    # Custom 404
    error_page 404 /index.php;

    # Logs
    access_log /var/log/nginx/nexify.access.log;
    error_log  /var/log/nginx/nexify.error.log warn;
}
NGINXCONF

# Enable site, disable default
ln -sf /etc/nginx/sites-available/$DOMAIN /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Test nginx config
nginx -t && success "Nginx config OK" || error "Nginx config ERROR"

# ─────────────────────────────────────────
# 5. PHP 8.3 Optimization
# ─────────────────────────────────────────
info "Βήμα 5/7: Ρύθμιση PHP 8.3..."
PHP_INI="/etc/php/8.3/fpm/php.ini"

sed -i 's/upload_max_filesize = .*/upload_max_filesize = 100M/' $PHP_INI
sed -i 's/post_max_size = .*/post_max_size = 100M/' $PHP_INI
sed -i 's/memory_limit = .*/memory_limit = 256M/' $PHP_INI
sed -i 's/max_execution_time = .*/max_execution_time = 300/' $PHP_INI
sed -i 's/;date.timezone.*/date.timezone = Europe\/Athens/' $PHP_INI

# PHP-FPM pool settings
PHP_FPM="/etc/php/8.3/fpm/pool.d/www.conf"
sed -i 's/pm = dynamic/pm = dynamic/' $PHP_FPM
sed -i 's/pm.max_children = .*/pm.max_children = 20/' $PHP_FPM
sed -i 's/pm.start_servers = .*/pm.start_servers = 4/' $PHP_FPM
sed -i 's/pm.min_spare_servers = .*/pm.min_spare_servers = 2/' $PHP_FPM
sed -i 's/pm.max_spare_servers = .*/pm.max_spare_servers = 8/' $PHP_FPM

systemctl restart php8.3-fpm
success "PHP 8.3 configured"

# ─────────────────────────────────────────
# 6. Firewall
# ─────────────────────────────────────────
info "Βήμα 6/7: Ρύθμιση Firewall..."
ufw --force reset -qq
ufw default deny incoming
ufw default allow outgoing
ufw allow OpenSSH
ufw allow 'Nginx Full'
ufw --force enable
success "Firewall: SSH + HTTP/HTTPS allowed"

# ─────────────────────────────────────────
# 7. Fail2ban (brute force protection)
# ─────────────────────────────────────────
info "Βήμα 7/7: Ρύθμιση Fail2ban..."
systemctl enable fail2ban
systemctl start fail2ban
success "Fail2ban enabled"

# Start Nginx
systemctl enable nginx
systemctl start nginx

# ─────────────────────────────────────────
# Δημιουργία test page
# ─────────────────────────────────────────
cat > "$SITE_DIR/test.php" << 'TESTPHP'
<?php
echo "<h1>✅ NexiFy Server OK!</h1>";
echo "<p>PHP: " . phpversion() . "</p>";
echo "<p>Server: " . $_SERVER['SERVER_NAME'] . "</p>";
echo "<p>Time: " . date('d/m/Y H:i:s') . "</p>";
phpinfo();
TESTPHP

chown www-data:www-data "$SITE_DIR/test.php"

# ─────────────────────────────────────────
# Σύνοψη
# ─────────────────────────────────────────
echo ""
echo "=============================================="
echo -e " ${GREEN}✅ ΕΓΚΑΤΑΣΤΑΣΗ ΟΛΟΚΛΗΡΩΘΗΚΕ!${NC}"
echo "=============================================="
echo ""
echo " Server IP: $SERVER_IP"
echo ""
echo "ΕΠΟΜΕΝΑ ΒΗΜΑΤΑ:"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "ΒΗΜΑ 2: Μεταφορά αρχείων (από development)"
echo "  bash 2-upload-files.sh $SERVER_IP"
echo ""
echo "ΒΗΜΑ 3: Αλλαγή DNS στο Cloudflare"
echo "  Πρόσθεσε A record: nexify.gr → $SERVER_IP"
echo "  Πρόσθεσε A record: www → $SERVER_IP"
echo "  (Orange cloud → απενεργοποίησε proxy για τώρα)"
echo ""
echo "ΒΗΜΑ 4: SSL Certificate (ΜΕΤΑ το DNS propagation)"
echo "  certbot --nginx -d nexify.gr -d www.nexify.gr \\"
echo "    --email $EMAIL --agree-tos --non-interactive"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo " Test page: http://$SERVER_IP/test.php"
echo ""
