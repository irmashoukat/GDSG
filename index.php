<?php
$pageTitle = 'Home';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

$projects = get_projects($pdo, 12);
$projectImageFiles = glob(__DIR__ . '/all project images/*.{jpg,jpeg,png,webp}', GLOB_BRACE) ?: [];
$normalizeProjectName = static function ($value) {
  $value = strtolower((string)$value);
  $value = str_replace(['–', '—', '&'], ['-', '-', 'and'], $value);
  return preg_replace('/[^a-z0-9]+/', '', $value);
};
$findProjectImage = static function ($title) use ($projectImageFiles, $normalizeProjectName) {
  $normalizedTitle = $normalizeProjectName($title);
  foreach ($projectImageFiles as $file) {
    $normalizedFilename = $normalizeProjectName(pathinfo($file, PATHINFO_FILENAME));
    if ($normalizedFilename === $normalizedTitle || strpos($normalizedFilename, $normalizedTitle) !== false || strpos($normalizedTitle, $normalizedFilename) !== false) {
      return 'all project images/' . basename($file);
    }
  }
  return null;
};
$domains = [
    ['title' => 'GeoAI', 'icon' => 'psychology', 'text' => 'Developing advanced machine learning architectures specialized for spatial datasets, topological neural networks, and generative modeling of geographic phenomena.'],
    ['title' => 'Earth Observation', 'icon' => 'public', 'text' => 'Processing multi-spectral satellite imagery and LiDAR data to monitor environmental change, track deforestation, and quantify urban sprawl dynamics.'],
    ['title' => 'Spatial Data Science', 'icon' => 'insights', 'text' => 'Applying rigorous statistical methods to uncover complex spatial patterns, analyze human mobility networks, and model epidemiological spread.'],
];
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:FILL@0..1&display=swap">
<style>
  .home-reference { --home-ink:#002819; --home-red:#b32821; --home-green:#0d6b4e; --home-bg:#f7f9fb; background:var(--home-bg); color:#191c1e; }
  .home-reference, .home-reference * { box-sizing:border-box; }
  body:has(.home-reference) { --home-ink:#002819; --home-green:#0d6b4e; }
  body:has(.home-reference) .site-header { background:rgba(247,249,251,.88); border-bottom:1px solid #e0e3e5; box-shadow:0 2px 12px rgba(0,0,0,.04); }
  body:has(.home-reference) .site-header .navbar { min-height:88px; padding:10px 60px; background:transparent !important; border-bottom:0; }
  body:has(.home-reference) .site-header .navbar-brand { padding-left:0; margin-right:30px; }
  body:has(.home-reference) .site-header .navbar-brand img { width:58px; height:58px; box-shadow:none; }
  body:has(.home-reference) .site-header .navbar-brand img { width:42px; height:42px; border-radius:50%; object-fit:cover; }
  body:has(.home-reference) .site-header .navbar-brand-copy { display:flex; flex-direction:column; gap:2px; line-height:1; }
  body:has(.home-reference) .site-header .navbar-brand-copy strong { color:var(--home-ink); font:700 20px/1 'Hanken Grotesk',sans-serif; }
  body:has(.home-reference) .site-header .navbar-brand-copy small { color:var(--home-green); font:500 8px/1.3 'JetBrains Mono',monospace; letter-spacing:.03em; text-transform:uppercase; }
  body:has(.home-reference) .site-header .navbar-nav { gap:18px; }
  body:has(.home-reference) .site-header .navbar-nav .nav-link { padding:10px 4px; color:var(--home-ink) !important; font:500 14px 'Hanken Grotesk',sans-serif; }
  body:has(.home-reference) .site-header .navbar-nav .nav-link.active { border-bottom:2px solid var(--home-green); }
  body:has(.home-reference) .site-header .navbar-contact { margin:0 0 0 28px; padding:11px 22px; background:var(--home-green); color:#fff; border-color:var(--home-green); }
  body:has(.home-reference) .site-header .navbar-contact:hover { background:#00452f; color:#fff; }
  body:has(.home-reference) .site-header .navbar-toggler { display:none; }
  .home-reference .home-hero { position:relative; min-height:calc(100vh - 88px); display:flex; align-items:center; overflow:hidden; background:linear-gradient(105deg,rgba(247,249,251,.98) 0%,rgba(247,249,251,.9) 40%,rgba(178,225,229,.65) 65%,rgba(79,86,202,.8) 100%); }
  .home-reference .home-hero::after { content:''; position:absolute; z-index:0; width:min(62vw,calc(100vh - 96px),790px); height:min(62vw,calc(100vh - 96px),790px); right:5%; top:50%; transform:translateY(-50%); border-radius:50%; clip-path:circle(50%); background:url('assets/images/home-globe-reference.png') center/125% 125% no-repeat; box-shadow:inset -45px -25px 80px rgba(0,25,60,.6), inset 25px 20px 55px rgba(255,255,255,.4); }
  .home-reference .home-hero-inner { position:relative; z-index:1; width:min(1320px,calc(100% - 128px)); margin:0 auto; padding:110px 0 70px; }
  .home-reference .home-hero-copy { max-width:570px; }
  .home-reference .home-kicker { display:inline-flex; align-items:center; gap:9px; border:1px solid #c0c9c1; border-radius:999px; padding:7px 13px; color:#404943; font:500 12px/1 'JetBrains Mono',monospace; letter-spacing:.05em; text-transform:uppercase; background:rgba(255,255,255,.52); }
  .home-reference .home-kicker::before { content:''; width:8px; height:8px; border-radius:50%; background:#b32821; }
  .home-reference h1 { margin:25px 0 22px; color:#2f8f68; font:700 clamp(42px,5.2vw,72px)/1.08 'Hanken Grotesk',sans-serif; letter-spacing:-.02em; }
  .home-reference h1 em { color:var(--home-green); font-style:normal; }
  .home-reference .home-hero-copy > p { max-width:520px; color:#404943; font:400 18px/1.6 Inter,sans-serif; }
  .home-reference .home-actions { display:flex; gap:16px; margin-top:30px; flex-wrap:wrap; }
  .home-reference .home-button { display:inline-flex; align-items:center; gap:12px; padding:14px 22px; border-radius:999px; border:1px solid var(--home-ink); text-decoration:none; font:500 14px 'Hanken Grotesk',sans-serif; }
  .home-reference .home-button.primary { background:var(--home-ink); color:#fff; }
  .home-reference .home-button.secondary { color:var(--home-ink); background:rgba(255,255,255,.55); }
  .home-reference .home-button:hover { transform:translateY(-2px); }
  .home-reference .home-section { width:min(1320px,calc(100% - 128px)); margin:0 auto; padding:78px 0; }
  .home-reference .home-section-heading { margin-bottom:32px; }
  .home-reference .home-section-eyebrow { display:block; margin-bottom:10px; color:var(--home-green); font:500 11px 'JetBrains Mono',monospace; letter-spacing:.12em; text-transform:uppercase; }
  .home-reference > .home-section .home-section-eyebrow { color:#2f8f68; font-weight:700; }
  .home-reference .projects-band .home-section-eyebrow { color:#b8efd0; font-weight:700; }
  .home-reference .home-section-heading h2 { color:var(--home-ink); font:600 40px/1.2 'Hanken Grotesk',sans-serif; margin:0 0 10px; }
  .home-reference .home-section-heading h2 em { color:var(--home-green); font-style:normal; }
  .home-reference .home-rule { width:48px; height:3px; background:var(--home-red); border-radius:4px; }
  .home-reference .domain-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
  .home-reference .domain-card { display:flex; flex-direction:column; min-height:285px; padding:30px; border:1px solid #c0c9c1; border-radius:10px; background:#fff; transition:.25s ease; }
  .home-reference .domain-card:hover { border-left:3px solid var(--home-red); box-shadow:0 8px 30px rgba(0,0,0,.06); transform:translateY(-3px); }
  .home-reference .domain-card-heading { display:block; margin-bottom:18px; }
  .home-reference .domain-icon { display:grid; place-items:center; width:48px; height:48px; margin-bottom:22px; border-radius:9px; background:#e6f3ed; color:var(--home-green); font-family:'Material Symbols Outlined'; font-size:27px; }
  .home-reference .domain-card-heading .domain-icon { margin-bottom:22px; }
  .home-reference .domain-card h3 { margin:0; color:var(--home-ink); font:500 24px/1.3 'Hanken Grotesk',sans-serif; }
  .home-reference .domain-card p { flex:1; margin:0; color:#404943; font:400 15px/1.55 Inter,sans-serif; }
  .home-reference .learn-more { display:inline-flex; gap:7px; margin-top:22px; color:#2f8f68; font:500 11px 'JetBrains Mono',monospace; letter-spacing:.05em; text-transform:uppercase; }
  .home-reference .learn-more:hover { color:#00452f; }
  .home-reference .projects-band { background:linear-gradient(135deg,#00452f 0%,#075b59 52%,#123846 100%); color:#fff; }
  .home-reference .projects-band .home-section-heading h2 { color:#fff; }
  .home-reference .projects-heading-row { display:flex; justify-content:space-between; align-items:end; gap:20px; }
  .home-reference .projects-heading-row > a { color:#d8f0e3; font:500 12px 'JetBrains Mono',monospace; text-transform:uppercase; }
  .home-reference .project-carousel-viewport { overflow:hidden; width:100%; }
  .home-reference .project-grid { display:flex; gap:24px; transition:transform .65s ease; will-change:transform; }
  .home-reference .project-card { flex:0 0 calc((100% - 48px) / 3); overflow:hidden; border-radius:8px; background:#fff; color:var(--home-ink); }
  .home-reference .project-card img { display:block; width:100%; height:180px; object-fit:cover; }
  .home-reference .project-card-body { padding:20px; }
  .home-reference .project-card h3 { margin:0 0 10px; color:var(--home-ink); font:600 19px/1.3 'Hanken Grotesk',sans-serif; }
  .home-reference .project-card p { overflow:hidden; margin:0 0 16px; color:#404943; font:400 14px/1.5 Inter,sans-serif; white-space:nowrap; mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent); -webkit-mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent); }
  .home-reference .project-description-track { display:inline-flex; width:max-content; animation:home-description-right 14s linear infinite; }
  .home-reference .project-description-track span { flex:0 0 auto; padding-right:70px; }
  @keyframes home-description-right { from { transform:translateX(0); } to { transform:translateX(-50%); } }
  .home-reference .project-card a { color:var(--home-green); font:500 13px Inter,sans-serif; }
  .home-reference .stats { display:grid; grid-template-columns:repeat(3,1fr); text-align:center; border-top:1px solid #c0c9c1; border-bottom:1px solid #c0c9c1; }
  .home-reference .stat { padding:45px 15px; border-right:1px solid #c0c9c1; }
  .home-reference .stat:last-child { border-right:0; }
  .home-reference .stat strong { display:block; color:var(--home-ink); font:700 40px 'Hanken Grotesk',sans-serif; }
  .home-reference .stat span { color:#404943; font:500 11px 'JetBrains Mono',monospace; letter-spacing:.08em; text-transform:uppercase; }
  .home-reference .updates { display:flex; justify-content:space-between; align-items:center; gap:30px; padding:42px 46px; border:1px solid #73aec0; border-radius:8px; background:#dff2f7; color:#123846; box-shadow:0 10px 25px rgba(18,56,70,.08); position:relative; }
  .home-reference .updates::before { content:'SIG // DIGEST'; position:absolute; top:-9px; left:30px; padding:0 10px; background:var(--home-bg); color:#b32821; font:700 11px 'JetBrains Mono',monospace; letter-spacing:.12em; }
  .home-reference .updates h2 { margin:0 0 8px; color:#123846; font:600 30px 'Hanken Grotesk',sans-serif; }
  .home-reference .updates p { margin:0; color:#365763; font:400 14px/1.5 Inter,sans-serif; }
  .home-reference .updates .home-button.secondary { background:#2f8f68; border-color:#2f8f68; color:#fff; }
  .home-reference .updates .home-button.secondary:hover { background:#00452f; border-color:#00452f; color:#fff; }
  body:has(.home-reference) .site-footer-featured { margin-top:0; padding:58px 0 22px; background:linear-gradient(135deg,#00452f 0%,#075b59 52%,#123846 100%); border-top:3px solid #2f8f68; color:#d8f0e3; }
  body:has(.home-reference) .site-footer-featured .footer-grid { gap:0; }
  body:has(.home-reference) .site-footer-featured .footer-column { padding:0 28px; border-right:1px solid rgba(216,240,227,.18); }
  body:has(.home-reference) .site-footer-featured .footer-brand-lockup { display:flex; align-items:center; gap:14px; margin-bottom:16px; }
  body:has(.home-reference) .site-footer-featured .footer-brand-lockup img { width:42px; height:42px; border-radius:50%; object-fit:cover; background:transparent; padding:0; position:relative; top:-1px; margin-bottom:-1px; }
  body:has(.home-reference) .site-footer-featured .footer-brand-lockup h5 { margin:0 0 4px; }
  body:has(.home-reference) .site-footer-featured .footer-full-name { margin:0; color:#fff; font:500 9px/1.35 'JetBrains Mono',monospace; letter-spacing:.04em; text-transform:uppercase; }
  body:has(.home-reference) .site-footer-featured .footer-social-links { display:flex; gap:10px; margin-top:16px; }
  body:has(.home-reference) .site-footer-featured .footer-social-links a { display:grid; place-items:center; width:28px; height:28px; border:1px solid rgba(216,240,227,.28); border-radius:50%; color:#d8f0e3; font:500 13px Inter,sans-serif; text-decoration:none; }
  body:has(.home-reference) .site-footer-featured .footer-social-links a:hover { border-color:#b8efd0; background:rgba(184,239,208,.12); }
  body:has(.home-reference) .site-footer-featured .footer-contact-line { display:flex; align-items:flex-start; gap:9px; }
  body:has(.home-reference) .site-footer-featured .footer-contact-icon { flex:0 0 17px; color:#b8efd0; font:20px/1 'Material Symbols Outlined'; }
  body:has(.home-reference) .site-footer-featured .footer-column:first-child { padding-left:0; }
  body:has(.home-reference) .site-footer-featured .footer-column:last-child { border-right:0; padding-right:0; }
  body:has(.home-reference) .site-footer-featured h5,
  body:has(.home-reference) .site-footer-featured h6 { color:#fff; font:600 12px 'JetBrains Mono',monospace; letter-spacing:.12em; text-transform:uppercase; }
  body:has(.home-reference) .site-footer-featured h5 { font-size:20px; letter-spacing:.04em; }
  body:has(.home-reference) .site-footer-featured p,
  body:has(.home-reference) .site-footer-featured li { color:#d8f0e3; font:400 13px/1.65 Inter,sans-serif; }
  body:has(.home-reference) .site-footer-featured a { color:#d8f0e3; }
  body:has(.home-reference) .site-footer-featured a:hover { color:#b8efd0; }
  body:has(.home-reference) .site-footer-featured .footer-bottom { margin-top:40px; padding-top:18px; border-top:1px solid rgba(216,240,227,.18); color:rgba(216,240,227,.68); font:400 11px 'JetBrains Mono',monospace; }
  @media (min-width:769px) and (max-width:991px) {
    body:has(.home-reference) .site-header .navbar { padding-left:32px; padding-right:32px; }
    .home-reference .home-hero::after { width:520px; height:520px; right:-15px; top:50%; transform:translateY(-50%); opacity:1; }
    .home-reference .home-hero-copy { max-width:48%; }
    .home-reference h1 { font-size:42px; }
    .home-reference .home-hero-copy > p { font-size:16px; }
  }
  @media (max-width:768px) {
    body:has(.home-reference) .site-header .navbar { min-height:72px; padding:8px 16px; }
    body:has(.home-reference) .site-header .navbar-brand img { width:48px; height:48px; }
    body:has(.home-reference) .site-header .navbar-toggler { display:flex; }
    body:has(.home-reference) .site-header .navbar-collapse { padding:12px 0; background:rgba(247,249,251,.98); }
    body:has(.home-reference) .site-header .navbar-nav { gap:0; }
    body:has(.home-reference) .site-header .navbar-contact { margin:8px 0 0; }
    .home-reference .home-hero-inner,.home-reference .home-section { width:calc(100% - 32px); }
    .home-reference .home-hero { min-height:430px; align-items:flex-start; background-position:65% center; }
    .home-reference .home-hero::after { display:block; width:230px; height:230px; right:-38px; top:20px; bottom:auto; transform:none; opacity:.38; background-size:125% 125%; }
    .home-reference .home-hero-inner { padding:28px 0 38px; }
    .home-reference h1 { font-size:32px; margin:20px 0 14px; }
    .home-reference .home-hero-copy > p { font-size:14px; }
    .home-reference .home-section { padding:55px 0; }
    .home-reference .home-section-heading h2 { font-size:32px; }
    .home-reference .domain-grid { grid-template-columns:1fr; }
    .home-reference .project-card { flex-basis:100%; }
    .home-reference .domain-card { min-height:0; }
    .home-reference .projects-heading-row { align-items:start; flex-direction:column; }
    .home-reference .stats { grid-template-columns:1fr; }
    .home-reference .stat { border-right:0; border-bottom:1px solid #c0c9c1; }
    .home-reference .stat:last-child { border-bottom:0; }
    .home-reference .updates { align-items:stretch; flex-direction:column; padding:32px 24px 28px; }
    body:has(.home-reference) .site-footer-featured { padding:42px 0 18px; }
    body:has(.home-reference) .site-footer-featured .footer-column,
    body:has(.home-reference) .site-footer-featured .footer-column:first-child,
    body:has(.home-reference) .site-footer-featured .footer-column:last-child { padding:0 0 22px; border-right:0; border-bottom:1px solid rgba(216,240,227,.18); }
    body:has(.home-reference) .site-footer-featured .footer-column:last-child { border-bottom:0; padding-bottom:0; }
  }
</style>

<main class="home-reference">
  <section class="home-hero"><div class="home-hero-inner"><div class="home-hero-copy">
    <span class="home-kicker">Global Data Observatory Active</span>
    <h1>Advancing Geospatial <em>Intelligence</em></h1>
    <p>Bridging Artificial Intelligence and Earth Observation to decode complex spatial dynamics, model environmental shifts, and engineer sustainable urban futures through rigorous scientific inquiry.</p>
    <div class="home-actions"><a class="home-button primary" href="research.php">Explore Research <span>→</span></a><a class="home-button secondary" href="publications.php">View Publications <span>→</span></a></div>
  </div></div></section>

  <section class="home-section"><div class="home-section-heading"><span class="home-section-eyebrow">01 &nbsp; Core Domains</span><h2>Methodological foundations<br>for spatial <em>intelligence</em></h2><div class="home-rule"></div></div>
    <div class="domain-grid">
      <?php foreach ($domains as $domain): ?><article class="domain-card"><div class="domain-card-heading"><span class="domain-icon" aria-hidden="true"><?php echo htmlspecialchars($domain['icon']); ?></span><h3><?php echo htmlspecialchars($domain['title']); ?></h3></div><p><?php echo htmlspecialchars($domain['text']); ?></p><a class="learn-more" href="research.php">Learn More <span>→</span></a></article><?php endforeach; ?>
    </div>
  </section>

  <section class="projects-band"><div class="home-section"><div class="projects-heading-row"><div class="home-section-heading"><span class="home-section-eyebrow">02 &nbsp; Field Reports</span><h2>Featured Projects</h2><div class="home-rule"></div></div><a href="projects.php">View all projects →</a></div>
    <div class="project-carousel-viewport"><div class="project-grid" id="homeProjectTrack">
      <?php foreach ($projects as $project): $image = $findProjectImage($project['title']) ?: 'assets/images/geo-satellite-clean.jpg'; $description = htmlspecialchars(mb_substr($project['summary'] ?? $project['objectives'] ?? '', 0, 140)); ?><article class="project-card"><img src="<?php echo htmlspecialchars(asset_url($image)); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>"><div class="project-card-body"><h3><?php echo htmlspecialchars($project['title']); ?></h3><p><span class="project-description-track"><span><?php echo $description; ?></span><span aria-hidden="true"><?php echo $description; ?></span></span></p><a href="project_detail.php?id=<?php echo (int)$project['id']; ?>">View Project →</a></div></article><?php endforeach; ?>
    </div></div>
  </div></section>

  <section class="home-section"><div class="updates"><div><h2>Research Updates</h2><p>Subscribe to our quarterly newsletter for deep dives into our latest methodologies, publication releases, and lab news.</p></div><a class="home-button secondary" href="news.php">Read News <span>→</span></a></div></section>
</main>
<script>
  (function () {
    const track = document.getElementById('homeProjectTrack');
    if (!track) return;
    let current = 0;
    let timer;

    function visibleCards() {
      return window.innerWidth <= 768 ? 1 : 3;
    }

    function moveNext() {
      const cards = track.querySelectorAll('.project-card');
      const visible = visibleCards();
      const max = Math.max(0, cards.length - visible);
      current = current >= max ? 0 : current + 1;
      const distance = cards[0] ? cards[0].getBoundingClientRect().width + 24 : 0;
      track.style.transform = 'translateX(-' + (current * distance) + 'px)';
    }

    function restart() {
      window.clearInterval(timer);
      timer = window.setInterval(moveNext, 2000);
    }

    window.addEventListener('resize', function () {
      current = 0;
      track.style.transform = 'translateX(0)';
      restart();
    });
    restart();
  })();
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>
