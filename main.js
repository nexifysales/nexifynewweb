// NEXIFY - main.js (root copy — not served; mobile menu handled by js/responsive-utils.js)
(function(){
  // Mobile menu toggle is handled entirely by js/responsive-utils.js

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
      requestAnimationFrame(function() {
        var featured = document.querySelector('.price-card.featured');
        if (!featured) return;
        featured.style.transform = 'translateZ(0)';
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
  var path = location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.main-nav a').forEach(function(a){
    var href = a.getAttribute('href');
    if (href === path) a.classList.add('active');
  });
  // (Contact form handler moved to forms.js)
})();

// (Callback form handler moved to forms.js)

// (Application form handler moved to forms.js)
