<?php
/**
 * NexiFy EN — Site Footer (English)
 * Included at the bottom of every English page in /en/.
 * All asset paths use ../ to reach the project root.
 */
?>

<footer class="site-footer" data-testid="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <img src="../logo-nexify-white.png" alt="NexiFy">
        <p>Integrated sales, technology &amp; business support services. One partner, one ecosystem.</p>
        <p><b>NexiFy I.K.E.</b><br>6 Moschonesion St, Aigaleo, GR-12242<br>+30 210 999 6300<br>info@nexify.gr</p>
      </div>
      <div>
        <h4>Services</h4>
        <ul>
          <li><a href="energy.php" data-testid="footer-link-energy">Energy</a></li>
          <li><a href="ecosystem.php" data-testid="footer-link-ecosystem">Ecosystem</a></li>
          <li><a href="virtual-office.php" data-testid="footer-link-virtual-office">Virtual Office</a></li>
          <li><a href="partners.php" data-testid="footer-link-partners">Partners</a></li>
        </ul>
      </div>
      <div>
        <h4>Company</h4>
        <ul>
          <li><a href="careers.php" data-testid="footer-link-careers">Careers</a></li>
          <li><a href="faq.php" data-testid="footer-link-faq">FAQ</a></li>
          <li><a href="contact.php" data-testid="footer-link-contact">Contact</a></li>
          <li><a href="gemi.php" data-testid="footer-link-gemi">Company Registry</a></li>
        </ul>
      </div>
      <div>
        <h4>Contact</h4>
        <ul>
          <li><a href="tel:+302109996300" data-testid="footer-tel">+30 210 999 6300</a></li>
          <li><a href="mailto:info@nexify.gr" data-testid="footer-email-info">info@nexify.gr</a></li>
          <li><a href="mailto:sales@nexify.gr" data-testid="footer-email-sales">sales@nexify.gr</a></li>
          <li>Mon–Fri 09:00–17:00</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div>© 2026 NexiFy I.K.E. · VAT: 802804085 · Company Reg. 183087203000</div>
      <div class="footer-legal-links">
        <a href="terms.php" data-testid="footer-terms">Terms of Use</a>
        <a href="privacy.php" data-testid="footer-privacy">Privacy Policy</a>
        <a href="cookies.php" data-testid="footer-cookies">Cookies</a>
        <a href="gemi.php" data-testid="footer-gemi">Company Registry</a>
      </div>
    </div>
  </div>
</footer>

<!-- Cookie Consent Banner (GDPR — English) -->
<div class="cookie-banner" id="cookieBanner" role="dialog" aria-live="polite" aria-label="Cookie Notice" data-testid="cookie-banner">
  <div class="cookie-banner-content">
    <span class="cookie-icon" aria-hidden="true">🍪</span>
    <div class="cookie-text">
      <strong>We Use Cookies</strong>
      <p>We use cookies to improve your experience and analyse website usage. Essential cookies always operate. Analytics cookies (Google Analytics) are only used with your consent. Read our <a href="cookies.php" data-testid="cookie-policy-link">Cookie Policy</a> &amp; <a href="privacy.php" data-testid="privacy-policy-link">Privacy Policy</a>.</p>
    </div>
  </div>
  <div class="cookie-actions">
    <button class="btn btn-outline btn-sm" data-cookie-reject data-testid="cookie-reject-btn">Essential Only</button>
    <button class="btn btn-primary btn-sm" data-cookie-accept data-testid="cookie-accept-btn">Accept All</button>
  </div>
</div>

<!-- Scripts (shared with GR — relative path ../) -->
<script src="../js/main.js?v=20260527b"></script>
<script src="../js/forms.js?v=20260527b"></script>
<script src="../js/responsive-utils.js?v=20260502e"></script>
<!-- Cookie Consent Manager (GDPR) — must load after DOM -->
<script src="../js/cookie-consent.js?v=20260527a"></script>
<?php if (!empty($extraScripts)) foreach ($extraScripts as $s): ?>
<script src="<?= htmlspecialchars($s, ENT_QUOTES, 'UTF-8') ?>"></script>
<?php endforeach; ?>

<!-- NexiFy Chatbot Widget -->
<script src="../chatbot/widget.js" data-api="../chatbot/api.php" data-site-root=""></script>
</body>
</html>
