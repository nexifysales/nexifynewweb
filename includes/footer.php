<?php
/**
 * NexiFy — Site Footer
 * Included at the bottom of every page.
 * Renders the footer, cookie banner, and closing scripts.
 */
?>

<footer class="site-footer" data-testid="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <img src="logo-nexify-white.png" alt="NexiFy">
        <p>Ολοκληρωμένες υπηρεσίες πωλήσεων, τεχνολογίας &amp; επιχειρηματικής υποστήριξης. Ένας συνεργάτης, ένα οικοσύστημα.</p>
        <p><b>NexiFy I.K.E.</b><br>Μοσχονησίων 6, Αιγάλεω, Τ.Κ. 12242<br>+30 210 999 6300<br>info@nexify.gr</p>
      </div>
      <div>
        <h4>Υπηρεσίες</h4>
        <ul>
          <li><a href="energy.php" data-testid="footer-link-energy">Ενέργεια</a></li>
          <li><a href="ecosystem.php" data-testid="footer-link-ecosystem">Ecosystem</a></li>
          <li><a href="virtual-office.php" data-testid="footer-link-virtual-office">Φορολογική Έδρα</a></li>
          <li><a href="partners.php" data-testid="footer-link-partners">Συνεργάτες</a></li>
        </ul>
      </div>
      <div>
        <h4>Εταιρεία</h4>
        <ul>
          <li><a href="careers.php" data-testid="footer-link-careers">Καριέρα</a></li>
          <li><a href="faq.php" data-testid="footer-link-faq">FAQ</a></li>
          <li><a href="contact.php" data-testid="footer-link-contact">Επικοινωνία</a></li>
          <li><a href="gemi.php" data-testid="footer-link-gemi">Στοιχεία Γ.Ε.ΜΗ.</a></li>
        </ul>
      </div>
      <div>
        <h4>Επικοινωνία</h4>
        <ul>
          <li><a href="tel:+302109996300" data-testid="footer-tel">+30 210 999 6300</a></li>
          <li><a href="mailto:info@nexify.gr" data-testid="footer-email-info">info@nexify.gr</a></li>
          <li><a href="mailto:sales@nexify.gr" data-testid="footer-email-sales">sales@nexify.gr</a></li>
          <li>Δευ–Παρ 09:00–17:00</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div>© 2026 NexiFy I.K.E. · ΑΦΜ 802804085 · ΓΕΜΗ 183087203000</div>
      <div class="footer-legal-links">
        <a href="terms.php" data-testid="footer-terms">Όροι Χρήσης</a>
        <a href="privacy.php" data-testid="footer-privacy">Απόρρητο</a>
        <a href="cookies.php" data-testid="footer-cookies">Cookies</a>
        <a href="gemi.php" data-testid="footer-gemi">ΓΕ.Μ.Η.</a>
      </div>
    </div>
  </div>
</footer>

<!-- Cookie Consent Banner (GDPR) -->
<div class="cookie-banner" id="cookieBanner" role="dialog" aria-live="polite" aria-label="Ειδοποίηση Cookies" data-testid="cookie-banner">
  <div class="cookie-banner-content">
    <span class="cookie-icon" aria-hidden="true">🍪</span>
    <div class="cookie-text">
      <strong>Χρησιμοποιούμε Cookies</strong>
      <p>Χρησιμοποιούμε cookies για να βελτιώσουμε την εμπειρία σας και να αναλύσουμε τη χρήση της ιστοσελίδας μας. Τα απαραίτητα cookies λειτουργούν πάντα. Τα αναλυτικά cookies (Google Analytics) χρησιμοποιούνται μόνο με τη συγκατάθεσή σας. Διαβάστε την <a href="cookies.php" data-testid="cookie-policy-link">Πολιτική Cookies</a> &amp; <a href="privacy.php" data-testid="privacy-policy-link">Απόρρητο</a>.</p>
    </div>
  </div>
  <div class="cookie-actions">
    <button class="btn btn-outline btn-sm" data-cookie-reject data-testid="cookie-reject-btn">Μόνο Απαραίτητα</button>
    <button class="btn btn-primary btn-sm" data-cookie-accept data-testid="cookie-accept-btn">Αποδοχή Όλων</button>
  </div>
</div>

<!-- Scripts -->
<script src="js/main.js?v=20260527b"></script>
<script src="js/forms.js?v=20260502e"></script>
<script src="js/responsive-utils.js?v=20260502e"></script>
<!-- Cookie Consent Manager (GDPR) — must load after DOM, handles GA4 loading -->
<script src="js/cookie-consent.js?v=20260527a"></script>
<?php if (!empty($extraScripts)) foreach ($extraScripts as $s): ?>
<script src="<?= htmlspecialchars($s, ENT_QUOTES, 'UTF-8') ?>"></script>
<?php endforeach; ?>

<!-- NexiFy Chatbot Widget -->
<script src="chatbot/widget.js" data-api="chatbot/api.php" data-site-root=""></script>
</body>
</html>
