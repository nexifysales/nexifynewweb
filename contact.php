<?php
$pageTitle       = 'Επικοινωνία — NexiFy';
$pageDescription = 'Στείλε μας μήνυμα ή κάλεσε στο 210 999 6300. Απαντάμε σε 1 εργάσιμη ημέρα.';
$pageCanonical   = 'https://nexify.gr/contact.php';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Αρχική</a> · Επικοινωνία</div>
    <h1>Ας <span style="color:var(--c-orange-light)">μιλήσουμε</span></h1>
    <p>Καμία δέσμευση, καμία πίεση. Σύντομη συζήτηση για να δούμε αν ταιριάζουμε.</p>
  </div>
</section>

<section class="section" data-testid="contact-section">
  <div class="container">
    <div class="grid" style="grid-template-columns: 1.2fr 1fr; gap: 50px; align-items:flex-start">
      <form id="contactForm" class="card reveal" data-testid="contact-form">
        <h3>Στείλε μας μήνυμα</h3>
        <p style="color:var(--c-muted);font-size:.95rem;margin-bottom:24px">Απαντάμε σε 1 εργάσιμη ημέρα.</p>

        <div class="form-row">
          <div class="form-group">
            <label for="name">Όνομα *</label>
            <input type="text" class="form-control" id="name" name="name" required data-testid="contact-name-input">
          </div>
          <div class="form-group">
            <label for="phone">Τηλέφωνο *</label>
            <input type="tel" class="form-control" id="phone" name="phone" required data-testid="contact-phone-input">
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" class="form-control" id="email" name="email" required data-testid="contact-email-input">
        </div>

        <div class="form-group">
          <label for="topic">Πώς μπορούμε να βοηθήσουμε; *</label>
          <select class="form-control" id="topic" name="topic" required data-testid="contact-topic-select">
            <option value="">— Επιλογή —</option>
            <option value="energy">Ενέργεια — ιδιώτης</option>
            <option value="energy-business">Ενέργεια — επιχείρηση</option>
            <option value="callcenter">Τηλεφωνικό Κέντρο</option>
            <option value="tech">Τεχνολογία (CRM, ERP, AI)</option>
            <option value="virtual-office">Φορολογική Έδρα</option>
            <option value="partners">Συνεργασία</option>
            <option value="careers">Καριέρα</option>
            <option value="other">Άλλο</option>
          </select>
        </div>

        <div class="form-group">
          <label for="message">Μήνυμα *</label>
          <textarea class="form-control" id="message" name="message" required placeholder="Πες μας περιληπτικά τι σε ενδιαφέρει..." data-testid="contact-message-textarea"></textarea>
        </div>

        <div class="form-group">
          <label class="gdpr-label" style="font-weight:400;font-size:.9rem;display:flex;gap:10px;align-items:flex-start;cursor:pointer">
            <input type="checkbox" name="gdpr_consent" value="1" required
                   style="margin-top:3px;width:18px;height:18px;min-width:18px;cursor:pointer;accent-color:var(--c-blue,#3268ac)"
                   data-testid="contact-privacy-checkbox">
            <span>Έχω διαβάσει και συμφωνώ με την <a href="privacy.php" target="_blank">Πολιτική Απορρήτου</a> και τους <a href="terms.php" target="_blank">Όρους Χρήσης</a>. *</span>
          </label>
        </div>

        <input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="checkbox" name="botcheck" class="hidden" style="display: none;">
        <button type="submit" class="btn btn-primary btn-block btn-lg" data-testid="contact-submit-btn">Αποστολή μηνύματος →</button>
        <p style="font-size:.8rem;color:var(--c-muted);margin-top:14px">Τα στοιχεία σας αποστέλλονται με ασφάλεια στο info@nexify.gr. Απαντάμε σε 1 εργάσιμη ημέρα.</p>
      </form>

      <div class="reveal">
        <div class="card-blue card" data-testid="contact-info-card">
          <h3>Άμεση επικοινωνία</h3>
          <p style="color:#fff;font-size:1.1rem"><b>📞 +30 210 999 6300</b><br>Δευτέρα–Παρασκευή 09:00–17:00</p>
          <p style="color:#fff"><b>✉️ Γενικά:</b> <a href="mailto:info@nexify.gr" style="color:#fff;text-decoration:underline">info@nexify.gr</a></p>
          <p style="color:#fff"><b>💼 Πωλήσεις:</b> <a href="mailto:sales@nexify.gr" style="color:#fff;text-decoration:underline">sales@nexify.gr</a></p>
          <p style="color:#fff"><b>👥 Καριέρα (HR):</b> <a href="mailto:hr@nexify.gr" style="color:#fff;text-decoration:underline">hr@nexify.gr</a></p>
        </div>

        <div class="card mt-4" data-testid="contact-address-card">
          <h3>📍 Έδρα &amp; γραφεία</h3>
          <p><b>NexiFy I.K.E.</b><br>Μοσχονησίων 6<br>Αιγάλεω, Τ.Κ. 12242<br>Δυτικός Τομέας Αθηνών</p>
          <p style="font-size:.9rem;color:var(--c-muted)">ΑΦΜ: 802804085 · ΓΕΜΗ: 183087203000</p>
          <a href="https://www.google.com/maps?q=Μοσχονησίων+6+Αιγάλεω" target="_blank" rel="noopener" class="btn btn-outline btn-sm" data-testid="contact-map-btn">🗺️ Δες στον χάρτη</a>
        </div>

        <div class="card mt-4" data-testid="contact-energy-card">
          <h3>⚡ Έχεις λογαριασμό ρεύματος;</h3>
          <p>Στείλε μας τον τελευταίο σου λογαριασμό στο <a href="mailto:sales@nexify.gr">sales@nexify.gr</a> και επιστρέφουμε σε 24h εξατομικευμένη σύγκριση όλων των παρόχων.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
