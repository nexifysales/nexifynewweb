/**
 * NexiFy — GDPR Cookie Consent Manager
 * Handles cookie consent banner, user preferences, and GA4 consent updates.
 *
 * Consent is stored in a cookie named "nexify_consent" (1-year expiry).
 * Values: "accepted" | "rejected"
 *
 * GA4 integration:
 *   - analytics.php initialises gtag with consent_mode = denied (default)
 *   - On user accept → this file calls gtag('consent','update',{analytics_storage:'granted'})
 *   - On user reject / no action → analytics stay denied (no tracking)
 *
 * If GA4 ID is not yet configured in config.php, no gtag object exists and
 * the consent update calls are safely ignored.
 */

(function () {
  'use strict';

  // ── Config ────────────────────────────────────────────────────────────────
  var COOKIE_NAME = 'nexify_consent';
  var COOKIE_DAYS = 365; // 1 year

  // ── Cookie helpers ─────────────────────────────────────────────────────────

  function setCookie(name, value, days) {
    var expires = '';
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = '; expires=' + date.toUTCString();
    }
    // Use Secure flag in production; SameSite=Lax for same-site safety
    document.cookie = name + '=' + encodeURIComponent(value) + expires + '; path=/; SameSite=Lax';
  }

  function getCookie(name) {
    var nameEQ = name + '=';
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) === ' ') c = c.substring(1);
      if (c.indexOf(nameEQ) === 0) {
        return decodeURIComponent(c.substring(nameEQ.length));
      }
    }
    return null;
  }

  // ── GA4 consent helpers ────────────────────────────────────────────────────

  /**
   * Grant analytics consent.
   * analytics.php has already loaded gtag with consent denied — we just update it.
   */
  function grantAnalyticsConsent() {
    if (typeof window.gtag === 'function') {
      window.gtag('consent', 'update', {
        analytics_storage: 'granted'
      });
    }
  }

  /**
   * Deny analytics consent (reinforces default denied state).
   */
  function denyAnalyticsConsent() {
    if (typeof window.gtag === 'function') {
      window.gtag('consent', 'update', {
        analytics_storage: 'denied',
        ad_storage: 'denied',
        ad_user_data: 'denied',
        ad_personalization: 'denied'
      });
    }
  }

  // ── Banner UI ───────────────────────────────────────────────────────────────

  function showBanner() {
    var banner = document.getElementById('cookieBanner');
    if (banner) banner.classList.add('show');
  }

  function hideBanner() {
    var banner = document.getElementById('cookieBanner');
    if (!banner) return;
    banner.classList.remove('show');
    // Recomposite featured price card to avoid Chromium 4px reflow glitch
    requestAnimationFrame(function () {
      var featured = document.querySelector('.price-card.featured');
      if (!featured) return;
      featured.style.transform = 'translateZ(0)';
      featured.addEventListener('mouseenter', function () {
        this.style.transform = 'translateY(-4px)';
      });
      featured.addEventListener('mouseleave', function () {
        this.style.transform = 'translateZ(0)';
      });
    });
  }

  // ── Consent handlers ────────────────────────────────────────────────────────

  function onAccept() {
    setCookie(COOKIE_NAME, 'accepted', COOKIE_DAYS);
    hideBanner();
    grantAnalyticsConsent();
    // Legacy localStorage key for backward compatibility with old main.js
    try { localStorage.setItem('nexify_cookies_ok', '1'); } catch (e) {}
  }

  function onReject() {
    setCookie(COOKIE_NAME, 'rejected', COOKIE_DAYS);
    hideBanner();
    denyAnalyticsConsent();
    // Set legacy key so old main.js banner check doesn't conflict
    try { localStorage.setItem('nexify_cookies_ok', '1'); } catch (e) {}
  }

  // ── Init ────────────────────────────────────────────────────────────────────

  function init() {
    var existing = getCookie(COOKIE_NAME);

    if (existing === 'accepted') {
      // Previously accepted — grant consent for this page view
      grantAnalyticsConsent();
      try { localStorage.setItem('nexify_cookies_ok', '1'); } catch (e) {}
    } else if (existing === 'rejected') {
      // Previously rejected — reinforce denied state
      denyAnalyticsConsent();
      try { localStorage.setItem('nexify_cookies_ok', '1'); } catch (e) {}
    } else {
      // No preference yet — show the consent banner
      showBanner();
    }

    // Wire up banner buttons
    var banner = document.getElementById('cookieBanner');
    if (!banner) return;

    var acceptBtn = banner.querySelector('[data-cookie-accept]');
    var rejectBtn = banner.querySelector('[data-cookie-reject]');

    if (acceptBtn) acceptBtn.addEventListener('click', onAccept);
    if (rejectBtn) rejectBtn.addEventListener('click', onReject);
  }

  // Run after DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
