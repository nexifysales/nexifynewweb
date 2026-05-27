<?php
/**
 * NexiFy — Ecosystem
 */
$pageTitle       = 'Ecosystem υπηρεσιών — NexiFy';
$pageDescription = 'Ολοκληρωμένο οικοσύστημα υπηρεσιών για επιχειρήσεις: ενέργεια, τηλεφωνικό κέντρο, CRM/ERP, cloud hosting, AI development, εταιρική παρουσία.';
$pageCanonical   = 'https://nexify.gr/ecosystem.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Αρχική</a> · Ecosystem</div>
    <h1>
      <!-- Desktop: full title. Mobile: shorter title that fits on 1 line -->
      <span class="title-desktop">Ένα <span style="color:var(--c-orange-light)">οικοσύστημα</span> υπηρεσιών — όχι ένα πακέτο</span>
      <span class="title-mobile"><span style="color:var(--c-orange-light)">Ecosystem</span> Υπηρεσιών</span>
    </h1>
    <p>Συγκεντρώνουμε σε ένα σημείο υπηρεσίες που συνήθως απαιτούν 5+ διαφορετικούς συνεργάτες. Επιλέγεις ό,τι χρειάζεσαι, όταν το χρειάζεσαι.</p>
  </div>
</section>

<section class="section" id="energy" data-testid="pillar-energy-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="reveal">
        <span class="eyebrow">Πυλώνας 01</span>
        <h2>Ενέργεια — ρεύμα &amp; φυσικό αέριο</h2>
        <p class="lead">Συμβάσεις ηλεκτρικής ενέργειας και φυσικού αερίου για:</p>
        <ul class="list-check">
          <li><b>Ιδιώτες</b> — οικιακό &amp; επαγγελματικό τιμολόγιο</li>
          <li><b>Επιχειρήσεις</b> — μεμονωμένος μετρητής έως αλυσίδα καταστημάτων</li>
          <li><b>Πολυ-καταστηματικές αλυσίδες</b> &amp; συγκροτήματα γραφείων</li>
        </ul>
        <p>Σύγκριση όλων των μεγάλων Ελλήνων παρόχων ρεύματος και αερίου, διαπραγμάτευση και ολοκλήρωση αλλαγής — όλα μέσα από τον <a href="energy.php">μηχανισμό σύγκρισης MR. Revmas</a>.</p>
        <a href="energy.php" class="btn btn-primary mt-3" data-testid="pillar-energy-btn">Σύγκρινε προγράμματα →</a>
      </div>
      <div class="reveal">
        <div class="card-blue card">
          <h3>Τι κερδίζει ο πελάτης</h3>
          <ul class="list-check" style="color:#fff">
            <li>Έως 40% μείωση κόστους</li>
            <li>Επαγγελματική διαπραγμάτευση τιμών</li>
            <li>Ένα συμβόλαιο ανά εγκατάσταση</li>
            <li>Reporting κατανάλωσης &amp; κόστους</li>
            <li>Ετήσια αναθεώρηση χωρίς χρέωση</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-soft" id="callcenter" data-testid="pillar-callcenter-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="card-blue card reveal" style="order:2">
        <h3>Use cases τηλεφωνικού κέντρου</h3>
        <ul class="list-check" style="color:#fff">
          <li>Outbound πωλήσεις προγραμμάτων ενέργειας</li>
          <li>Lead qualification &amp; appointment setting</li>
          <li>Επαγγελματική επικοινωνία με πελάτες</li>
          <li>Customer retention &amp; ικανοποίηση</li>
          <li>Πληροφορίες προϊόντων &amp; υπηρεσιών</li>
        </ul>
      </div>
      <div class="reveal" style="order:1">
        <span class="eyebrow">Πυλώνας 02</span>
        <h2>Τηλεφωνικό Κέντρο &amp; Υποστήριξη Πωλήσεων</h2>
        <p class="lead">Οργανωμένο outbound call center για επιχειρήσεις που θέλουν αύξηση πωλήσεων χωρίς να χτίσουν εσωτερική ομάδα.</p>
        <p>Συνδυάζουμε <b>έμπειρους agents</b> με <b>AI-powered εργαλεία</b> για να μεγιστοποιούμε τη μετατροπή και να μειώνουμε το κόστος ανά κλήση.</p>
        <ul class="list-check">
          <li>Multilingual: Ελληνικά &amp; Αγγλικά</li>
          <li>CRM integration (HubSpot, Salesforce, Pipedrive)</li>
          <li>Call analytics &amp; recording</li>
          <li>Scaling 10 → 10.000 κλήσεις/ημέρα</li>
        </ul>
        <a href="contact.php?topic=callcenter" class="btn btn-primary mt-3" data-testid="callcenter-contact-btn">Ξεκίνα συζήτηση →</a>
      </div>
    </div>
  </div>
</section>

