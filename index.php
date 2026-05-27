<?php
/**
 * NexiFy — Κύρια Σελίδα (index.php)
 * Mirrors indexnewnexify.html exactly.
 */

$pageTitle       = 'NexiFy — Smart Solutions, Fast Results';
$pageDescription = 'Ολοκληρωμένες υπηρεσίες πωλήσεων, ενέργειας, τεχνολογίας και υποστήριξης για επιχειρήσεις και ιδιώτες. Ένας συνεργάτης, ένα οικοσύστημα.';
$pageCanonical   = 'https://nexify.gr/';

require_once __DIR__ . '/includes/header.php';
?>

<!-- ==================== HERO ==================== -->
<section class="hero" data-testid="hero-section">
  <div class="container hero-grid">
    <div class="reveal">
      <span class="eyebrow">Smart Solutions · Fast Results</span>
      <h1>Ένας <span class="accent">συνεργάτης</span>.<br>Ένα ολόκληρο <span class="accent">οικοσύστημα</span>.</h1>
      <p class="lead">Η NexiFy συγκεντρώνει σε μία επαφή πωλήσεις ενέργειας, τηλεφωνικό κέντρο, τεχνολογικές λύσεις και επιχειρηματική υποστήριξη — για επαγγελματίες, εταιρείες και ιδιώτες που θέλουν να κερδίζουν χρόνο και χρήμα.</p>
      <div class="btn-row mt-3">
        <a href="energy.php" class="btn btn-primary btn-lg" data-testid="hero-btn-energy">Σύγκρινε ρεύμα &amp; αέριο →</a>
        <a href="ecosystem.php" class="btn btn-outline btn-lg" data-testid="hero-btn-ecosystem">Δες το Ecosystem</a>
      </div>
      <div class="hero-stats">
        <div class="stat"><div class="num">5</div><div class="lab">Πυλώνες υπηρεσιών</div></div>
        <div class="stat"><div class="num">1</div><div class="lab">Σημείο επαφής</div></div>
        <div class="stat"><div class="num">100%</div><div class="lab">Ευθύνη delivery</div></div>
      </div>
    </div>
    <div class="hero-visual reveal">
      <div class="hero-visual-inner">
        <span class="badge">Ενέργεια</span>
        <h3 style="margin-top:14px">Σύγκρινε όλους τους παρόχους σε 30''</h3>
        <p style="font-size:.95rem">Ηλεκτρική ενέργεια &amp; φυσικό αέριο · Ιδιώτες &amp; επιχειρήσεις · Σπίτι, κατάστημα, γραφείο</p>
        <div style="margin-top:auto;display:flex;justify-content:space-between;align-items:flex-end">
          <div>
            <div style="font-size:.85rem;color:var(--c-muted)">Πιθανή εξοικονόμηση</div>
            <div style="font-family:var(--font-display);font-size:2.4rem;font-weight:800;color:var(--c-orange);line-height:1">έως 40%</div>
          </div>
          <a href="energy.php" class="btn btn-primary btn-sm" data-testid="hero-card-start-btn">Ξεκίνα →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==================== PARTNERS ==================== -->
<section class="section section-soft" data-testid="partners-section">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:50px">
      <span class="eyebrow">Τεχνολογικοί συνεργάτες</span>
      <h2 style="max-width:780px;margin:0 auto">Δουλεύουμε με καθιερωμένους τεχνολογικούς partners</h2>
      <p class="lead mt-2">Έτοιμη υποδομή — εσύ παίρνεις production-grade εργαλεία από day 1.</p>
    </div>
    <div class="partners-logos reveal">
      <div class="partner-logo"><img src="partner-oxygen.png" alt="Oxygen — Certified Reseller" loading="lazy"></div>
      <div class="partner-logo"><img src="partner-c2.png" alt="C2 Cloud Concept" loading="lazy"></div>
      <div class="partner-logo"><img src="partner-mynext.png" alt="MyNext" loading="lazy"></div>
      <div class="partner-logo"><img src="partner-mynext-market.png" alt="MyNext Market" loading="lazy"></div>
      <div class="partner-logo"><img src="partner-codehero.png" alt="CodeHero PRO" loading="lazy"></div>
    </div>
  </div>
</section>

