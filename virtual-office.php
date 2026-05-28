<?php
/**
 * NexiFy — Φορολογική Έδρα / Virtual Office
 */
$pageTitle       = 'Φορολογική Έδρα — NexiFy';
$pageDescription = 'Νόμιμη επαγγελματική διεύθυνση για startups και επαγγελματίες. Πακέτα από 180€/τρίμηνο.';
$pageCanonical   = 'https://nexify.gr/virtual-office.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Αρχική</a> · Φορολογική Έδρα</div>
    <h1>Φορολογική Έδρα &amp; <span style="color:var(--c-orange-light)">Virtual Office</span></h1>
    <p>Η έξυπνη επιλογή για επιχειρήσεις, startups και ελεύθερους επαγγελματίες που θέλουν επαγγελματική παρουσία χωρίς το κόστος φυσικού γραφείου.</p>
  </div>
</section>

<section class="section" data-testid="pricing-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Πακέτα μίσθωσης</span>
      <h2>Διάλεξε τη διάρκεια που σου ταιριάζει</h2>
      <p class="lead">Καμία κρυφή χρέωση — οι λογαριασμοί κοινής ωφέλειας καλύπτονται από εμάς.</p>
    </div>
    <div class="grid grid-3 reveal" style="padding-top:36px">
      <div class="price-card" data-testid="price-card-3m">
        <h3>Τρίμηνο</h3>
        <div class="price">180€</div>
        <div class="term">όλα συμπεριλ.</div>
        <ul class="list-check">
          <li>Νόμιμη επαγγελματική διεύθυνση</li>
          <li>Διαχείριση αλληλογραφίας</li>
          <li>Κάλυψη ΔΕΚΟ</li>
          <li>Δοκιμαστική περίοδος</li>
        </ul>
        <a href="virtual-office-apply.php?plan=3m" class="btn btn-outline btn-block" data-testid="select-3m-btn">Επιλογή</a>
      </div>
      <div class="price-card" data-testid="price-card-6m">
        <h3>Εξάμηνο</h3>
        <div class="price">340€</div>
        <div class="term">όλα συμπεριλ.</div>
        <ul class="list-check">
          <li>Όλα του τριμήνου</li>
          <li>Μεγαλύτερη σταθερότητα</li>
          <li>Ίδιες παροχές</li>
        </ul>
        <a href="virtual-office-apply.php?plan=6m" class="btn btn-outline btn-block" data-testid="select-6m-btn">Επιλογή</a>
      </div>
      <div class="price-card featured" data-testid="price-card-1y">
        <h3>Ετήσιο</h3>
        <div class="price">500€</div>
        <div class="term">όλα συμπεριλ.</div>
        <ul class="list-check">
          <li>Όλα τα προηγούμενα</li>
          <li>Καλύτερη τιμή/μήνα</li>
          <li>Προτεραιότητα στα bookings αίθουσας</li>
        </ul>
        <a href="virtual-office-apply.php?plan=1y" class="btn btn-primary btn-block" data-testid="select-1y-btn">Επιλογή</a>
      </div>
      <div class="price-card" data-testid="price-card-2y">
        <h3>Διετές</h3>
        <div class="price">900€</div>
        <div class="term">όλα συμπεριλ.</div>
        <ul class="list-check">
          <li>Όλα τα προηγούμενα</li>
          <li>Έκπτωση 10% επί ετήσιου</li>
          <li>Locked-in τιμή</li>
        </ul>
        <a href="virtual-office-apply.php?plan=2y" class="btn btn-outline btn-block" data-testid="select-2y-btn">Επιλογή</a>
      </div>
      <div class="price-card" data-testid="price-card-5y">
        <h3>Πενταετές</h3>
        <div class="price">2.000€</div>
        <div class="term">όλα συμπεριλ.</div>
        <ul class="list-check">
          <li>Όλα τα προηγούμενα</li>
          <li>Μέγιστη οικονομία</li>
          <li>Ιδανικό για established επιχειρήσεις</li>
        </ul>
        <a href="virtual-office-apply.php?plan=5y" class="btn btn-outline btn-block" data-testid="select-5y-btn">Επιλογή</a>
      </div>
      <div class="price-card" data-testid="price-card-custom">
        <h3>Custom</h3>
        <div class="price" style="font-size:1.6rem">Ζήτα προσφορά</div>
        <div class="term">για ομαδικά setups</div>
        <ul class="list-check">
          <li>Multi-entity setups</li>
          <li>Branded reception</li>
          <li>Επιπλέον υπηρεσίες</li>
        </ul>
        <a href="virtual-office-apply.php?plan=custom" class="btn btn-outline btn-block" data-testid="select-custom-btn">Επικοινωνία</a>
      </div>
    </div>
  </div>
