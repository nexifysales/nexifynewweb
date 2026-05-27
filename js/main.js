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

  // Cookie banner
  var cb = document.getElementById('cookieBanner');
  if (cb) {
    if (!localStorage.getItem('nexify_cookies_ok')) {
      cb.classList.add('show');
    }
    var ok = cb.querySelector('[data-cookie-accept]');
    if (ok) ok.addEventListener('click', function(){
      localStorage.setItem('nexify_cookies_ok', '1');
      cb.classList.remove('show');
      // Fix CSS grid alignment for .price-card.featured after cookie-dismiss reflow.
      // The reflow caused by hiding the banner can shift the featured card by ~4px in
      // Chromium. Setting translateZ(0) via inline style after the frame forces the
      // browser to recomposite and snap the card to the correct grid position.
      requestAnimationFrame(function() {
        var featured = document.querySelector('.price-card.featured');
        if (!featured) return;
        featured.style.transform = 'translateZ(0)';
        // Restore CSS hover animation (inline style overrides :hover CSS rule).
        featured.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-4px)';
        });
        featured.addEventListener('mouseleave', function() {
          this.style.transform = 'translateZ(0)';
        });
      });
    });
  }

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
