<?php
/**
 * NexiFy — Energy
 */
$pageTitle       = 'Σύγκριση παρόχων ρεύματος & αερίου — NexiFy';
$pageDescription = 'Σύγκρινε όλους τους παρόχους ηλεκτρικής ενέργειας και φυσικού αερίου στην Ελλάδα — powered by MR. Revmas.';
$pageCanonical   = 'https://nexify.gr/energy.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Αρχική</a> · Ενέργεια</div>
    <div class="powered-badge">
      <span class="lightning">⚡</span>
      Powered by <b style="color:#fff">MR. Revmas</b>
    </div>
    <h1>Ο <span style="color:var(--c-orange-light)">υπερήρωας</span> της ενέργειάς σου</h1>
    <p>Δεν συγκρίνουμε τιμές με Excel. Συγκρίνουμε με τον <b>MR. Revmas</b> — έναν AI-powered μηχανισμό που διαβάζει την αγορά live και βρίσκει το πρόγραμμα που πραγματικά σου ταιριάζει. Σε δευτερόλεπτα.</p>
  </div>
</section>

<!-- HERO REVEAL -->
<section class="revmas-feature" data-testid="revmas-hero-section">
  <div class="container">
    <div class="revmas-feature-grid">
      <div class="revmas-media reveal">
        <video autoplay muted loop playsinline poster="mr-revmas-image.png">
          <source src="mr-revmas-landing-2.mp4" type="video/mp4">
          <img src="mr-revmas-image.png" alt="MR. Revmas">
        </video>
      </div>
      <div class="reveal">
        <span class="eyebrow">Η αποκάλυψη</span>
        <h2>Ένας υπερήρωας<br>για <span class="accent">κάθε νοικοκυριό</span>.</h2>
        <p style="font-size:1.05rem">Ο MR. Revmas είναι ένα <b style="color:#fff">AI-powered σύστημα</b> που ζυγίζει συνεχώς τα τιμολόγια όλων των παρόχων στην Ελλάδα. Δεν κοιμάται, δεν ξεχνά, δεν παίρνει προμήθεια από τη μια εταιρεία περισσότερη από την άλλη.</p>
        <p style="font-size:1.05rem">Με κίτρινη κάπα, ένα κεραυνό στο στήθος και άπειρη υπολογιστική δύναμη, ο MR. Revmas σαρώνει <b style="color:#fff">179+ προγράμματα</b> σε κλάσματα του δευτερολέπτου και σου δίνει <b style="color:#FFA24C">το πρόγραμμα που πραγματικά σε συμφέρει</b>.</p>
        <div class="revmas-cta-row">
          <a href="https://loyalty.revmas.gr/?mission=customer" target="_blank" rel="noopener" class="revmas-btn" data-testid="revmas-compare-btn">Δες πως θα μειώσεις το λογαριασμό σου</a>
          <a href="#callback" class="btn btn-ghost" style="border-color:rgba(255,255,255,.3);color:#fff" data-testid="revmas-callback-btn">Θέλω να με καλέσετε</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MISSION -->
