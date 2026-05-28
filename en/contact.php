<?php
$pageTitle       = 'Contact Us — NexiFy';
$pageDescription = 'Send us a message or call +30 210 999 6300. We respond within 1 business day.';
$pageCanonical   = 'https://nexify.gr/en/contact.php';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · Contact</div>
    <h1>Let's <span style="color:var(--c-orange-light)">Talk</span></h1>
    <p>No commitment, no pressure. A short conversation to see if we're the right fit for each other.</p>
  </div>
</section>

<section class="section" data-testid="contact-section">
  <div class="container">
    <div class="grid" style="grid-template-columns: 1.2fr 1fr; gap: 50px; align-items:flex-start">
      <form id="contactForm" class="card reveal" data-testid="contact-form">
        <h3>Send Us a Message</h3>
        <p style="color:var(--c-muted);font-size:.95rem;margin-bottom:24px">We respond within 1 business day.</p>

        <div class="form-row">
          <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" class="form-control" id="name" name="name" required data-testid="contact-name-input">
          </div>
          <div class="form-group">
            <label for="phone">Phone *</label>
            <input type="tel" class="form-control" id="phone" name="phone" required data-testid="contact-phone-input">
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" class="form-control" id="email" name="email" required data-testid="contact-email-input">
        </div>

        <div class="form-group">
          <label for="topic">How can we help? *</label>
          <select class="form-control" id="topic" name="topic" required data-testid="contact-topic-select">
            <option value="">— Select —</option>
            <option value="energy">Energy — Residential</option>
            <option value="energy-business">Energy — Business</option>
            <option value="callcenter">Call Centre</option>
            <option value="tech">Technology (CRM, ERP, AI)</option>
            <option value="virtual-office">Registered Office</option>
            <option value="partners">Partnership</option>
            <option value="careers">Careers</option>
            <option value="other">Other</option>
          </select>
        </div>

        <div class="form-group">
          <label for="message">Message *</label>
          <textarea class="form-control" id="message" name="message" required placeholder="Briefly tell us what you're interested in..." data-testid="contact-message-textarea"></textarea>
        </div>

        <div class="form-group">
          <label class="gdpr-label" style="font-weight:400;font-size:.9rem;display:flex;gap:10px;align-items:flex-start;cursor:pointer">
            <input type="checkbox" name="gdpr_consent" value="1" required
                   data-testid="contact-privacy-checkbox">
            <span>I have read and agree to the <a href="privacy.php" target="_blank">Privacy Policy</a> and the <a href="terms.php" target="_blank">Terms of Use</a>. *</span>
          </label>
        </div>

        <input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="checkbox" name="botcheck" class="hidden" style="display: none;">
        <button type="submit" class="btn btn-primary btn-block btn-lg" data-testid="contact-submit-btn">Send Message →</button>
        <p style="font-size:.8rem;color:var(--c-muted);margin-top:14px">Your details are sent securely to info@nexify.gr. We respond within 1 business day.</p>
      </form>

      <div class="reveal">
        <div class="card-blue card" data-testid="contact-info-card">
          <h3>Direct Contact</h3>
          <p style="color:#fff;font-size:1.1rem"><b>📞 +30 210 999 6300</b><br>Monday–Friday 09:00–17:00</p>
          <p style="color:#fff"><b>✉️ General:</b> <a href="mailto:info@nexify.gr" style="color:#fff;text-decoration:underline">info@nexify.gr</a></p>
          <p style="color:#fff"><b>💼 Sales:</b> <a href="mailto:sales@nexify.gr" style="color:#fff;text-decoration:underline">sales@nexify.gr</a></p>
          <p style="color:#fff"><b>👥 Careers (HR):</b> <a href="mailto:hr@nexify.gr" style="color:#fff;text-decoration:underline">hr@nexify.gr</a></p>
        </div>

        <div class="card mt-4" data-testid="contact-address-card">
          <h3>📍 Headquarters &amp; Offices</h3>
          <p><b>NexiFy I.K.E.</b><br>6 Moschonesion St<br>Aigaleo, GR-12242<br>West Athens</p>
          <p style="font-size:.9rem;color:var(--c-muted)">VAT: 802804085 · Company Reg.: 183087203000</p>
          <a href="https://www.google.com/maps?q=Moschonesion+6+Aigaleo" target="_blank" rel="noopener" class="btn btn-outline btn-sm" data-testid="contact-map-btn">🗺️ View on Map</a>
        </div>

        <div class="card mt-4" data-testid="contact-energy-card">
          <h3>⚡ Got an electricity bill?</h3>
          <p>Send us your latest bill at <a href="mailto:sales@nexify.gr">sales@nexify.gr</a> and we'll return a personalised comparison of all providers within 24 hours.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
