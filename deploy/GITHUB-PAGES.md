# 🐙 GitHub Pages + Custom Domain — nexify.gr

## Γιατί GitHub Pages;
- **Δωρεάν** hosting για static sites
- Αυτόματο build & deploy κάθε φορά που κάνεις push
- Custom domain support (nexify.gr)
- HTTPS δωρεάν
- Ενσωματώνεται με Cloudflare CDN

---

## ΒΗΜΑ 1 — Ενεργοποίηση GitHub Pages στο repo

1. Πήγαινε: **github.com/nexifysales/nexifynewweb**
2. **Settings** → **Pages**
3. Source: **"GitHub Actions"** (όχι branch!)
4. Αποθήκευσε

---

## ΒΗΜΑ 2 — Πρόσθεσε το workflow αρχείο

Στο GitHub repo (browser ή local), δημιούργησε:
```
.github/workflows/deploy.yml
```

Με το περιεχόμενο του αρχείου: `github-actions-setup/deploy.yml`

**Γρήγορος τρόπος μέσω browser:**
1. github.com/nexifysales/nexifynewweb
2. Κλικ **"Add file"** → **"Create new file"**
3. Στο filename γράψε: `.github/workflows/deploy.yml`
4. Paste το περιεχόμενο από `github-actions-setup/deploy.yml`
5. Commit

---

## ΒΗΜΑ 3 — Custom Domain στο GitHub

1. **Settings** → **Pages** → **Custom domain**
2. Γράψε: `nexify.gr`
3. Κλικ **Save**
4. Τσέκαρε το ✅ **"Enforce HTTPS"**

Αυτό δημιουργεί αυτόματα ένα `CNAME` αρχείο στο root του branch.

---

## ΒΗΜΑ 4 — DNS στο Cloudflare

Πήγαινε: **dash.cloudflare.com → nexify.gr → DNS**

### Διέγραψε τα παλιά records (papaki/website builder):
- Οτιδήποτε `A` ή `CNAME` για `@` ή `www`

### Πρόσθεσε τα νέα GitHub Pages records:

| Type | Name | Value | Proxy |
|------|------|-------|-------|
| A | @ | 185.199.108.153 | **DNS only** (🌤️ grey) |
| A | @ | 185.199.109.153 | DNS only |
| A | @ | 185.199.110.153 | DNS only |
| A | @ | 185.199.111.153 | DNS only |
| CNAME | www | nexifysales.github.io | DNS only |

> ⚠️ ΣΗΜΑΝΤΙΚΟ: Θέσε σε **"DNS only"** (γκρίζο σύννεφο) — ΟΧΙ Proxied για το apex domain με GitHub Pages.

---

## ΒΗΜΑ 5 — Verify domain (προαιρετικό αλλά recommended)

Για να αποτρέψεις κάποιον άλλο να "πάρει" το domain σου:
1. github.com → Settings → Pages → **"Add a verified domain"**
2. Ακολούθησε τις οδηγίες για TXT record στο DNS

---

## ⏱️ Timeline

| Ενέργεια | Χρόνος |
|---------|--------|
| GitHub Actions build | ~2-3 λεπτά |
| DNS propagation | 5 - 60 λεπτά |
| SSL certificate (Let's Encrypt) | Μέχρι 24h (συνήθως 10 λεπτά) |

---

## 🔄 Πώς λειτουργεί μετά

```
git push → GitHub Actions → build.sh τρέχει →
PHP pages → HTML → deploy/dist/ → GitHub Pages → nexify.gr
```

Κάθε push στο `main` branch → αυτόματο deploy σε ~3 λεπτά.

---

## ⚠️ Σημαντικό: Chatbot API

Το chatbot (`chatbot/api.php`) είναι PHP — **δεν τρέχει σε GitHub Pages** (static only).

**Λύση:** Το build script (`build.sh`) ήδη το χειρίζεται:
- Στο `dist/` το chatbot πηγαίνει σε `chatbot/api` (Cloudflare Worker path)
- Θα χρειαστεί **Cloudflare Worker** ή **μεταφορά chatbot σε άλλο service** (π.χ. Vercel Functions)

**Εναλλακτικά (πιο απλό):** Αφαίρεσε το chatbot widget από τις σελίδες αν δεν είναι κρίσιμο για το launch.

---

## 📦 Files που θα γίνουν push

Τα σημαντικά για το build:
```
nexifynewweb/
├── .github/workflows/deploy.yml   ← ΝΕΟ (από github-actions-setup/)
├── deploy/
│   ├── build.sh                   ← Build script
│   └── render-page.php            ← PHP→HTML renderer
├── *.php                          ← Πηγαίο PHP
├── css/, js/, libs/, images/      ← Assets
└── chatbot/                       ← Knowledge base
```

---

## ✅ Checklist

- [ ] GitHub repo: nexifysales/nexifynewweb
- [ ] Settings → Pages → Source: GitHub Actions
- [ ] Πρόσθεσε `.github/workflows/deploy.yml`
- [ ] Custom domain: nexify.gr
- [ ] DNS records στο Cloudflare (4× A records + CNAME)
- [ ] Proxy: DNS only (grey cloud) για GitHub IPs
- [ ] Enforce HTTPS: ✅