</section>

<section class="section section-soft" data-testid="meeting-room-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="reveal">
        <span class="eyebrow">Επιπλέον παροχές</span>
        <h2>Αίθουσα Συνεδριάσεων</h2>
        <p class="lead">Πλήρως εξοπλισμένη αίθουσα για επαγγελματικές συναντήσεις, παρουσιάσεις ή τηλεδιασκέψεις. Χρέωση μόνο για τον χρόνο που χρησιμοποιείς.</p>
        <table class="table" data-testid="meeting-room-table">
          <thead><tr><th>Διάρκεια</th><th>Τιμή</th></tr></thead>
          <tbody>
            <tr><td>2 ώρες</td><td><b>20€</b></td></tr>
            <tr><td>4 ώρες</td><td><b>35€</b></td></tr>
            <tr><td>6 ώρες</td><td><b>50€</b></td></tr>
            <tr><td>8 ώρες (full day)</td><td><b>70€</b></td></tr>
          </tbody>
        </table>
        <ul class="list-check mt-3">
          <li>Χωρητικότητα έως 8 άτομα</li>
          <li>Οθόνη παρουσιάσεων</li>
          <li>Ταχύτατο WiFi</li>
          <li>Catering (snack/lunch break) κατόπιν συνεννόησης</li>
        </ul>
      </div>
      <div class="reveal">
        <div class="card-blue card">
          <h3>Άλλες υπηρεσίες</h3>
          <h4 style="margin-top:20px;color:#fff">Εταιρικός Σταθερός Αριθμός</h4>
          <p>Παροχή εταιρικού σταθερού τηλεφώνου με ετήσιο πάγιο, ανάλογα με το πακέτο χρόνου ομιλίας.</p>
          <h4 style="margin-top:20px;color:#fff">Εταιρικός Αριθμός Κινητής</h4>
          <p>Επαγγελματικός αριθμός κινητής για ομαλή επικοινωνία με πελάτες.</p>
          <h4 style="margin-top:20px;color:#fff">Εταιρική Ιστοσελίδα</h4>
          <p>Δημιουργία εταιρικής ιστοσελίδας (όχι e-shop) με εφάπαξ κόστος <b>500€</b>.<br><span style="font-size:.85rem;opacity:.85">Δεν περιλαμβάνεται: domain, email, hosting.</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" data-testid="vo-cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <h2>Φορολογική έδρα σε <span style="color:var(--c-orange-light)">24 ώρες</span></h2>
      <p>Συμπλήρωσε τη φόρμα ενδιαφέροντος. Σου ετοιμάζουμε <b>έγγραφη προσφορά</b> και ολοκληρώνουμε τη σύμβαση εντός μίας εργάσιμης. Όλα remote — χωρίς επίσκεψη, χωρίς δέσμευση.</p>
      <div class="btn-row center">
        <a href="virtual-office-apply.php" class="btn btn-primary btn-lg" data-testid="vo-apply-btn">Ζήτα προσφορά →</a>
        <a href="mailto:sales@nexify.gr?subject=Ενδιαφέρον%20για%20Φορολογική%20Έδρα" class="btn btn-ghost btn-lg">✉️ sales@nexify.gr</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
