/**
 * NexiFy — Responsive Utilities
 * js/responsive-utils.js
 *
 * Handles: breakpoint detection, device analytics, safe area,
 * lazy loading enhancement, sticky CTA bar, scroll header state.
 */

(function () {
  'use strict';

  /* ──────────────────────────────────────────────
     1. Breakpoint System
  ────────────────────────────────────────────── */
  const BP = {
    xs:  480,
    sm:  767,
    md:  834,
    lg:  1024,
    xl:  1440,
    xxl: 2560
  };

  /**
   * Get current breakpoint name
   * @returns {string}
   */
  function getBreakpoint() {
    const w = window.innerWidth;
    if (w <= BP.xs)  return 'mobile-small';
    if (w <= BP.sm)  return 'mobile-large';
    if (w <= BP.md)  return 'tablet-portrait';
    if (w <= BP.lg)  return 'tablet-landscape';
    if (w <= BP.xl)  return 'laptop';
    if (w <= BP.xxl) return 'desktop';
    return 'ultrawide';
  }

  /**
   * Check if current viewport is mobile
   * Uses pointer coarse + narrow viewport
   */
  function isMobile() {
    return window.innerWidth <= 767 ||
           window.matchMedia('(pointer: coarse)').matches;
  }

  /**
   * Check if current viewport is touch device
   */
  function isTouchDevice() {
    return ('ontouchstart' in window) ||
           (navigator.maxTouchPoints > 0) ||
           window.matchMedia('(pointer: coarse)').matches;
  }

  // Expose to window for other scripts
  window.NexifyResponsive = { getBreakpoint, isMobile, isTouchDevice };

  /* ──────────────────────────────────────────────
     2. Set device class on <html> for CSS hooks
  ────────────────────────────────────────────── */
  function setDeviceClasses() {
    const html = document.documentElement;
    const bp = getBreakpoint();

    // Remove old bp classes
    html.classList.remove(
      'bp-mobile-small', 'bp-mobile-large', 'bp-tablet-portrait',
      'bp-tablet-landscape', 'bp-laptop', 'bp-desktop', 'bp-ultrawide'
    );
    html.classList.add('bp-' + bp);

    // Touch/hover classification
    if (isTouchDevice()) {
      html.classList.add('touch-device');
      html.classList.remove('pointer-device');
    } else {
      html.classList.add('pointer-device');
      html.classList.remove('touch-device');
    }
  }

  setDeviceClasses();
  window.addEventListener('resize', debounce(setDeviceClasses, 150));

  /* ──────────────────────────────────────────────
     3. Analytics: Device Tracking
  ────────────────────────────────────────────── */
  function trackDeviceInfo() {
    const info = {
      breakpoint: getBreakpoint(),
      viewportWidth: window.innerWidth,
      viewportHeight: window.innerHeight,
      devicePixelRatio: window.devicePixelRatio || 1,
      isTouch: isTouchDevice(),
      orientation: window.innerWidth > window.innerHeight ? 'landscape' : 'portrait',
      platform: navigator.platform || 'unknown',
      userAgent: navigator.userAgent
    };

    // Google Analytics 4 — custom dimensions
    if (typeof gtag === 'function') {
      gtag('set', {
        device_type: info.breakpoint,
        screen_dpr: info.devicePixelRatio.toFixed(1)
      });
    }

    // Store for debugging
    window.__nexifyDevice = info;

    return info;
  }

  // Run on load
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', trackDeviceInfo);
  } else {
    trackDeviceInfo();
  }

  /* ──────────────────────────────────────────────
     4. Sticky Header — Scroll State
  ────────────────────────────────────────────── */
  (function initStickyHeader() {
    const header = document.querySelector('.site-header');
    if (!header) return;

    let lastScroll = 0;
    let ticking = false;

    function updateHeader() {
      const currentScroll = window.scrollY;

      if (currentScroll > 40) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }

      // Hide on scroll down, show on scroll up (mobile)
      if (window.innerWidth <= 767) {
        if (currentScroll > lastScroll && currentScroll > 200) {
          header.classList.add('header-hidden');
        } else {
          header.classList.remove('header-hidden');
        }
      }

      lastScroll = currentScroll;
      ticking = false;
    }

    window.addEventListener('scroll', function () {
      if (!ticking) {
        requestAnimationFrame(updateHeader);
        ticking = true;
      }
    }, { passive: true });
  })();

  /* ──────────────────────────────────────────────
     5. Sticky CTA Bar — Mobile
  ────────────────────────────────────────────── */
  (function initStickyCTA() {
    const ctaBar = document.querySelector('.sticky-cta-bar');
    if (!ctaBar) return;

    // Add body class for padding compensation
    document.body.classList.add('has-sticky-cta');

    // Hide when user scrolls near footer
    const footer = document.querySelector('.site-footer');
    if (!footer) return;

    const observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          ctaBar.style.opacity = '0';
          ctaBar.style.pointerEvents = 'none';
        } else {
          ctaBar.style.opacity = '1';
          ctaBar.style.pointerEvents = 'auto';
        }
      });
    }, { threshold: 0.1 });

    observer.observe(footer);
  })();

  /* ──────────────────────────────────────────────
     6. Lazy Image Loading Enhancement
  ────────────────────────────────────────────── */
  (function initLazyImages() {
    if ('IntersectionObserver' in window) {
      const imageObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.classList.add('loaded');
            imageObserver.unobserve(img);
          }
        });
      }, {
        rootMargin: '200px 0px'
      });

      document.querySelectorAll('img[loading="lazy"]').forEach(function (img) {
        imageObserver.observe(img);
      });
    } else {
      // Fallback: show all images
      document.querySelectorAll('img[loading="lazy"]').forEach(function (img) {
        img.classList.add('loaded');
      });
    }
  })();

  /* ──────────────────────────────────────────────
     7. Navigation Overlay (mobile)
     Bulletproof implementation for Android & iOS.
     Uses visibility/opacity (NO transforms) to avoid
     horizontal scroll, blank-page, and scroll-snap bugs.
  ────────────────────────────────────────────── */
  (function initNavOverlay() {
    // Guard: only initialise once
    if (window.__nexifyNavReady) return;
    window.__nexifyNavReady = true;

    // Create backdrop overlay if missing
    if (!document.querySelector('.nav-overlay')) {
      var ov = document.createElement('div');
      ov.className = 'nav-overlay';
      ov.setAttribute('aria-hidden', 'true');
      document.body.appendChild(ov);
    }

    var btn = document.querySelector('[data-testid="menu-toggle"]');
    var nav = document.querySelector('[data-testid="main-nav"]');
    var overlay = document.querySelector('.nav-overlay');

    if (!btn || !nav) return;

    // Remove any stale click listeners (from cached old main.js) by cloning
    var freshBtn = btn.cloneNode(true);
    btn.parentNode.replaceChild(freshBtn, btn);
    btn = freshBtn;

    // ── Scroll lock ───────────────────────────────────────────
    // Correct Android/iOS scroll-lock: save position, fix body.
    // Avoids the "page jumps to top" bug that overflow:hidden causes.
    var _scrollY = 0;

    function lockScroll() {
      _scrollY = window.pageYOffset || window.scrollY || 0;
      document.body.style.position = 'fixed';
      document.body.style.top = '-' + _scrollY + 'px';
      document.body.style.left = '0';
      document.body.style.right = '0';
      document.body.style.width = '100%';
    }

    function unlockScroll() {
      document.body.style.position = '';
      document.body.style.top = '';
      document.body.style.left = '';
      document.body.style.right = '';
      document.body.style.width = '';
      window.scrollTo(0, _scrollY);
    }

    // ── Open / Close ─────────────────────────────────────────
    function openNav() {
      nav.classList.add('is-open');
      btn.classList.add('is-open');
      if (overlay) overlay.classList.add('is-visible');
      btn.setAttribute('aria-expanded', 'true');
      btn.setAttribute('aria-label', 'Κλείσιμο μενού');
      lockScroll();
      // Focus first link
      var first = nav.querySelector('a');
      if (first) setTimeout(function () { first.focus(); }, 50);
    }

    function closeNav(restoreFocus) {
      nav.classList.remove('is-open');
      btn.classList.remove('is-open');
      if (overlay) overlay.classList.remove('is-visible');
      btn.setAttribute('aria-expanded', 'false');
      btn.setAttribute('aria-label', 'Άνοιγμα μενού');
      unlockScroll();
      if (restoreFocus !== false) btn.focus();
    }

    // ── Toggle ────────────────────────────────────────────────
    btn.addEventListener('click', function () {
      if (nav.classList.contains('is-open')) {
        closeNav(true);
      } else {
        openNav();
      }
    });

    // ── Close on overlay click ────────────────────────────────
    if (overlay) {
      overlay.addEventListener('click', function () {
        closeNav(true);
      });
    }

    // ── Close on Esc ─────────────────────────────────────────
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('is-open')) {
        closeNav(true);
      }
    });

    // ── Focus trap (keyboard nav) ─────────────────────────────
    nav.addEventListener('keydown', function (e) {
      if (!nav.classList.contains('is-open') || e.key !== 'Tab') return;
      var items = Array.prototype.slice.call(nav.querySelectorAll(
        'a[href], button:not([disabled])'
      )).filter(function (el) { return el.offsetParent !== null; });
      if (!items.length) return;
      var first = items[0], last = items[items.length - 1];
      if (e.shiftKey && document.activeElement === first) {
        e.preventDefault(); btn.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault(); first.focus();
      }
    });

    // ── Close on nav-link click ───────────────────────────────
    nav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        closeNav(false);
      });
    });

  })();

  /* ──────────────────────────────────────────────
     8. Orientation Change Handler
  ────────────────────────────────────────────── */
  window.addEventListener('orientationchange', function () {
    // Small delay for browser to update dimensions
    setTimeout(function () {
      setDeviceClasses();

      // Close mobile nav on orientation change
      const nav = document.querySelector('.main-nav');
      const overlay = document.querySelector('.nav-overlay');
      if (nav && nav.classList.contains('is-open')) {
        nav.classList.remove('is-open');
        if (overlay) overlay.classList.remove('is-visible');
        document.body.style.overflow = '';
      }
    }, 200);
  });

  /* ──────────────────────────────────────────────
     9. CSS Custom Property: actual viewport height
        (fixes iOS Safari 100vh bug)
  ────────────────────────────────────────────── */
  function setVhProperty() {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--actual-vh', vh + 'px');
  }

  setVhProperty();
  window.addEventListener('resize', debounce(setVhProperty, 100), { passive: true });

  /* ──────────────────────────────────────────────
     10. Scroll Depth Tracking (Analytics)
  ────────────────────────────────────────────── */
  (function initScrollTracking() {
    const milestones = [25, 50, 75, 90, 100];
    const reached = new Set();

    function checkScrollDepth() {
      const scrollTop = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (docHeight <= 0) return;

      const pct = Math.round((scrollTop / docHeight) * 100);

      milestones.forEach(function (milestone) {
        if (pct >= milestone && !reached.has(milestone)) {
          reached.add(milestone);

          if (typeof gtag === 'function') {
            gtag('event', 'scroll_depth', {
              depth_threshold: milestone,
              device_type: getBreakpoint()
            });
          }
        }
      });
    }

    window.addEventListener('scroll', debounce(checkScrollDepth, 500), { passive: true });
  })();

  /* ──────────────────────────────────────────────
     Utility: Debounce
  ────────────────────────────────────────────── */
  function debounce(fn, delay) {
    let timeout;
    return function () {
      clearTimeout(timeout);
      timeout = setTimeout(fn, delay);
    };
  }

})();
