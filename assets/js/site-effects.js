/**
 * GDSG site-wide depth & scroll effects.
 * Pairs with the "DEPTH & SCROLL MOTION EFFECTS" section in main.css.
 * Include once, site-wide, e.g. in includes/footer.php:
 *   <script src="assets/js/site-effects.js" defer></script>
 * No CDN dependency — vanilla JS only.
 */
(function () {
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------------------------------------------------------
     1) Scroll progress bar
     --------------------------------------------------------- */
  (function scrollProgress() {
    var bar = document.querySelector('.scroll-progress');
    if (!bar) return;
    function update() {
      var scrollTop = window.scrollY || document.documentElement.scrollTop;
      var docHeight = document.documentElement.scrollHeight - window.innerHeight;
      var pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
      bar.style.width = pct + '%';
    }
    document.addEventListener('scroll', update, { passive: true });
    update();
  })();

  /* ---------------------------------------------------------
     2) Scroll-triggered reveals (.reveal, with .stagger groups)
     --------------------------------------------------------- */
  (function reveals() {
    var groups = document.querySelectorAll('.stagger');
    groups.forEach(function (group) {
      Array.prototype.forEach.call(group.children, function (child, i) {
        child.style.setProperty('--stagger-index', i);
        child.classList.add('reveal');
      });
    });

    var targets = document.querySelectorAll('.reveal');
    if (!targets.length) return;

    if (reduceMotion || typeof IntersectionObserver === 'undefined') {
      targets.forEach(function (el) { el.classList.add('is-visible'); });
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15, rootMargin: '0px 0px -8% 0px' }
    );
    targets.forEach(function (el) { observer.observe(el); });
  })();

  /* ---------------------------------------------------------
     3) Pointer-driven 3D tilt (.tilt-card)
     --------------------------------------------------------- */
  (function tiltCards() {
    if (reduceMotion || window.matchMedia('(hover: none)').matches) return;
    var cards = document.querySelectorAll('.tilt-card');
    var maxTilt = 6; // degrees

    cards.forEach(function (card) {
      card.addEventListener('mousemove', function (e) {
        var rect = card.getBoundingClientRect();
        var px = (e.clientX - rect.left) / rect.width;  // 0..1
        var py = (e.clientY - rect.top) / rect.height;   // 0..1
        var rotateY = (px - 0.5) * maxTilt * 2;
        var rotateX = (0.5 - py) * maxTilt * 2;
        card.style.transform = 'perspective(900px) rotateX(' + rotateX.toFixed(2) + 'deg) rotateY(' + rotateY.toFixed(2) + 'deg)';
      });
      card.addEventListener('mouseleave', function () {
        card.style.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg)';
      });
    });
  })();

  /* ---------------------------------------------------------
     4) Scroll parallax ([data-parallax-speed], .parallax-bg)
     Usage: <div class="parallax-bg" data-parallax-speed="0.15"></div>
     Positive speed drifts slower than scroll (background feel);
     negative speed drifts faster (foreground feel).
     --------------------------------------------------------- */
  (function parallax() {
    if (reduceMotion) return;
    var layers = document.querySelectorAll('[data-parallax-speed]');
    if (!layers.length) return;

    var ticking = false;
    function update() {
      var scrollTop = window.scrollY || document.documentElement.scrollTop;
      layers.forEach(function (el) {
        var speed = parseFloat(el.getAttribute('data-parallax-speed')) || 0.15;
        el.style.transform = 'translate3d(0,' + (scrollTop * speed).toFixed(1) + 'px,0)';
      });
      ticking = false;
    }
    document.addEventListener('scroll', function () {
      if (!ticking) {
        window.requestAnimationFrame(update);
        ticking = true;
      }
    }, { passive: true });
    update();
  })();
})();