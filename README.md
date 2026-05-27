# NexiFy — Static Website

## Δομή
```
site/
├── index.html              # Αρχική
├── energy.html             # Ενέργεια + native calculator
├── ecosystem.html          # Ecosystem (5 πυλώνες)
├── virtual-office.html     # Φορολογική Έδρα
├── partners.html           # Συνεργάτες
├── careers.html            # Καριέρα
├── faq.html                # FAQ
├── contact.html            # Επικοινωνία
├── gemi.html               # Στοιχεία Γ.Ε.ΜΗ.
├── terms.html              # Όροι Χρήσης
├── privacy.html            # Πολιτική Απορρήτου
├── cookies.html            # Πολιτική Cookies
├── sitemap.xml
├── robots.txt
└── assets/
    ├── css/style.css
    ├── js/main.js              # navigation, reveal, cookies
    ├── js/energy-calculator.js # native rebuild του comparison tool
    └── img/nexify_logo.png
```

## Brand System
- **Blue** `#3268ac` (--c-blue) — primary, CTAs δευτερεύοντα, links
- **Orange dark** `#f26339` (--c-orange) — primary CTAs, accents
- **Orange light** `#f89241` (--c-orange-light) — gradients, hover states
- **Fonts:** Inter (body) + Poppins (headings) από Google Fonts

## Deploy
1. Upload φακέλου `site/` σε hosting (Apache, Nginx, Netlify, Vercel, Cloudflare Pages)
2. Domain → root του φακέλου
3. SSL/HTTPS μέσω hosting (Let's Encrypt suggested)

### Recommendations
- **Netlify drag-drop:** Σύρε ολόκληρο τον φάκελο `site/` στο netlify.com → instant deploy
- **Cloudflare Pages:** push σε GitHub repo → connect → deploy
- **Custom server:** Αρκεί στατικό serving (nginx/apache)

## Energy Calculator
Native rebuild του comparison tool με **23 προγράμματα ρεύματος** + **7 προγράμματα αερίου** από 7 παρόχους.
- Demo data στο `assets/js/energy-calculator.js` (Q2 2026 reference prices).
- **Production:** Σύνδεσε με Firecrawl/RAE pipeline για αυτόματη ανανέωση τιμών.
- **CRM integration:** Όταν ο χρήστης πατάει "Συνέχεια →" στέλνεται στο `contact.html?provider=...&plan=...` — εύκολο tracking & lead capture.

## Επόμενα Βήματα (P0/P1)
- [ ] Real-time price feed από Firecrawl (energy-dynamic-pricing skill)
- [ ] Form backend (FastAPI/Cloudflare Worker) → HubSpot CRM
- [ ] Google Analytics 4 + GTM
- [ ] Σύνδεση blog (αν χρειαστεί SEO content)
- [ ] OG images per page
