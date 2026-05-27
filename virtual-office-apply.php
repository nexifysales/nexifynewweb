<?php
$pageTitle       = 'Αίτηση Φορολογικής Έδρας — NexiFy';
$pageDescription = 'Συμπλήρωσε online τη φόρμα ενδιαφέροντος για Φορολογική Έδρα NexiFy. Έγγραφη προσφορά σε 24h.';
$pageCanonical   = 'https://nexify.gr/virtual-office-apply.php';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Αρχική</a> · <a href="virtual-office.php">Φορολογική Έδρα</a> · Αίτηση</div>
    <h1>Αίτηση Φορολογικής Έδρας <span style="color:var(--c-orange-light)">·</span> 24h</h1>
    <p>Συμπλήρωσε τα στοιχεία και πάτα <b>Αποστολή</b>. Σου ετοιμάζουμε έγγραφη προσφορά εντός μίας εργάσιμης. Μπορείς να εκτυπώσεις τη φόρμα ή να μας στείλεις τα συμπληρωμένα στοιχεία απευθείας στο sales@nexify.gr.</p>
  </div>
</section>

<section class="section" data-testid="apply-section">
  <div class="container container-narrow">

    <form id="appForm" class="app-form reveal" data-testid="apply-form">
      <div id="appFormBody">

        <div class="print-only" style="text-align:center;margin-bottom:30px;border-bottom:2px solid #000;padding-bottom:14px">
          <h2 style="margin:0;color:#000">NexiFy — Αίτηση Φορολογικής Έδρας</h2>
          <p style="margin:6px 0 0;color:#444;font-size:.9rem">NexiFy I.K.E. · ΑΦΜ 802804085 · ΓΕΜΗ 183087203000 · Μοσχονησίων 6, Αιγάλεω 12242 · sales@nexify.gr</p>
        </div>

        <!-- 1. Στοιχεία Επιχείρησης -->
        <div class="app-section" data-testid="apply-section-business">
          <h3 class="app-section-title"><span class="num">1</span> Στοιχεία Επιχείρησης</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_name">Επωνυμία *</label>
              <input type="text" class="form-control" id="f_name" name="name" required data-testid="apply-name-input">
            </div>
            <div class="form-group">
              <label for="f_afm">ΑΦΜ *</label>
              <input type="text" class="form-control" id="f_afm" name="afm" required pattern="[0-9]{9}" maxlength="9" placeholder="9 ψηφία" data-testid="apply-afm-input">
            </div>
            <div class="form-group">
              <label for="f_doy">ΔΟΥ *</label>
              <input type="text" class="form-control" id="f_doy" name="doy" required data-testid="apply-doy-input">
            </div>
            <div class="form-group">
              <label for="f_gemi">Αριθμός ΓΕΜΗ</label>
              <input type="text" class="form-control" id="f_gemi" name="gemi" placeholder="(αν υπάρχει)" data-testid="apply-gemi-input">
            </div>
          </div>
          <div class="form-group">
            <label>Τύπος επιχείρησης *</label>
            <div class="radio-row" data-testid="apply-biztype-row">
              <label><input type="radio" name="biz_type" value="ατομική" required> Ατομική</label>
              <label><input type="radio" name="biz_type" value="ΙΚΕ"> ΙΚΕ</label>
              <label><input type="radio" name="biz_type" value="ΕΠΕ"> ΕΠΕ</label>
              <label><input type="radio" name="biz_type" value="ΑΕ"> ΑΕ</label>
              <label><input type="radio" name="biz_type" value="ΟΕ"> ΟΕ</label>
              <label><input type="radio" name="biz_type" value="ΕΕ"> ΕΕ</label>
              <label><input type="radio" name="biz_type" value="υπό σύσταση"> Υπό σύσταση</label>
            </div>
          </div>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_activity">Δραστηριότητα *</label>
              <input type="text" class="form-control" id="f_activity" name="activity" required placeholder="π.χ. παροχή υπηρεσιών IT" data-testid="apply-activity-input">
            </div>
            <div class="form-group">
              <label for="f_kad">ΚΑΔ *</label>
              <input type="text" class="form-control" id="f_kad" name="kad" required placeholder="π.χ. 62.01" data-testid="apply-kad-input">
            </div>
          </div>
        </div>

        <!-- 2. Νόμιμος Εκπρόσωπος -->
        <div class="app-section" data-testid="apply-section-rep">
          <h3 class="app-section-title"><span class="num">2</span> Νόμιμος Εκπρόσωπος</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_rep_name">Ονοματεπώνυμο *</label>
              <input type="text" class="form-control" id="f_rep_name" name="rep_name" required data-testid="apply-rep-name-input">
            </div>
            <div class="form-group">
              <label for="f_rep_afm">ΑΦΜ / Ταυτότητα *</label>
              <input type="text" class="form-control" id="f_rep_afm" name="rep_afm" required data-testid="apply-rep-afm-input">
            </div>
            <div class="form-group">
              <label for="f_rep_phone">Τηλ. Επικοινωνίας *</label>
              <input type="tel" class="form-control" id="f_rep_phone" name="rep_phone" required data-testid="apply-rep-phone-input">
            </div>
            <div class="form-group">
              <label for="f_rep_email">Email Νόμιμου Εκπροσώπου *</label>
              <input type="email" class="form-control" id="f_rep_email" name="rep_email" required data-testid="apply-rep-email-input">
            </div>
          </div>
        </div>

        <!-- 3. Υπεύθυνος Επικοινωνίας -->
        <div class="app-section" data-testid="apply-section-contact">
          <h3 class="app-section-title"><span class="num">3</span> Υπεύθυνος Επικοινωνίας</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_contact_name">Ονοματεπώνυμο *</label>
              <input type="text" class="form-control" id="f_contact_name" name="contact_name" required data-testid="apply-contact-name-input">
            </div>
            <div class="form-group">
              <label for="f_contact_email">Email Επικοινωνίας *</label>
              <input type="email" class="form-control" id="f_contact_email" name="contact_email" required data-testid="apply-contact-email-input">
            </div>
          </div>
          <p style="font-size:.85rem;color:var(--c-muted);margin-top:-8px">Αν είναι το ίδιο πρόσωπο με τον Νόμιμο Εκπρόσωπο, ξαναγράψε τα στοιχεία.</p>
        </div>

        <!-- 4. Πρόγραμμα -->
        <div class="app-section" data-testid="apply-section-plan">
          <h3 class="app-section-title"><span class="num">4</span> Πρόγραμμα Μίσθωσης</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_start">Επιθυμητή Έναρξη *</label>
              <input type="date" class="form-control" id="f_start" name="start_date" required data-testid="apply-start-date-input">
            </div>
            <div class="form-group">
              <label for="f_plan">Πρόγραμμα *</label>
              <select class="form-control" id="f_plan" name="plan" required data-testid="apply-plan-select">
                <option value="">— Επιλογή —</option>
                <option value="trimino">Τρίμηνο · 180€</option>
                <option value="eksamino">Εξάμηνο · 340€</option>
                <option value="etisio">Ετήσιο · 500€ (δημοφιλές)</option>
                <option value="dietes">Διετές · 900€</option>
                <option value="pentaetes">Πενταετές · 2.000€</option>
              </select>
            </div>
            <div class="form-group">
              <label for="f_cost">Κόστος</label>
              <input type="text" class="form-control" id="f_cost" name="cost" readonly placeholder="(συμπληρώνεται αυτόματα)" data-testid="apply-cost-input">
            </div>
          </div>
        </div>

        <!-- 5. Τραπεζικά -->
        <div class="app-section" data-testid="apply-section-bank">
          <h3 class="app-section-title"><span class="num">5</span> Τραπεζικά Στοιχεία</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_bank">Τραπεζικό Ίδρυμα *</label>
              <input type="text" class="form-control" id="f_bank" name="bank" required placeholder="π.χ. Eurobank" data-testid="apply-bank-input">
            </div>
            <div class="form-group">
              <label for="f_iban">IBAN *</label>
              <input type="text" class="form-control" id="f_iban" name="iban" required placeholder="GR..." data-testid="apply-iban-input">
            </div>
          </div>
          <div class="form-group">
            <label for="f_iban_holder">Δικαιούχος *</label>
            <input type="text" class="form-control" id="f_iban_holder" name="iban_holder" required data-testid="apply-iban-holder-input">
          </div>
        </div>

        <!-- 6. Επιπλέον Παροχές -->
        <div class="app-section" data-testid="apply-section-extras">
          <h3 class="app-section-title"><span class="num">6</span> Επιπλέον Παροχές</h3>
          <div class="form-group">
            <label>Αίθουσα Συνεδριάσεων</label>
            <div class="radio-row">
              <label><input type="radio" name="meeting_room" value="ναι"> Ναι, ενδιαφέρομαι</label>
              <label><input type="radio" name="meeting_room" value="όχι" checked> Όχι</label>
            </div>
          </div>
          <div class="form-group">
            <label>Εταιρική Ιστοσελίδα <span style="color:var(--c-muted);font-weight:400">(εφάπαξ 500€)</span></label>
            <div class="radio-row">
              <label><input type="radio" name="website" value="ναι"> Ναι, ενδιαφέρομαι</label>
              <label><input type="radio" name="website" value="όχι" checked> Όχι</label>
            </div>
          </div>
          <div class="form-group">
            <label>Εταιρικός Σταθερός Αριθμός</label>
            <div class="radio-row">
              <label><input type="radio" name="phone_line" value="ναι"> Ναι, ενδιαφέρομαι</label>
              <label><input type="radio" name="phone_line" value="όχι" checked> Όχι</label>
            </div>
          </div>
        </div>

        <!-- 7. Σχόλια & Συγκατάθεση -->
        <div class="app-section" style="border-bottom:none" data-testid="apply-section-consent">
          <h3 class="app-section-title"><span class="num">7</span> Σχόλια &amp; Συγκατάθεση</h3>
          <div class="form-group">
            <label for="f_notes">Σχόλια / Ειδικές Απαιτήσεις <span style="color:var(--c-muted);font-weight:400">(προαιρ.)</span></label>
            <textarea class="form-control" id="f_notes" name="notes" rows="3" placeholder="π.χ. προτιμώμενος τρόπος επικοινωνίας, ώρες, ειδικές παροχές..." data-testid="apply-notes-textarea"></textarea>
          </div>
          <div class="form-group">
            <label style="font-weight:400;font-size:.92rem;display:flex;gap:10px;align-items:flex-start">
              <input type="checkbox" required style="margin-top:5px" data-testid="apply-consent-checkbox">
              <span>Συμφωνώ με την <a href="privacy.php">Πολιτική Απορρήτου</a> και επιβεβαιώνω ότι τα στοιχεία είναι αληθή. Συναινώ να με καλέσετε για επιβεβαίωση και αποστολή προσφοράς.</span>
            </label>
          </div>
        </div>

        <!-- Actions -->
        <div class="app-actions" data-testid="apply-actions">
          <input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
          <button type="submit" class="btn btn-primary btn-lg" data-testid="apply-submit-btn">📤 Αποστολή στο sales@nexify.gr</button>
          <button type="button" id="appPrint" class="btn btn-outline btn-lg" data-testid="apply-print-btn">🖨️ Εκτύπωση</button>
        </div>
        <p style="font-size:.82rem;color:var(--c-muted);margin-top:14px;text-align:center">Πατώντας Αποστολή, ανοίγει το email client σου με προσυμπληρωμένο το μήνυμα προς sales@nexify.gr.<br>Εναλλακτικά, μπορείς να εκτυπώσεις τη φόρμα και να την στείλεις σαν συνημμένο.</p>

      </div>

      <div id="appSuccess" class="app-success" data-testid="apply-success">
        <div class="check-big">✓</div>
        <h3 style="margin-bottom:8px">Ευχαριστούμε!</h3>
        <p style="margin-bottom:0">Τα στοιχεία στάλθηκαν. Λαμβάνεις σύντομα έγγραφη προσφορά στο email που μας έδωσες — εντός μίας εργάσιμης.</p>
        <a href="virtual-office.php" class="btn btn-outline mt-3" data-testid="apply-back-btn">Πίσω στη σελίδα Φορολογικής Έδρας</a>
      </div>
    </form>

  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
