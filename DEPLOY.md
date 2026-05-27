# 🚀 Οδηγός Μεταφοράς Nexify.gr → Hetzner Server

## Επισκόπηση

Το site τρέχει PHP + MySQL και βρίσκεται τώρα σε development server (CodeHero).  
Πρέπει να το μεταφέρεις στον Hetzner server σου και να αλλάξεις τα DNS στο papaki.gr.

---

## 📋 Checklist Βημάτων

- [ ] 1. Προετοιμασία Hetzner Server
- [ ] 2. Μεταφορά αρχείων (rsync)
- [ ] 3. Export/Import Database
- [ ] 4. Nginx configuration
- [ ] 5. SSL Certificate (Let's Encrypt)
- [ ] 6. Αλλαγή DNS στο papaki.gr
- [ ] 7. Τελικός έλεγχος

---

## Βήμα 1: Προετοιμασία Hetzner Server

Συνδέσου στον Hetzner server σου:
```bash
ssh root@YOUR_HETZNER_IP
```

Εγκατάσταση απαραίτητων packages (Ubuntu 22.04/24.04):
```bash
# Ενημέρωση system
apt update && apt upgrade -y

# Εγκατάσταση Nginx, PHP 8.3, MySQL
apt install -y nginx php8.3-fpm php8.3-mysql php8.3-curl php8.3-gd \
  php8.3-mbstring php8.3-xml php8.3-zip php8.3-intl \
  mysql-server certbot python3-certbot-nginx git rsync curl unzip

# Εκκίνηση services
systemctl enable nginx php8.3-fpm mysql
systemctl start nginx php8.3-fpm mysql
```

---

## Βήμα 2: Δημιουργία MySQL Database στο Hetzner

```bash
# Στον Hetzner server:
mysql -u root -p

# Εκτέλεσε τα παρακάτω στο MySQL prompt:
CREATE DATABASE nexify_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'nexify_user'@'localhost' IDENTIFIED BY 'ΔΥΝΑΤΟ_PASSWORD_ΕΔΩ';
GRANT ALL PRIVILEGES ON nexify_db.* TO 'nexify_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## Βήμα 3: Μεταφορά Αρχείων

### Από τον development server (CodeHero) εκτέλεσε:

```bash
# Πρώτα δες το script: deploy/transfer-files.sh
# Ή εκτέλεσε απευθείας:

rsync -avz --progress \
  --exclude='.git' \
  --exclude='.claude' \
  --exclude='.heroagent' \
  --exclude='ticket_files' \
  --exclude='*.html' \
  --exclude='DEPLOY.md' \
  --exclude='QA_REPORT.md' \
  --exclude='README.md' \
  --exclude='VERIFICATION_REPORT.md' \
  --exclude='test_file.txt' \
  --exclude='responsive-preview.php' \
  --exclude='logos partners.pptx' \
  --exclude='indexnewnexify.html' \
  /var/www/projects/nexifynewweb/ \
  root@YOUR_HETZNER_IP:/var/www/nexify/
```

### Ή με SCP (αν δεν έχεις rsync):
```bash
scp -r /var/www/projects/nexifynewweb/ root@YOUR_HETZNER_IP:/var/www/nexify/
```

---

## Βήμα 4: Export/Import Database

### Export από development (αν έχεις δεδομένα):
```bash
# Στο CodeHero development server:
mysqldump -u nexifynewweb_user -p'IC684uwjinsHPZrQ' nexifynewweb_db > /tmp/nexify_backup.sql

# Μεταφορά στο Hetzner:
scp /tmp/nexify_backup.sql root@YOUR_HETZNER_IP:/tmp/
```

### Import στο Hetzner:
```bash
# Στον Hetzner server:
mysql -u nexify_user -p nexify_db < /tmp/nexify_backup.sql
```

---

## Βήμα 5: Nginx Configuration στο Hetzner

Δημιούργησε το config αρχείο:
```bash
nano /etc/nginx/sites-available/nexify.gr
```

Περιεχόμενο (δες το αρχείο `deploy/nginx-nexify.conf`):

```nginx
server {
    listen 80;
    server_name nexify.gr www.nexify.gr;
    root /var/www/nexify;
    index index.php index.html;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

    # Gzip compression
    gzip on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml;
    gzip_vary on;

    # PHP handling
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_read_timeout 300;
    }

    # Static files caching
    location ~* \.(jpg|jpeg|png|gif|ico|svg|webp|woff|woff2|ttf|css|js|mp4)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
        access_log off;
    }

    # Block hidden files
    location ~ /\. {
        deny all;
        access_log off;
    }

    # Block sensitive files
    location ~* \.(sql|log|env|git)$ {
        deny all;
    }

    # Max upload size (για videos)
    client_max_body_size 50M;

    access_log /var/log/nginx/nexify.access.log;
    error_log /var/log/nginx/nexify.error.log;
}
```

Ενεργοποίηση:
```bash
ln -s /etc/nginx/sites-available/nexify.gr /etc/nginx/sites-enabled/
nginx -t
systemctl reload nginx
```

---

## Βήμα 6: SSL Certificate (Let's Encrypt - ΔΩΡΕΑΝ)

**ΣΗΜΑΝΤΙΚΟ:** Πρέπει πρώτα να αλλάξεις τα DNS (Βήμα 7) και να περιμένεις 15-60 λεπτά propagation.

```bash
# Μόλις τα DNS δείχνουν στο Hetzner:
certbot --nginx -d nexify.gr -d www.nexify.gr \
  --email info@nexify.gr \
  --agree-tos \
  --no-eff-email

