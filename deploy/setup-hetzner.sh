#!/bin/bash
# ============================================================
# Nexify.gr - Hetzner Server Setup Script
# Εκτέλεσε ΣΤΟΝ HETZNER SERVER ως root:
#   bash setup-hetzner.sh
# ============================================================

set -e  # Stop on error

# ─────────────────────────────────────────
# ΡΥΘΜΙΣΕ ΑΥΤΕΣ ΤΙΣ ΤΙΜΕΣ ΠΡΙΝ ΤΡΕΞΕΙΣ!
# ─────────────────────────────────────────
DOMAIN="nexify.gr"
SITE_DIR="/var/www/nexify"
DB_NAME="nexify_db"
DB_USER="nexify_user"
DB_PASS="$(openssl rand -base64 20)"  # Δημιουργεί τυχαίο password
EMAIL="info@nexify.gr"

echo "=============================================="
echo " Nexify.gr - Hetzner Setup"
echo "=============================================="
echo ""
echo "Domain:    $DOMAIN"
echo "Site dir:  $SITE_DIR"
echo "DB Name:   $DB_NAME"
echo "DB User:   $DB_USER"
echo "DB Pass:   $DB_PASS   ← ΣΩΣΕ ΑΥΤΟ!"
echo ""
echo "Πάτα Enter για να συνεχίσεις ή Ctrl+C για ακύρωση..."
read

# ─────────────────────────────────────────
# 1. Update system
# ─────────────────────────────────────────
echo "[1/8] Updating system..."
apt update && apt upgrade -y

# ─────────────────────────────────────────
# 2. Install packages
# ─────────────────────────────────────────
echo "[2/8] Installing Nginx, PHP 8.3, MySQL..."
apt install -y \
    nginx \
    php8.3-fpm \
    php8.3-mysql \
    php8.3-curl \
    php8.3-gd \
    php8.3-mbstring \
    php8.3-xml \
    php8.3-zip \
    php8.3-intl \
    php8.3-bcmath \
    mysql-server \
    certbot \
    python3-certbot-nginx \
    git \
    rsync \
    curl \
    unzip \
    ufw \
    fail2ban

# ─────────────────────────────────────────
# 3. Configure Firewall
# ─────────────────────────────────────────
echo "[3/8] Configuring firewall..."
ufw allow OpenSSH
ufw allow 'Nginx Full'
ufw --force enable

# ─────────────────────────────────────────
# 4. Create site directory
# ─────────────────────────────────────────
echo "[4/8] Creating site directory..."
mkdir -p "$SITE_DIR"
chown www-data:www-data "$SITE_DIR"

# ─────────────────────────────────────────
# 5. Setup MySQL Database
# ─────────────────────────────────────────
echo "[5/8] Setting up MySQL database..."
mysql -u root << SQL
CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS '$DB_USER'@'localhost'
  IDENTIFIED BY '$DB_PASS';

GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
SQL

echo "✅ Database created: $DB_NAME"

# ─────────────────────────────────────────
# 6. Create Nginx config
# ─────────────────────────────────────────
echo "[6/8] Creating Nginx configuration..."
cat > /etc/nginx/sites-available/$DOMAIN << 'NGINX'
server {
    listen 80;
    listen [::]:80;
    server_name nexify.gr www.nexify.gr;
    root /var/www/nexify;
    index index.php index.html;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Gzip
    gzip on;
    gzip_vary on;
    gzip_types text/plain text/css application/javascript application/json image/svg+xml;

    # Large files (videos)
    client_max_body_size 100M;

    # PHP
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_read_timeout 300;
    }

    # Static files cache
    location ~* \.(jpg|jpeg|png|gif|ico|svg|webp|woff|woff2|css|js)$ {
        expires 30d;
        add_header Cache-Control "public";
        access_log off;
    }

    # MP4 support
    location ~* \.mp4$ {
        add_header Accept-Ranges bytes;
        mp4;
    }

    # Security - block sensitive
    location ~ /\. { deny all; }
    location ~* \.(sql|log|env|sh|md)$ { deny all; }
    location ~* (deploy|ticket_files) { deny all; }

    location / {
        try_files $uri $uri/ $uri.php =404;
    }

    access_log /var/log/nginx/nexify.access.log;
    error_log /var/log/nginx/nexify.error.log;
}
NGINX

# Enable site
ln -sf /etc/nginx/sites-available/$DOMAIN /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Test and reload
nginx -t && systemctl reload nginx
echo "✅ Nginx configured"

# ─────────────────────────────────────────
# 7. Configure PHP
# ─────────────────────────────────────────
echo "[7/8] Optimizing PHP settings..."
PHP_INI="/etc/php/8.3/fpm/php.ini"
sed -i 's/upload_max_filesize = .*/upload_max_filesize = 50M/' $PHP_INI
sed -i 's/post_max_size = .*/post_max_size = 50M/' $PHP_INI
sed -i 's/memory_limit = .*/memory_limit = 256M/' $PHP_INI
sed -i 's/max_execution_time = .*/max_execution_time = 300/' $PHP_INI
sed -i 's/;date.timezone.*/date.timezone = Europe\/Athens/' $PHP_INI

systemctl restart php8.3-fpm

# ─────────────────────────────────────────
# 8. Create .env file
# ─────────────────────────────────────────
echo "[8/8] Creating .env file..."
cat > "$SITE_DIR/.env" << ENV
# Nexify.gr - Production Environment
DB_HOST=localhost
DB_NAME=$DB_NAME
DB_USER=$DB_USER
DB_PASS=$DB_PASS
APP_ENV=production
APP_URL=https://$DOMAIN
APP_DEBUG=false
ENV

chmod 600 "$SITE_DIR/.env"
chown www-data:www-data "$SITE_DIR/.env"

# ─────────────────────────────────────────
# Done!
# ─────────────────────────────────────────
echo ""
echo "=============================================="
echo " ✅ ΕΓΚΑΤΑΣΤΑΣΗ ΟΛΟΚΛΗΡΩΘΗΚΕ!"
echo "=============================================="
echo ""
echo "Επόμενα βήματα:"
echo ""
echo "1. Μεταφορά αρχείων από development:"
echo "   rsync -avz user@dev-server:/var/www/projects/nexifynewweb/ /var/www/nexify/"
echo ""
echo "2. Αλλαγή DNS στο papaki.gr:"
echo "   A record nexify.gr → $(curl -4 -s ifconfig.me)"
echo "   A record www → $(curl -4 -s ifconfig.me)"
echo ""
echo "3. Μόλις propagate τα DNS, τρέξε SSL:"
echo "   certbot --nginx -d nexify.gr -d www.nexify.gr --email $EMAIL --agree-tos --no-eff-email"
echo ""
echo "⚠️  Database Password: $DB_PASS"
echo "     Σώσε αυτό σε ασφαλές μέρος!"
echo ""