<section class="revmas-feature" style="background:linear-gradient(180deg,#0E0E15 0%,#14141C 100%);padding-top:80px" data-testid="revmas-mission-section">
  <div class="container">
    <div class="revmas-feature-grid">
      <div class="reveal" style="order:2">
        <span class="eyebrow">Η αποστολή μας</span>
        <h2>Να κάνουμε τον λογαριασμό σου <span class="accent">δίκαιο</span> ξανά.</h2>
        <p style="font-size:1.05rem">Οι πάροχοι αλλάζουν τιμοκαταλόγους σχεδόν κάθε μήνα. Οι εκπτώσεις συνέπειας, οι ρήτρες και οι προσθήκες κάνουν τη σύγκριση εφιάλτη.</p>
        <p style="font-size:1.05rem">Ο <b style="color:#fff">MR. Revmas</b> δημιουργήθηκε για να σου επιστρέψει τον έλεγχο.</p>
        <ul class="revmas-list">
          <li><span class="check">✓</span><div><b>100% διαφανής:</b> Βλέπεις την αρχική τιμή, την τιμή με έκπτωση και το ετήσιο κόστος. Καμία έκπληξη.</div></li>
          <li><span class="check">✓</span><div><b>Χωρίς cookies διαφήμισης:</b> Δεν σε «πουλάμε» σε τρίτους call centers. Τα στοιχεία σου παραμένουν δικά σου.</div></li>
          <li><span class="check">✓</span><div><b>Green-first:</b> Επισήμανση προγραμμάτων ΑΠΕ για μειωμένο αποτύπωμα. Επιλέγεις με συνείδηση.</div></li>
        </ul>
        <div class="revmas-cta-row">
          <a href="https://revmas.gr/intro.html#origin" target="_blank" rel="noopener" class="revmas-btn">Μάθε την ιστορία του →</a>
        </div>
      </div>
      <div class="revmas-media reveal" style="order:1">
        <video autoplay muted loop playsinline poster="mr-revmas-image.png">
          <source src="mr-revmas-flying.mp4" type="video/mp4">
          <img src="mr-revmas-image.png" alt="MR. Revmas">
        </video>
      </div>
    </div>
  </div>
</section>

<!-- BIG CTA TO REVMAS -->
<section class="section" data-testid="revmas-cta-section">
  <div class="container">
    <div class="revmas-banner reveal" style="text-align:center;padding:60px 40px">
      <div class="revmas-logo-mark" style="margin:0 auto 20px"><svg viewBox="0 0 24 24" fill="none"><path d="M13 2L4 14h7l-1 8 9-12h-7l1-8z" fill="#fff"/></svg></div>
      <h2 style="font-size:clamp(2rem,4vw,2.8rem);max-width:720px;margin:0 auto 16px">Η σύγκριση γίνεται στον <span class="accent">MR. Revmas</span></h2>
      <p style="max-width:580px;margin:0 auto 30px;font-size:1.05rem">Πάτα το κουμπί. Δίνεις την κατανάλωσή σου σε 30''. Παίρνεις τα φθηνότερα 3 προγράμματα ταξινομημένα με ετήσιο κόστος και πιθανή εξοικονόμηση. Δωρεάν, χωρίς εγγραφή.</p>
      <div class="btn-row center" style="position:relative">
        <a href="https://revmas.gr/intro.html" target="_blank" rel="noopener" class="revmas-btn" style="font-size:1.1rem;padding:18px 36px" data-testid="revmas-open-btn">⚡ Άνοιξε τον MR. Revmas</a>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section section-soft" data-testid="how-it-works-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Πώς λειτουργεί</span>
      <h2>Από τη σύγκριση στη σύμβαση — σε 3 βήματα</h2>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card" data-testid="step-card-1">
        <div class="pillar-num">1</div>
        <h3>Σύγκριση στον MR. Revmas</h3>
        <p>Δίνεις την κατανάλωσή σου από οποιονδήποτε λογαριασμό. Ο MR. Revmas βρίσκει σε δευτερόλεπτα τα φθηνότερα 3 προγράμματα.</p>
      </div>
      <div class="card" data-testid="step-card-2">
        <div class="pillar-num">2</div>
        <h3>Επιλογή με τη NexiFy</h3>
        <p>Μας λες ποιο σου άρεσε ή σε ξενοιάζει. Σε καλούμε εμείς και επιβεβαιώνουμε ότι ταιριάζει στις πραγματικές σου ανάγκες.</p>
      </div>
      <div class="card" data-testid="step-card-3">
        <div class="pillar-num">3</div>
        <h3>Ενεργοποίηση</h3>
        <p>Αναλαμβάνουμε όλη τη διαδικασία αλλαγής παρόχου. Εσύ δεν τηλεφωνείς πουθενά, δεν συμπληρώνεις κανένα έγγραφο μόνος σου.</p>
      </div>
    </div>
  </div>
</section>

