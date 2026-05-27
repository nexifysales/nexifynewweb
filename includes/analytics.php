<?php
/**
 * NexiFy — Google Analytics 4 Snippet
 *
 * HOW IT WORKS:
 *   This file outputs the GA4 gtag.js script tags.
 *   It is included in header.php but the actual tracking fires only
 *   after the user grants analytics consent via the GDPR cookie banner
 *   (consent_analytics cookie = "1").
 *
 *   Consent flow (managed by the GDPR ticket):
 *     1. Page loads → gtag initialised with consent_mode = denied (default)
 *     2. User accepts analytics → JS sets cookie + calls gtag('consent','update',...)
 *     3. GA4 starts firing hits
 *
 *   Until the GDPR banner is live, GA4 will NOT fire because
 *   consent is always treated as denied by default below.
 *
 * REQUIRED CONFIG:
 *   GA_MEASUREMENT_ID must be defined in config.php.
 */

// Only output if we have a real Measurement ID configured
if (!defined('GA_MEASUREMENT_ID') || GA_MEASUREMENT_ID === 'G-XXXXXXXXXX') {
    // GA not configured yet — skip silently
    return;
}

$gaId = htmlspecialchars(GA_MEASUREMENT_ID, ENT_QUOTES, 'UTF-8');
?>
<!-- Google Analytics 4 — loads only after GDPR consent is granted -->
<!-- Consent Mode v2: default deny, updated by GDPR banner JS -->
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}

// Consent Mode v2 — default: analytics denied until user accepts
gtag('consent', 'default', {
    'analytics_storage': 'denied',
    'ad_storage':        'denied',
    'ad_user_data':      'denied',
    'ad_personalization':'denied',
    'wait_for_update':   500
});
</script>

<!-- Google tag (gtag.js) — async, non-blocking -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= $gaId ?>"></script>
<script>
gtag('js', new Date());
gtag('config', '<?= $gaId ?>', {
    'send_page_view': true,
    'anonymize_ip':   true
});

// Restore consent if user previously accepted.
// cookie-consent.js sets nexify_consent=accepted; legacy name was consent_analytics=1.
(function(){
    try {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var c = cookies[i].trim();
            if (c === 'nexify_consent=accepted' || c.startsWith('nexify_consent=accepted') || c === 'consent_analytics=1') {
                gtag('consent', 'update', {
                    'analytics_storage': 'granted'
                });
                break;
            }
        }
    } catch(e) {}
})();
</script>