<!-- ==================== 5 PILLARS ==================== -->
<section class="section" data-testid="pillars-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:760px;margin:0 auto 60px">
      <span class="eyebrow">5 Πυλώνες, 1 Συνεργάτης</span>
      <h2>Όλα όσα χρειάζεται μια επιχείρηση — σε ένα οικοσύστημα.</h2>
      <p class="lead">Δεν τα χρειάζονται όλοι όλα. Διαλέγεις ό,τι σου ταιριάζει. Εμείς εγγυόμαστε ότι μιλάνε μεταξύ τους.</p>
    </div>
    <div class="grid grid-3 reveal">
      <div class="pillar">
        <div class="pillar-num">01</div>
        <h3>Ενέργεια</h3>
        <p>Συμβάσεις ρεύματος &amp; φυσικού αερίου για ιδιώτες, επαγγελματίες και επιχειρήσεις. Σύγκριση όλων των παρόχων σε δευτερόλεπτα.</p>
        <a href="energy.php" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-energy">Σύγκρινε →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">02</div>
        <h3>Τηλεφωνικό Κέντρο</h3>
        <p>Οργανωμένο outbound call center για αύξηση πωλήσεων και επαγγελματική επικοινωνία με πελάτες. AI-enabled, multilingual, scalable.</p>
        <a href="ecosystem.php#callcenter" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-callcenter">Μάθε →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">03</div>
        <h3>Τεχνολογία &amp; Υποδομή</h3>
        <p>CRM, ERP, WMS, Cloud Hosting, AI Development. Συμβατά με ΑΑΔΕ, ψηφιακή κάρτα εργαζομένου, soft POS — όλα plug-and-play.</p>
        <a href="ecosystem.php#tech" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-tech">Μάθε →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">04</div>
        <h3>Φορολογική Έδρα</h3>
        <p>Νόμιμη επαγγελματική διεύθυνση. Αίθουσα συσκέψεων. Ιδανικό για startups &amp; freelancers.</p>
        <a href="virtual-office.php" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-virtual-office">Πακέτα →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">05</div>
        <h3>Εταιρική Παρουσία</h3>
        <p>Δημιουργία εταιρικής ιστοσελίδας, εταιρική εικόνα, υποστήριξη πωλήσεων &amp; διοικητικής λειτουργίας. Όχι e-shop.</p>
        <a href="ecosystem.php#presence" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-presence">Μάθε →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">+</div>
        <h3>Συνεργάτες</h3>
        <p>Εμπλούτισε το χαρτοφυλάκιο υπηρεσιών σου χωρίς επένδυση. Εμείς το backbone — εσύ η σχέση με τον πελάτη.</p>
        <a href="partners.php" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-partners">Δες πώς →</a>
      </div>
    </div>
  </div>
</section>

<!-- ==================== WHY NEXIFY ==================== -->
<section class="section section-soft" data-testid="why-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Γιατί NexiFy</span>
      <h2>Λιγότερη πολυπλοκότητα. Περισσότερο αποτέλεσμα.</h2>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M13 2L4 14h7l-1 8 9-12h-7l1-8z" fill="currentColor"/>
          </svg>
        </div>
        <h3>Ένα σημείο επαφής</h3>
        <p>Δεν χρειάζεσαι 5 διαφορετικούς συνεργάτες. Ένα τηλέφωνο, ένα email, ένας υπεύθυνος — για όλα.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>
          </svg>
        </div>
        <h3>Ταχύτητα υλοποίησης</h3>
        <p>Έτοιμη υποδομή και διαδικασίες σημαίνει άμεσο start-up. Μερικές ώρες για απλά projects, λίγες ημέρες για πιο σύνθετα.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12h4l3-9 4 18 3-9h4"/>
          </svg>
        </div>
        <h3>Διαφανές πλαίσιο</h3>
        <p>Ξεκάθαρες χρεώσεις, χωρίς κρυφά κόστη setup. Πληρώνεις ό,τι χρησιμοποιείς, χωρίς δέσμευση σε «πακέτα».</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
          </svg>
        </div>
        <h3>Κλιμάκωση</h3>
        <p>Από 1-άτομη επιχείρηση μέχρι αλυσίδα καταστημάτων ή multi-site εταιρεία. Η υποδομή προσαρμόζεται — όχι το αντίστροφο.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h3>Ευθύνη συντονισμού</h3>
        <p>Δεν αναλαμβάνεις εσύ τον συντονισμό 5 παρόχων. Εμείς αναλαμβάνουμε ευθύνη και delivery.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </div>
        <h3>Pilot-first προσέγγιση</h3>
        <p>Ξεκινάμε πάντα με μικρό, ελεγχόμενο scope. Επεκτείνουμε όταν φέρουμε αποτέλεσμα — όχι πριν.</p>
      </div>
    </div>
  </div>
</section>

<!-- ==================== CTA BOX ==================== -->
<section class="section" data-testid="cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <span class="eyebrow" style="color:#fff">Ξεκίνα τώρα</span>
      <h2>Πες μας τι χρειάζεσαι. Σε καλούμε σε 1 εργάσιμη.</h2>
      <p class="lead" style="max-width:540px;margin:0 auto 30px">Σύντομη συζήτηση αναγκών, χωρίς δεσμεύσεις, χωρίς γενικά πακέτα — απλώς για να δούμε αν και πώς μπορούμε να βοηθήσουμε.</p>
      <div class="btn-row center">
        <a href="contact.php" class="btn btn-primary btn-lg" data-testid="cta-contact-btn">Ξεκίνα συζήτηση →</a>
        <a href="tel:+302109996300" class="btn btn-ghost btn-lg" data-testid="cta-phone-btn">📞 210 999 6300</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
