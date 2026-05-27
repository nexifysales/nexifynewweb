<?php
$pageTitle       = 'Στοιχεία ΓΕ.Μ.Η. — NexiFy I.K.E.';
$pageDescription = 'Επίσημα εταιρικά στοιχεία NexiFy I.K.E. (ΑΦΜ 802804085, ΓΕΜΗ 183087203000) όπως απαιτεί η νομοθεσία.';
$pageCanonical   = 'https://nexify.gr/gemi.php';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Αρχική</a> · Στοιχεία ΓΕ.Μ.Η.</div>
    <h1>Στοιχεία Εταιρείας <span style="color:var(--c-orange-light)">ΓΕ.Μ.Η.</span></h1>
    <p>Δημοσίευση εταιρικών στοιχείων όπως απαιτείται από τη νομοθεσία περί ΓΕ.Μ.Η. (Ν. 3419/2005).</p>
  </div>
</section>

<section class="section" data-testid="gemi-section">
  <div class="container container-narrow">
    <div class="card" data-testid="gemi-table-card">
      <h2 style="margin-bottom:30px">Επίσημα στοιχεία NexiFy I.K.E.</h2>
      <table class="table" data-testid="gemi-table">
        <tbody>
          <tr><th style="width:40%">Επωνυμία</th><td>NexiFy I.K.E.</td></tr>
          <tr><th>Επωνυμία (λατινικοί χαρακτήρες)</th><td>NexiFy P.C.</td></tr>
          <tr><th>Νομική Μορφή</th><td>Ιδιωτική Κεφαλαιουχική Εταιρεία (Ι.Κ.Ε.)</td></tr>
          <tr><th>Αριθμός ΓΕ.Μ.Η.</th><td><b>183087203000</b></td></tr>
          <tr><th>Α.Φ.Μ.</th><td><b>802804085</b></td></tr>
          <tr><th>Δ.Ο.Υ.</th><td>ΚΕ.ΦΟ.ΔΕ. Αττικής</td></tr>
          <tr><th>Ημερομηνία Σύστασης</th><td>11/03/2025</td></tr>
          <tr><th>Κατάσταση</th><td><span class="badge badge-green">Ενεργή</span> από 11/03/2025</td></tr>
          <tr><th>Διεύθυνση</th><td>Μοσχονησίων 6</td></tr>
          <tr><th>Τ.Κ.</th><td>12242</td></tr>
          <tr><th>Περιοχή</th><td>Αιγάλεω · Δυτικός Τομέας Αθηνών</td></tr>
          <tr><th>Τηλέφωνο</th><td><a href="tel:+302109996300">+30 210 999 6300</a></td></tr>
          <tr><th>Ιστοσελίδα</th><td><a href="https://www.nexify.gr">https://www.nexify.gr</a></td></tr>
          <tr><th>Ημερ. Λήξης 1ης Χρήσης</th><td>31/12/2025</td></tr>
          <tr><th>Διάρκεια Εταιρείας</th><td>20 έτη (Λήξη 10/03/2045)</td></tr>
          <tr><th>Κεφάλαιο</th><td>30.000 €</td></tr>
          <tr><th>Διαχειριστής</th><td>Σταύρος Πολυκανδρίτης</td></tr>
        </tbody>
      </table>
    </div>

    <div class="card mt-4" data-testid="gemi-verify-card">
      <h3>Επαλήθευση στοιχείων</h3>
      <p>Όλα τα παραπάνω στοιχεία είναι δημόσια διαθέσιμα και επαληθεύσιμα μέσω της επίσημης πλατφόρμας του Γενικού Εμπορικού Μητρώου.</p>
      <a href="https://services.businessportal.gr" target="_blank" rel="noopener" class="btn btn-outline" data-testid="gemi-portal-btn">Επίσκεψη ΓΕ.Μ.Η. →</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
