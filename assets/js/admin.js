// Admin sidebar toggle for small screens
(function(){
  const toggle = document.getElementById('sidebarToggle');
  const layout = document.querySelector('.container-fluid.admin-layout');
  const sidebar = document.querySelector('nav.admin-sidebar');
  let overlay = null;

  function createOverlay(){
    overlay = document.createElement('div');
    overlay.className = 'admin-sidebar-overlay';
    document.body.appendChild(overlay);
    overlay.addEventListener('click', closeSidebar);
  }

  function openSidebar(){
    if(!layout) return;
    layout.classList.add('sidebar-open');
    if(!overlay) createOverlay();
    // prevent body scroll
    document.body.style.overflow = 'hidden';
  }

  function closeSidebar(){
    if(!layout) return;
    layout.classList.remove('sidebar-open');
    if(overlay){
      overlay.removeEventListener('click', closeSidebar);
      document.body.removeChild(overlay);
      overlay = null;
    }
    document.body.style.overflow = '';
  }

  if(toggle){
    toggle.addEventListener('click', function(e){
      e.stopPropagation();
      if(layout.classList.contains('sidebar-open')) closeSidebar(); else openSidebar();
    });
  }

  // Close when clicking outside sidebar
  document.addEventListener('click', function(e){
    if(!layout || !layout.classList.contains('sidebar-open')) return;
    if(sidebar && !sidebar.contains(e.target)){
      closeSidebar();
    }
  });

  // Close on Escape
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape') closeSidebar();
  });
})();

// Handle "View" full description buttons in partners list
document.addEventListener('click', function(e){
  const btn = e.target.closest && e.target.closest('.view-desc');
  if (!btn) return;
  const full = btn.getAttribute('data-full-desc') || '';
  const modalEl = document.getElementById('partnerDescModal');
  if (!modalEl) return;
  const content = modalEl.querySelector('#partnerDescContent');
  if (content) content.innerHTML = full.replace(/\n/g, '<br>');
  const bsModal = new bootstrap.Modal(modalEl);
  bsModal.show();
});

// Smooth-scroll to anchors within admin pages and focus first input for forms
document.addEventListener('DOMContentLoaded', function(){
  if (window.location.hash) {
    const id = window.location.hash.substring(1);
    const el = document.getElementById(id);
    if (el) {
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      // focus first input inside the element
      const input = el.querySelector('input, textarea, select');
      if (input) input.focus({ preventScroll: true });
    }
  }
  // Also make top Add links scroll smoothly
  document.querySelectorAll('a[href^="#"]').forEach(function(a){
    a.addEventListener('click', function(e){
      const targetId = this.getAttribute('href').substring(1);
      const target = document.getElementById(targetId);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        const input = target.querySelector('input, textarea, select');
        if (input) input.focus({ preventScroll: true });
        history.replaceState(null, '', '#' + targetId);
      }
    });
  });
});
