# 🚀 NEXIFY.GR — Οδηγίες Deployment στο Hetzner

## Σύνοψη

| Βήμα | Πού τρέχει | Script | Χρόνος |
|------|------------|--------|---------|
| 1. Setup Server | Hetzner (SSH) | `1-setup-hetzner.sh` | ~5 λεπτά |
| 2. Upload Files | Development | `2-upload-files.sh` | ~2-5 λεπτά |
| 3. Αλλαγή DNS | Cloudflare panel | Χειροκίνητα | 1 λεπτό |
| 4. SSL | Hetzner (SSH) | `3-ssl.sh` | ~2 λεπτά |

**Σύνολο: ~15-30 λεπτά** (+ DNS propagation 5-30 λεπτά)

---

## Προαπαιτούμενα

- SSH access στο Hetzner server
- Access στο Cloudflare (dash.cloudflare.com) για nexify.gr
- Το `rsync` να είναι εγκατεστημένο (ήδη υπάρχει)

---

## ΒΗΜΑ 1: Εγκατάσταση Server

**SSH στο Hetzner:**
```bash
ssh root@HETZNER_IP
```

**Κατέβασε και τρέξε το script:**
```bash
# Δημιούργησε φάκελο
mkdir -p /tmp/nexify-deploy

# Αντέγραψε το script (από development server)
scp root@DEV_IP:/var/www/projects/nexifynewweb/deploy/1-setup-hetzner.sh /tmp/nexify-deploy/

# Τρέξε
bash /tmp/nexify-deploy/1-setup-hetzner.sh
```

**Τι εγκαθιστά:**
- ✅ Nginx (web server)
- ✅ PHP 8.3-FPM
- ✅ MySQL 8 (για μελλοντική χρήση)
- ✅ Certbot (Let's Encrypt SSL)
- ✅ UFW Firewall
- ✅ Fail2ban (protection)

---

## ΒΗΜΑ 2: Μεταφορά Αρχείων

**Από τον development server:**
```bash
cd /var/www/projects/nexifynewweb/deploy/
bash 2-upload-files.sh HETZNER_IP
```

**Παράδειγμα:**
```bash
bash 2-upload-files.sh 135.181.155.141
```

**Τι ανεβαίνει:**
- ✅ Όλα τα PHP files (index.php, contact.php, κ.τ.λ.)
- ✅ CSS, JS, libs/ (Tailwind, Alpine.js)
- ✅ Images, webfonts/
- ✅ Videos (.mp4 - πάρουν λίγο χρόνο ~36MB)
- ✅ Chatbot (api.php, knowledge-base.json)
- ✅ includes/ (header.php, footer.php)
- ✅ sitemap.xml, robots.txt

**Τι ΔΕΝ ανεβαίνει:**
- ✗ deploy/ (αυτά τα scripts)
- ✗ .git/, .claude/ (dev files)
- ✗ *.md (documentation)
- ✗ responsive-preview.php (dev tool)
- ✗ test_file.txt

---

## ΒΗΜΑ 3: Αλλαγή DNS στο Cloudflare

1. Πήγαινε: **https://dash.cloudflare.com**
2. Επίλεξε **nexify.gr**
3. Πήγαινε στο **DNS → Records**
4. Βρες τα A records για `nexify.gr` και `www`
5. Άλλαξε τα σε **HETZNER_IP**

### ⚠️ Κρίσιμο για SSL:
Για να δουλέψει το Let's Encrypt, **απενεργοποίησε το Cloudflare Proxy** (orange cloud → grey cloud) πριν εκδόσεις SSL.

```
nexify.gr    A    HETZNER_IP    DNS only (grey cloud)
www          A    HETZNER_IP    DNS only (grey cloud)
```

### Μετά το SSL:
Μπορείς να ξαναβάλεις το Cloudflare Proxy (orange cloud) για CDN + DDoS protection.

---

## ΒΗΜΑ 4: SSL Certificate

**Περίμενε DNS propagation** (5-30 λεπτά). Ελέγχεις:
```bash
nslookup nexify.gr
# Πρέπει να δείχνει: HETZNER_IP
```

**SSH στο Hetzner:**
```bash
ssh root@HETZNER_IP
bash /tmp/nexify-deploy/3-ssl.sh
```

---

## Verification Checklist

Μετά το deploy, έλεγξε:

- [ ] `https://nexify.gr` — ανοίγει κανονικά
- [ ] `https://www.nexify.gr` → redirect σε nexify.gr
- [ ] `http://nexify.gr` → redirect σε https://
- [ ] Navigation links λειτουργούν
- [ ] Videos παίζουν (energy.php)
- [ ] Chatbot απαντά (widget στο corner)
- [ ] Contact form φαίνεται σωστά
- [ ] SSL padlock (🔒) φαίνεται στο browser

---

## Troubleshooting

### Site δεν φαίνεται μετά DNS αλλαγή
```bash
# Έλεγξε DNS propagation
nslookup nexify.gr 8.8.8.8

# Έλεγξε nginx logs
tail -f /var/log/nginx/nexify.error.log

# Restart nginx
systemctl restart nginx
```

### PHP error
```bash
# Logs
tail -f /var/log/php8.3-fpm.log
tail -f /var/log/nginx/nexify.error.log
```

### SSL error
```bash
# Ανανέωση
certbot renew --force-renewal

# Ελεγχος certificate
certbot certificates
```

### Permissions error
```bash
# Fix permissions
chown -R www-data:www-data /var/www/nexify/
find /var/www/nexify -type d -exec chmod 755 {} \;
find /var/www/nexify -type f -exec chmod 644 {} \;
```

---

## Useful Commands (στο Hetzner)

```bash
# Nginx status
systemctl status nginx

# PHP status
systemctl status php8.3-fpm

# Nginx logs
tail -f /var/log/nginx/nexify.access.log
tail -f /var/log/nginx/nexify.error.log

# Reload nginx (μετά από αλλαγές config)
nginx -t && systemctl reload nginx

# Disk space
df -h

# Site size
du -sh /var/www/nexify/
```

---

## Αρχιτεκτονική

```
Cloudflare DNS
      ↓
Hetzner Server (IP: HETZNER_IP)
      ↓
Nginx (Port 80/443)
      ↓
PHP 8.3-FPM
      ↓
/var/www/nexify/
```

**Server specs (development):**
- Ubuntu 24.04 LTS
- 8GB RAM
- 150GB SSD

---

*Δημιουργήθηκε: Μάιος 2025*
