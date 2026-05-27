# NexiFy — Deploy στο Cloudflare Pages
## Ο πλήρης οδηγός (Ελληνικά)

> **Προαπαιτούμενο:** Ο κώδικας ήδη βρίσκεται στο Hetzner server
> (εκεί που τρέχεις αυτόν τον οδηγό)

---

## 📋 Επισκόπηση

Το nexify.gr θα τρέχει ως **static site** στο **Cloudflare Pages** (δωρεάν, unlimited requests).

| Τι | Πού |
|----|-----|
| HTML σελίδες (13) | Cloudflare Pages CDN |
| CSS/JS/Images/Videos | Cloudflare Pages CDN |
| Chatbot API | Cloudflare Pages Function (edge) |
| Email forms | FormSubmit (ήδη external, αναλλοίωτο) |
| DNS | Cloudflare (ήδη υπάρχει) |

---

## 🏗️ ΒΗΜΑ 1 — Build static files

```bash
cd /var/www/projects/nexifynewweb
bash deploy/build.sh
```

Αυτό δημιουργεί το `deploy/dist/` folder με όλες τις στατικές σελίδες.

**Τι κάνει το build:**
- Renders 13 PHP pages → HTML (χρησιμοποιεί PHP CLI)
- Copies CSS, JS, libs, images, videos, webfonts
- Fixes όλα τα `.php` links → `.html`
- Creates `_redirects` για backward compatibility
- Creates `_headers` για security & caching

---

## 🚀 ΒΗΜΑ 2 — Deploy στο Cloudflare Pages

### Επιλογή A: Drag & Drop (χωρίς CLI — πιο εύκολο)

1. Άνοιξε terminal και φτιάξε zip:
   ```bash
   cd /var/www/projects/nexifynewweb/deploy
   zip -r nexify-dist.zip dist/
   ```

2. Κατέβασε το `nexify-dist.zip` στον υπολογιστή σου

3. Πήγαινε: **dash.cloudflare.com → Workers & Pages → Create → Pages → Upload assets**

4. Drag & drop το zip αρχείο

5. Project name: `nexify-gr`

6. Κλικ **Deploy site**

---

### Επιλογή B: Wrangler CLI (προτεινόμενο)

```bash
# 1. Install Wrangler
npm install -g wrangler

# 2. Login στο Cloudflare
wrangler login
# (ανοίγει browser για authentication)

# 3. Deploy
wrangler pages deploy /var/www/projects/nexifynewweb/deploy/dist \
    --project-name nexify-gr

# 4. Για μελλοντικά updates (re-deploy):
bash /var/www/projects/nexifynewweb/deploy/build.sh && \
wrangler pages deploy /var/www/projects/nexifynewweb/deploy/dist \
    --project-name nexify-gr
```

---

### Επιλογή C: GitHub + Cloudflare Pages (auto-deploy)

1. Push τον κώδικα στο GitHub:
   ```bash
   cd /var/www/projects/nexifynewweb
   git add .
   git commit -m "Add Cloudflare Pages build system"
   git push
   ```

2. **dash.cloudflare.com → Pages → Create → Connect to Git**

3. Επέλεξε το nexify repo

4. Build settings:
   - **Framework preset:** `None`
   - **Build command:** `bash deploy/build.sh`
   - **Build output directory:** `deploy/dist`

5. Κλικ **Save and Deploy**

> ✅ Από εδώ κάθε `git push` κάνει auto-deploy στο nexify.gr!

---

## 🔗 ΒΗΜΑ 3 — Custom Domain nexify.gr

Μετά το deploy:

1. Cloudflare Pages → nexify-gr → **Custom domains**
2. Κλικ **Set up a custom domain**
3. Πληκτρολόγησε: `nexify.gr`
4. Κλικ **Continue**
5. Cloudflare θα αναγνωρίσει ότι το domain ήδη στο CF και θα ρυθμίσει αυτόματα

Επίσης για **www.nexify.gr**:
- Πρόσθεσε δεύτερο custom domain: `www.nexify.gr`
- ΅Η Cloudflare Pages το handle αυτόματα

---

## ⚙️ ΒΗΜΑ 4 — Chatbot API (Cloudflare Pages Function)

Το chatbot API (api.php) μετατράπηκε σε **Cloudflare Pages Function** (JavaScript).

**Αρχείο:** `functions/chatbot/api.js`

Για να λειτουργήσει πρέπει να include αριθ functions directory:

**Για Wrangler deploy:**
```bash
wrangler pages deploy /var/www/projects/nexifynewweb/deploy/dist \
    --project-name nexify-gr \
    # Wrangler αυτόματα βρίσκει το functions/ directory στο project root
```

**Για GitHub deploy:**
Το Cloudflare Pages αυτόματα βρίσκει το `functions/` directory στο root του repo.

**Για Drag & Drop:**
Θα χρειαστεί να χρησιμοποιήσεις Wrangler ή GitHub για να έχεις Functions. Το Drag & Drop δεν υποστηρίζει Functions.

---

## ✅ ΒΗΜΑ 5 — Επαλήθευση

Μετά το deploy, τεστ αυτές τις URLs:

```bash
# Homepage
curl -I https://nexify.gr/

# PHP redirect (πρέπει να γίνει 301 → .html)
curl -I https://nexify.gr/energy.php

# HTML page (πρέπει να επιστρέφει 200)
curl -I https://nexify.gr/energy.html

# Chatbot API
curl "https://nexify.gr/chatbot/api?action=contact"

# Sitemap
curl -I https://nexify.gr/sitemap.xml
```

---

## 🔄 Μελλοντικά Updates

Κάθε φορά που αλλάζεις κώδικα:

```bash
cd /var/www/projects/nexifynewweb

# 1. Κάνε τις αλλαγές σου (.php files, CSS, etc.)

# 2. Re-build
bash deploy/build.sh

# 3. Re-deploy
wrangler pages deploy deploy/dist --project-name nexify-gr
```

Ή αν χρησιμοποιείς GitHub: απλά `git push` και γίνεται αυτόματα!

---

## ❓ Συχνά ερωτήματα

**Γιατί στατικό site και όχι PHP server;**
Cloudflare Pages είναι δωρεάν, global CDN, 0ms latency. Δεν χρειάζεται να πληρώνεις server για PHP templates.

**Τι γίνεται με τα forms;**
Τα forms χρησιμοποιούν ήδη **FormSubmit** (εξωτερικό service) — δεν χρειάζονται PHP backend.

**Τι γίνεται με το chatbot;**
Μετατράπηκε σε **Cloudflare Pages Function** (JavaScript) — τρέχει στο Cloudflare edge, χωρίς server.

**Μπορώ να κάνω rollback;**
Ναι! Cloudflare Pages κρατά όλα τα deployments. Πήγαινε Pages → Deployments και κλικ Rollback.

**Τι γίνεται με το SEO;**
Όλα τα `.php` URLs κάνουν 301 redirect σε `.html` — Google κρατάει τα rankings.

---

## 📁 Αρχεία που δημιουργήθηκαν

```
deploy/
├── build.sh              ← Κύριο build script
├── render-page.php       ← PHP page renderer
├── dist/                 ← Αυτό ανεβαίνει στο CF Pages
│   ├── *.html            ← 13 rendered pages
│   ├── css/, js/, libs/  ← Static assets
│   ├── chatbot/          ← Widget + knowledge base
│   ├── _redirects        ← PHP→HTML redirects
│   └── _headers          ← Security & cache headers
functions/
└── chatbot/
    └── api.js            ← Chatbot API (CF Pages Function)
```
