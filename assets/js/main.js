document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.querySelector('.navbar-toggler');
  const target = document.getElementById('siteNavbar');

  if (!toggle || !target || !window.bootstrap || !window.bootstrap.Collapse) {
    return;
  }

  const collapse = bootstrap.Collapse.getOrCreateInstance(target, { toggle: false });

  toggle.addEventListener('click', function () {
    collapse.toggle();
  });

  target.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      if (window.innerWidth < 992) {
        collapse.hide();
      }
    });
  });
});