<!-- CALLBACK FORM -->
<section class="section section-soft" id="callback" data-testid="callback-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:660px;margin:0 auto 40px">
      <span class="eyebrow">Επικοινωνία</span>
      <h2>Θέλω να με <span style="background:var(--gradient-brand);-webkit-background-clip:text;background-clip:text;color:transparent">καλέσετε</span></h2>
      <p class="lead">Άσε μας τα στοιχεία σου. Σε καλούμε σε 1 εργάσιμη με <b>πλήρη σύγκριση</b> και προσωπική πρόταση — χωρίς δεσμεύσεις.</p>
    </div>
    <form id="callbackForm" class="callback-card reveal" data-testid="callback-form">
      <div id="callbackBody">
        <h3>Πες μας πώς να σε βρούμε</h3>
        <p style="color:var(--c-muted);font-size:.92rem;margin-bottom:24px">Καλούμε εργάσιμες ημέρες, 09:00–17:00. Δεν δίνουμε τα στοιχεία σου σε τρίτους.</p>
        <div class="form-row">
          <div class="form-group">
            <label for="cb_name">Όνομα *</label>
            <input type="text" class="form-control" id="cb_name" name="cb_name" required data-testid="cb-name-input">
          </div>
          <div class="form-group">
            <label for="cb_phone">Τηλέφωνο *</label>
            <input type="tel" class="form-control" id="cb_phone" name="cb_phone" required data-testid="cb-phone-input">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="cb_email">Email <span style="color:var(--c-muted);font-weight:400">(προαιρ.)</span></label>
            <input type="email" class="form-control" id="cb_email" name="cb_email" data-testid="cb-email-input">
          </div>
          <div class="form-group">
            <label for="cb_when">Καλύτερη ώρα κλήσης</label>
            <select class="form-control" id="cb_when" name="cb_when" data-testid="cb-when-select">
              <option value="any">Οποιαδήποτε</option>
              <option value="morning">09:00 – 12:00</option>
              <option value="midday">12:00 – 15:00</option>
              <option value="afternoon">15:00 – 17:00</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="cb_topic">Σε τι ενδιαφέρεσαι;</label>
          <select class="form-control" id="cb_topic" name="cb_topic" data-testid="cb-topic-select">
            <option value="energy-home">Ρεύμα ή αέριο για το σπίτι</option>
            <option value="energy-pro">Επαγγελματικό τιμολόγιο</option>
            <option value="energy-multi">Πολλαπλοί μετρητές / επιχείρηση</option>
            <option value="energy-ev">EV / νυχτερινό τιμολόγιο</option>
            <option value="other">Κάτι άλλο</option>
          </select>
        </div>
        <div class="form-group">
          <label for="cb_notes">Σχόλια <span style="color:var(--c-muted);font-weight:400">(προαιρ.)</span></label>
          <textarea class="form-control" id="cb_notes" name="cb_notes" rows="3" placeholder="π.χ. έχω ήδη συγκρίνει στον MR. Revmas, με ενδιαφέρει το πρόγραμμα Χ" data-testid="cb-notes-textarea"></textarea>
        </div>
        <div class="form-group">
          <label class="gdpr-label" style="font-weight:400;font-size:.88rem;display:flex;gap:10px;align-items:flex-start;cursor:pointer">
            <input type="checkbox" name="gdpr_consent" value="1" required
                   style="margin-top:3px;width:18px;height:18px;min-width:18px;cursor:pointer;accent-color:var(--c-blue,#3268ac)"
                   data-testid="cb-privacy-checkbox">
            <span>Έχω διαβάσει και συμφωνώ με την <a href="privacy.php" target="_blank">Πολιτική Απορρήτου</a> και τους <a href="terms.php" target="_blank">Όρους Χρήσης</a>. Επιτρέπω στη NexiFy να επικοινωνήσει μαζί μου. *</span>
          </label>
        </div>
        <input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
        <button type="submit" class="btn btn-primary btn-block btn-lg" data-testid="cb-submit-btn">📞 Καλέστε με →</button>
      </div>
      <div id="callbackSuccess" class="callback-success">
        <div class="check-big">✓</div>
        <h3 style="margin-bottom:8px">Ευχαριστούμε!</h3>
        <p style="margin-bottom:0">Λάβαμε το αίτημά σου. Σε καλούμε εντός 1 εργάσιμης ημέρας.</p>
      </div>
    </form>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
