// NEXIFY - main.js
// Note: Mobile menu toggle is handled entirely by js/responsive-utils.js
// which provides full WCAG 2.1 AA accessibility (aria-expanded, aria-label,
// focus trap, Esc key, overlay close, body scroll lock, X animation).
(function(){
  // Reveal on scroll
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if (e.isIntersecting){ e.target.classList.add('on'); io.unobserve(e.target); }
      });
    }, { threshold: .12 });
    document.querySelectorAll('.reveal').forEach(function(el){ io.observe(el); });
  } else {
    document.querySelectorAll('.reveal').forEach(function(el){ el.classList.add('on'); });
  }

  // Cookie banner is now fully handled by js/cookie-consent.js (GDPR upgrade).
  // That script manages the nexify_consent cookie, GA4 consent updates,
  // and the accept/reject buttons. No duplicate logic needed here.

  // Active nav highlighting based on current page
  var path = location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.main-nav a').forEach(function(a){
    var href = a.getAttribute('href');
    if (href === path) a.classList.add('active');
  });

  // Sticky header: add .is-scrolled class when user scrolls down so we can
  // emphasise the bar with a stronger background + subtle shadow.
  var header = document.querySelector('.site-header');
  if (header) {
    var ticking = false;
    var update = function () {
      if (window.scrollY > 8) {
        header.classList.add('is-scrolled');
      } else {
        header.classList.remove('is-scrolled');
      }
      ticking = false;
    };
    window.addEventListener('scroll', function () {
      if (!ticking) {
        window.requestAnimationFrame(update);
        ticking = true;
      }
    }, { passive: true });
    update();
  }
  // (Contact form handler moved to forms.js)
})();

// (Callback form handler moved to forms.js)

// (Application form handler moved to forms.js)
