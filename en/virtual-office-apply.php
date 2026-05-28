<?php
$pageTitle       = 'Registered Office Application — NexiFy';
$pageDescription = 'Complete the online interest form for a NexiFy Registered Office. Written quote within 24 hours.';
$pageCanonical   = 'https://nexify.gr/en/virtual-office-apply.php';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · <a href="virtual-office.php">Virtual Office</a> · Application</div>
    <h1>Registered Office Application <span style="color:var(--c-orange-light)">·</span> 24h</h1>
    <p>Fill in your details and click <b>Send</b>. We will prepare a written quote within one business day. You can also print the form or email the completed details directly to sales@nexify.gr.</p>
  </div>
</section>

<section class="section" data-testid="apply-section">
  <div class="container container-narrow">

    <form id="appForm" class="app-form reveal" data-testid="apply-form">
      <div id="appFormBody">

        <div class="print-only" style="text-align:center;margin-bottom:30px;border-bottom:2px solid #000;padding-bottom:14px">
          <h2 style="margin:0;color:#000">NexiFy — Registered Office Application</h2>
          <p style="margin:6px 0 0;color:#444;font-size:.9rem">NexiFy I.K.E. · VAT 802804085 · GEMI 183087203000 · 6 Moschonesion St, Aigaleo GR-12242 · sales@nexify.gr</p>
        </div>

        <!-- 1. Business Details -->
        <div class="app-section" data-testid="apply-section-business">
          <h3 class="app-section-title"><span class="num">1</span> Business Details</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_name">Company Name *</label>
              <input type="text" class="form-control" id="f_name" name="name" required data-testid="apply-name-input">
            </div>
            <div class="form-group">
              <label for="f_afm">VAT Number *</label>
              <input type="text" class="form-control" id="f_afm" name="afm" required pattern="[0-9]{9}" maxlength="9" placeholder="9 digits" data-testid="apply-afm-input">
            </div>
            <div class="form-group">
              <label for="f_doy">Tax Office *</label>
              <input type="text" class="form-control" id="f_doy" name="doy" required data-testid="apply-doy-input">
            </div>
            <div class="form-group">
              <label for="f_gemi">GEMI Number</label>
              <input type="text" class="form-control" id="f_gemi" name="gemi" placeholder="(if applicable)" data-testid="apply-gemi-input">
            </div>
          </div>
          <div class="form-group">
            <label>Business Type *</label>
            <div class="radio-row" data-testid="apply-biztype-row">
              <label><input type="radio" name="biz_type" value="sole-trader" required> Sole Trader</label>
              <label><input type="radio" name="biz_type" value="IKE"> I.K.E. (Ltd)</label>
              <label><input type="radio" name="biz_type" value="EPE"> E.P.E. (LLC)</label>
              <label><input type="radio" name="biz_type" value="AE"> A.E. (SA)</label>
              <label><input type="radio" name="biz_type" value="OE"> O.E. (GP)</label>
              <label><input type="radio" name="biz_type" value="EE"> E.E. (LP)</label>
              <label><input type="radio" name="biz_type" value="in-formation"> In Formation</label>
            </div>
          </div>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_activity">Business Activity *</label>
              <input type="text" class="form-control" id="f_activity" name="activity" required placeholder="e.g. IT services" data-testid="apply-activity-input">
            </div>
            <div class="form-group">
              <label for="f_kad">Activity Code (KAD) *</label>
              <input type="text" class="form-control" id="f_kad" name="kad" required placeholder="e.g. 62.01" data-testid="apply-kad-input">
            </div>
          </div>
        </div>

        <!-- 2. Legal Representative -->
        <div class="app-section" data-testid="apply-section-rep">
          <h3 class="app-section-title"><span class="num">2</span> Legal Representative</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_rep_name">Full Name *</label>
              <input type="text" class="form-control" id="f_rep_name" name="rep_name" required data-testid="apply-rep-name-input">
            </div>
            <div class="form-group">
              <label for="f_rep_afm">VAT / ID Number *</label>
              <input type="text" class="form-control" id="f_rep_afm" name="rep_afm" required data-testid="apply-rep-afm-input">
            </div>
            <div class="form-group">
              <label for="f_rep_phone">Contact Phone *</label>
              <input type="tel" class="form-control" id="f_rep_phone" name="rep_phone" required data-testid="apply-rep-phone-input">
            </div>
            <div class="form-group">
              <label for="f_rep_email">Legal Representative Email *</label>
              <input type="email" class="form-control" id="f_rep_email" name="rep_email" required data-testid="apply-rep-email-input">
            </div>
          </div>
        </div>

        <!-- 3. Contact Person -->
        <div class="app-section" data-testid="apply-section-contact">
          <h3 class="app-section-title"><span class="num">3</span> Contact Person</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_contact_name">Full Name *</label>
              <input type="text" class="form-control" id="f_contact_name" name="contact_name" required data-testid="apply-contact-name-input">
            </div>
            <div class="form-group">
              <label for="f_contact_email">Contact Email *</label>
              <input type="email" class="form-control" id="f_contact_email" name="contact_email" required data-testid="apply-contact-email-input">
            </div>
          </div>
          <p style="font-size:.85rem;color:var(--c-muted);margin-top:-8px">If the contact person is the same as the legal representative, please re-enter the details.</p>
        </div>

        <!-- 4. Lease Plan -->
        <div class="app-section" data-testid="apply-section-plan">
          <h3 class="app-section-title"><span class="num">4</span> Lease Plan</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_start">Desired Start Date *</label>
              <input type="date" class="form-control" id="f_start" name="start_date" required data-testid="apply-start-date-input">
            </div>
            <div class="form-group">
              <label for="f_plan">Plan *</label>
              <select class="form-control" id="f_plan" name="plan" required data-testid="apply-plan-select">
                <option value="">— Select —</option>
                <option value="trimino">3 Months · €180</option>
                <option value="eksamino">6 Months · €340</option>
                <option value="etisio">Annual · €500 (popular)</option>
                <option value="dietes">2 Years · €900</option>
                <option value="pentaetes">5 Years · €2,000</option>
              </select>
            </div>
            <div class="form-group">
              <label for="f_cost">Cost</label>
              <input type="text" class="form-control" id="f_cost" name="cost" readonly placeholder="(auto-filled)" data-testid="apply-cost-input">
            </div>
          </div>
        </div>

        <!-- 5. Banking Details -->
        <div class="app-section" data-testid="apply-section-bank">
          <h3 class="app-section-title"><span class="num">5</span> Banking Details</h3>
          <div class="app-grid-2">
            <div class="form-group">
              <label for="f_bank">Bank *</label>
              <input type="text" class="form-control" id="f_bank" name="bank" required placeholder="e.g. Eurobank" data-testid="apply-bank-input">
            </div>
            <div class="form-group">
              <label for="f_iban">IBAN *</label>
              <input type="text" class="form-control" id="f_iban" name="iban" required placeholder="GR..." data-testid="apply-iban-input">
            </div>
          </div>
          <div class="form-group">
            <label for="f_iban_holder">Account Holder *</label>
            <input type="text" class="form-control" id="f_iban_holder" name="iban_holder" required data-testid="apply-iban-holder-input">
          </div>
        </div>

        <!-- 6. Additional Services -->
        <div class="app-section" data-testid="apply-section-extras">
          <h3 class="app-section-title"><span class="num">6</span> Additional Services</h3>
          <div class="form-group">
            <label>Meeting Room</label>
            <div class="radio-row">
              <label><input type="radio" name="meeting_room" value="yes"> Yes, interested</label>
              <label><input type="radio" name="meeting_room" value="no" checked> No</label>
            </div>
          </div>
          <div class="form-group">
            <label>Corporate Website <span style="color:var(--c-muted);font-weight:400">(one-off €500)</span></label>
            <div class="radio-row">
              <label><input type="radio" name="website" value="yes"> Yes, interested</label>
              <label><input type="radio" name="website" value="no" checked> No</label>
            </div>
          </div>
          <div class="form-group">
            <label>Corporate Fixed Phone Line</label>
            <div class="radio-row">
              <label><input type="radio" name="phone_line" value="yes"> Yes, interested</label>
              <label><input type="radio" name="phone_line" value="no" checked> No</label>
            </div>
          </div>
        </div>

        <!-- 7. Comments & Consent -->
        <div class="app-section" style="border-bottom:none" data-testid="apply-section-consent">
          <h3 class="app-section-title"><span class="num">7</span> Comments &amp; Consent</h3>
          <div class="form-group">
            <label for="f_notes">Comments / Special Requirements <span style="color:var(--c-muted);font-weight:400">(optional)</span></label>
            <textarea class="form-control" id="f_notes" name="notes" rows="3" placeholder="e.g. preferred contact method, hours, special services..." data-testid="apply-notes-textarea"></textarea>
          </div>
          <div class="form-group">
            <label class="gdpr-label" style="font-weight:400;font-size:.92rem;display:flex;gap:10px;align-items:flex-start;cursor:pointer">
              <input type="checkbox" name="gdpr_consent" value="1" required
                     data-testid="apply-consent-checkbox">
              <span>I have read and agree to the <a href="privacy.php" target="_blank">Privacy Policy</a> and the <a href="terms.php" target="_blank">Terms of Use</a>. I confirm that the details provided are accurate and I consent to being contacted. *</span>
            </label>
          </div>
        </div>

        <!-- Actions -->
        <div class="app-actions" data-testid="apply-actions">
          <input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
          <button type="submit" class="btn btn-primary btn-lg" data-testid="apply-submit-btn">📤 Send to sales@nexify.gr</button>
          <button type="button" id="appPrint" class="btn btn-outline btn-lg" data-testid="apply-print-btn">🖨️ Print Form</button>
        </div>
        <p style="font-size:.82rem;color:var(--c-muted);margin-top:14px;text-align:center">Your details are sent securely to sales@nexify.gr.<br>Alternatively, you can print the form and send it as an attachment.</p>

      </div>

      <div id="appSuccess" class="app-success" data-testid="apply-success">
        <div class="check-big">✓</div>
        <h3 style="margin-bottom:8px">Thank you!</h3>
        <p style="margin-bottom:0">Your details have been sent. You will shortly receive a written quote at the email address you provided — within one business day.</p>
        <a href="virtual-office.php" class="btn btn-outline mt-3" data-testid="apply-back-btn">Back to Virtual Office</a>
      </div>
    </form>

  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