<section class="section" id="tech" data-testid="pillar-tech-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:760px;margin:0 auto 50px">
      <span class="eyebrow">Πυλώνας 03</span>
      <h2>Τεχνολογία &amp; Υποδομή</h2>
      <p class="lead">Σύγχρονες τεχνολογικές λύσεις, προσαρμοσμένες στις ανάγκες κάθε επιχείρησης. Όλες πλήρως εναρμονισμένες με ΑΑΔΕ &amp; myDATA.</p>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card"><h3>Oxygen ERP / CRM</h3><p>Online οργάνωση &amp; ηλεκτρονική τιμολόγηση. Πλήρης τεχνική υποστήριξη, δωρεάν αναβαθμίσεις, εναρμόνιση ΑΑΔΕ.</p></div>
      <div class="card"><h3>Cloud Ταμειακή</h3><p>Ταμειακή στο κινητό, tablet ή PC. Χωρίς Z, χωρίς αναλώσιμα, χωρίς συντήρηση.</p></div>
      <div class="card"><h3>Υπηρεσίες Παρόχου</h3><p>Έκδοση αποδείξεων online &amp; αυτόματη διαβίβαση παραστατικών στο myDATA.</p></div>
      <div class="card"><h3>Soft POS &amp; Payments</h3><p>Oxygen Payments + Soft POS — μετάτρεψε το smartphone σε POS για ανέπαφη χρέωση καρτών.</p></div>
      <div class="card"><h3>Ψηφιακή Κάρτα Εργαζομένου</h3><p>Διαχείριση χρόνου, αιτήματα αδειών, λειτουργία Ψηφιακής Κάρτας Εργασίας — όλα σε ένα app.</p></div>
      <div class="card"><h3>Premium Cloud Hosting</h3><p>Φιλοξενία ιστοσελίδων με 99.9% uptime. Semi-dedicated, reseller, HPC — εσύ διαλέγεις.</p></div>
      <div class="card"><h3>Managed Kubernetes</h3><p>Outsource έως 100% των IT tasks. 24/7 τεχνική υποστήριξη, auto-heal, disaster redundancy.</p></div>
      <div class="card"><h3>MyNext.io — Logistics</h3><p>Διαχείριση παραδόσεων, real-time tracking, υπογραφή/φωτογραφία απόδειξης, integration με e-shop &amp; ERP.</p></div>
      <div class="card"><h3>CodeHero Pro — AI Dev</h3><p>AI development platform. Anthropic, OpenAI, Gemini, xAI, DeepSeek, Ollama — self-hosted ή cloud.</p></div>
    </div>
    <div class="text-center mt-4">
      <a href="contact.php?topic=tech" class="btn btn-outline" data-testid="tech-demo-btn">Ζήτα demo τεχνολογικής λύσης →</a>
    </div>
  </div>
</section>

<section class="section section-soft" id="virtual-office" data-testid="pillar-virtual-office-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="reveal">
        <span class="eyebrow">Πυλώνας 04</span>
        <h2>Φορολογική Έδρα &amp; Virtual Office</h2>
        <p class="lead">Νόμιμη επαγγελματική διεύθυνση για επιχειρήσεις παροχής υπηρεσιών — χωρίς να μισθώσεις φυσικό γραφείο.</p>
        <p>Ιδανικό για <b>startups</b>, <b>ελεύθερους επαγγελματίες</b> και <b>νέες ή αναπτυσσόμενες επιχειρήσεις</b> που θέλουν επαγγελματική εικόνα και διοικητική υποδομή.</p>
        <ul class="list-check">
          <li>Νόμιμη επαγγελματική διεύθυνση</li>
          <li>Λήψη &amp; αποθήκευση αλληλογραφίας</li>
          <li>Αίθουσα συσκέψεων (pay-per-use)</li>
          <li>Εταιρικός σταθερός &amp; κινητό</li>
          <li>Δυνατότητα Catering κατόπιν συνεννόησης</li>
        </ul>
        <a href="virtual-office.php" class="btn btn-primary mt-3" data-testid="virtual-office-btn">Πακέτα &amp; τιμές →</a>
      </div>
      <div class="reveal">
        <div class="card">
          <h3>Από <span style="color:var(--c-orange);font-family:var(--font-display);font-size:2.4rem;font-weight:800">180€</span></h3>
          <p style="color:var(--c-muted)">τρίμηνο, χωρίς κρυφά κόστη</p>
          <p>Το πακέτο περιλαμβάνει νόμιμη επαγγελματική διεύθυνση, διαχείριση αλληλογραφίας και κάλυψη όλων των λογαριασμών κοινής ωφέλειας — χωρίς επιπλέον επιβαρύνσεις.</p>
          <a href="virtual-office.php" class="btn btn-outline btn-block">Δες όλα τα πακέτα →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" id="presence" data-testid="pillar-presence-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Πυλώνας 05</span>
      <h2>Εταιρική παρουσία &amp; διοικητική υποστήριξη</h2>
      <p class="lead">Οικοδομούμε την επαγγελματική σου εικόνα και αναλαμβάνουμε τη διαχείριση των εργασιών back-office.</p>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card"><h3>Εταιρική Ιστοσελίδα</h3><p>Custom design, responsive, SEO-ready. <b>Όχι e-shop.</b> Εφάπαξ κόστος 500€ (χωρίς domain &amp; hosting).</p></div>
      <div class="card"><h3>Google Business Profile</h3><p>Setup &amp; βελτιστοποίηση Google προφίλ, Maps, ιδιότητες, φωτογραφίες.</p></div>
      <div class="card"><h3>Γραμματειακή Υποστήριξη</h3><p>Document generation, διαχείριση calendar, scheduling meetings, templates για επαναλαμβανόμενες εργασίες.</p></div>
    </div>
  </div>
</section>

<section class="section section-soft" data-testid="ecosystem-cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <h2>Έχεις στο μυαλό σου ένα συγκεκριμένο πρόβλημα;</h2>
      <p>Σε 30' συζήτηση δείχνουμε ποια υπηρεσία (ή συνδυασμός) σου ταιριάζει — και πόσο κοστίζει.</p>
      <div class="btn-row center">
        <a href="contact.php" class="btn btn-primary btn-lg" data-testid="ecosystem-cta-btn">Κλείσε ραντεβού →</a>
        <a href="tel:+302109996300" class="btn btn-ghost btn-lg">📞 210 999 6300</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
