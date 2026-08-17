(function () {
  const root = document.querySelector('.gdo-hero');
  if (!root) return;

  const stage = root.querySelector('.hero-pin-stage');
  if (!stage) return;

  const heroPanel = root.querySelector('.hero-overlay-panel');
  const readout = document.getElementById('gdo-readout');
  const latNode = document.getElementById('gdo-lat');
  const lonNode = document.getElementById('gdo-lon');
  const altNode = document.getElementById('gdo-alt');
  const nodeNode = document.getElementById('gdo-nodes');

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function clamp(value, min, max) {
    return Math.min(Math.max(value, min), max);
  }

  function getDepthValue(name, fallback) {
    const currentValue = root.style.getPropertyValue(name);
    const parsed = parseFloat(currentValue || fallback);
    return Number.isFinite(parsed) ? parsed : fallback;
  }

  function updateDepthFieldFromScroll() {
    if (!stage) return;

    const rect = stage.getBoundingClientRect();
    const viewportHeight = window.innerHeight || 1;
    const progress = clamp((viewportHeight - rect.top) / (rect.height + viewportHeight), 0, 1);
    const scrollStrength = (progress - 0.5) * 2;

    const x = scrollStrength * 18;
    const y = (0.5 - clamp(rect.top / viewportHeight, 0, 1)) * 24;
    const tilt = scrollStrength * 12;

    root.style.setProperty('--depth-x', x.toFixed(2) + 'px');
    root.style.setProperty('--depth-y', y.toFixed(2) + 'px');
    root.style.setProperty('--depth-tilt', tilt.toFixed(2) + 'deg');

    if (heroPanel) {
      heroPanel.style.transform = 'translate3d(' + (x * 0.18).toFixed(2) + 'px, ' + (y * 0.14).toFixed(2) + 'px, 0)';
    }

    if (readout && latNode && lonNode && altNode && nodeNode) {
      const lat = (scrollStrength * 12 + 15.4).toFixed(4);
      const lon = (scrollStrength * 18 - 25.2).toFixed(4);
      const alt = (75 + progress * 340).toFixed(0) + 'km';
      const nodes = Math.round(160 + progress * 120);
      latNode.textContent = lat;
      lonNode.textContent = lon;
      altNode.textContent = alt;
      nodeNode.textContent = nodes;
    }
  }

  let ticking = false;
  function requestDepthUpdate() {
    if (ticking) return;
    ticking = true;
    window.requestAnimationFrame(function () {
      updateDepthFieldFromScroll();
      ticking = false;
    });
  }

  if (!prefersReducedMotion) {
    window.addEventListener('scroll', requestDepthUpdate, { passive: true });
    window.addEventListener('resize', requestDepthUpdate);
    updateDepthFieldFromScroll();
  }

  const globeCanvas = document.getElementById('home-three-visual');
  const globeVisual = globeCanvas && globeCanvas.querySelector('canvas');

  if (globeCanvas && globeVisual && !prefersReducedMotion) {
    const target = globeCanvas;
    let pointerX = 0;
    let pointerY = 0;

    target.addEventListener('pointermove', function (event) {
      const rect = target.getBoundingClientRect();
      const px = (event.clientX - rect.left) / rect.width;
      const py = (event.clientY - rect.top) / rect.height;
      pointerX = (px - 0.5) * 18;
      pointerY = (py - 0.5) * 18;

      const currentX = getDepthValue('--depth-x', 0);
      const currentY = getDepthValue('--depth-y', 0);
      root.style.setProperty('--depth-x', (currentX + pointerX * 0.2).toFixed(2) + 'px');
      root.style.setProperty('--depth-y', (currentY + pointerY * 0.2).toFixed(2) + 'px');
    });

    target.addEventListener('pointerleave', function () {
      pointerX = 0;
      pointerY = 0;
      updateDepthFieldFromScroll();
    });
  }
})();