# Αυτόματη ανανέωση (ήδη ρυθμισμένη από certbot)
certbot renew --dry-run
```

---

## Βήμα 7: Αλλαγή DNS στο papaki.gr

### Πού να πας:
1. Μπες στο papaki.gr → My Account → Domain Management → nexify.gr
2. Βρες την επιλογή **DNS Management** ή **DNS Records**
3. Άλλαξε τα παρακάτω records:

| Type | Name | Value | TTL |
|------|------|-------|-----|
| A | @ (ή nexify.gr) | `YOUR_HETZNER_IP` | 3600 |
| A | www | `YOUR_HETZNER_IP` | 3600 |
| CNAME | mail | nexify.gr | 3600 |

### Εύρεση Hetzner IP:
```bash
# Στον Hetzner server:
curl -4 ifconfig.me
# ή
hostname -I
```

### ⚠️ Σημαντικό για papaki.gr Website Builder:
- Θα πρέπει να **απενεργοποιήσεις** ή να αποσυνδέσεις το website builder
- Μπορεί να χρειαστεί να **αφαιρέσεις** τα παρόντα A records που δείχνουν στο papaki
- **ΜΗΝ** διαγράψεις MX records αν έχεις email στο papaki (π.χ. info@nexify.gr)
- Άλλαξε ΜΟΝΟ τα A records

### Propagation Time:
- Τυπικά: 15-60 λεπτά για papaki.gr
- Μπορεί να φτάσει μέχρι 24-48 ώρες σε ακραίες περιπτώσεις
- Έλεγξε στο: https://dnschecker.org/#A/nexify.gr

---

## Βήμα 8: Ρύθμιση File Permissions στο Hetzner

```bash
# Στον Hetzner server:
chown -R www-data:www-data /var/www/nexify/
chmod -R 755 /var/www/nexify/
chmod -R 644 /var/www/nexify/*.php
chmod -R 644 /var/www/nexify/*.css

# Για uploads folder (αν υπάρχει):
chmod -R 775 /var/www/nexify/uploads/
```

---

## Βήμα 9: Δημιουργία .env για Hetzner

Στον Hetzner, φτιάξε το αρχείο:
```bash
nano /var/www/nexify/.env
```

Περιεχόμενο:
```env
# Database
DB_HOST=localhost
DB_NAME=nexify_db
DB_USER=nexify_user
DB_PASS=ΔΥΝΑΤΟ_PASSWORD_ΕΔΩ

# Site
APP_ENV=production
APP_URL=https://nexify.gr
APP_DEBUG=false

# Email (αν χρησιμοποιείς SMTP)
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@nexify.gr
MAIL_PASSWORD=YOUR_APP_PASSWORD
```

Προστασία του .env:
```bash
chmod 600 /var/www/nexify/.env
chown www-data:www-data /var/www/nexify/.env
```

---

## Βήμα 10: Τελικός Έλεγχος

```bash
# Έλεγξε ότι το Nginx τρέχει:
systemctl status nginx

# Έλεγξε logs για errors:
tail -f /var/log/nginx/nexify.error.log

# Test PHP:
php8.3 -v

# Test MySQL connection:
mysql -u nexify_user -p nexify_db -e "SHOW TABLES;"
```

### Έλεγξε URLs:
- http://nexify.gr → πρέπει να ανακατευθύνει στο https://
- https://nexify.gr → πρέπει να φορτώνει σωστά
- https://www.nexify.gr → πρέπει να ανακατευθύνει στο https://nexify.gr

---

## 📧 Email (ΠΡΟΣΟΧΗ!)

Αν έχεις email @nexify.gr μέσω papaki.gr:
- **ΜΗΝ αλλάξεις** τα MX records
- Άλλαξε ΜΟΝΟ τα A records για το site
- Τα email θα συνεχίσουν να λειτουργούν κανονικά μέσω papaki

---

## 🆘 Αντιμετώπιση Προβλημάτων

### Site δεν φορτώνει μετά την αλλαγή DNS:
```bash
# Ελέγξε αν τα DNS propagated:
nslookup nexify.gr
dig nexify.gr A

# Ελέγξε Nginx:
systemctl status nginx
tail -50 /var/log/nginx/nexify.error.log
```

### PHP errors:
```bash
tail -50 /var/log/php8.3-fpm.log
```

### SSL error:
```bash
certbot certificates
certbot renew --force-renewal
```

---

## 📞 Support

Αν χρειαστείς βοήθεια:
- Hetzner Support: https://www.hetzner.com/support
- Let's Encrypt: https://community.letsencrypt.org
- papaki.gr Support: https://www.papaki.gr/support
