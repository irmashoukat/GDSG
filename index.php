<?php
$pageTitle = 'Home';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/header.php';
?>

<!-- ============================================================
     OBSERVATORY THEME — page-level design tokens & components
     These CSS variables (--gdo-*) are the shared token system for
     the "instrument" direction. If you like this look, lift this
     whole <style> block into a site-wide stylesheet (e.g.
     assets/css/observatory-theme.css) so other pages (research.php,
     publications.php, projects.php, news.php) inherit the same
     palette / type scale / panel components instead of re-declaring
     it per page.
     ============================================================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,500&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    /* --- color --- */
    --gdo-bg: #0a0f14;
    --gdo-bg-alt: #0f1720;
    --gdo-panel: #101a20;
    --gdo-ink: #e7ece7;
    --gdo-muted: #8ca398;
    --gdo-terrain: #2f6e4f;
    --gdo-terrain-bright: #4fae7c;
    --gdo-signal: #e8a33d;
    --gdo-alert: #d9534f;
    --gdo-line: rgba(140, 163, 152, 0.16);
    --gdo-line-bright: rgba(140, 163, 152, 0.32);

    /* --- type --- */
    --gdo-font-display: 'Fraunces', Georgia, serif;
    --gdo-font-body: 'Inter', -apple-system, sans-serif;
    --gdo-font-mono: 'JetBrains Mono', 'Courier New', monospace;
  }

  .gdo-page { background: var(--gdo-bg); color: var(--gdo-ink); }

  /* faint topographic-contour backdrop, present behind every section
     for continuity — this is the "instrument" texture. Cheap SVG,
     no images. */
  .gdo-page {
    background-image:
      radial-gradient(ellipse at 15% 0%, rgba(47,110,79,0.14) 0%, transparent 55%),
      repeating-radial-gradient(circle at 50% 120%, transparent 0, transparent 38px, var(--gdo-line) 39px, transparent 40px);
    background-attachment: fixed;
  }

  /* ============ HERO ============ */
  .gdo-hero {
    position: relative;
    border-bottom: 1px solid var(--gdo-line);
  }

  /* .scroll-wrapper is the tall element that gives the pin something to
     scroll through — it must be taller than the viewport, or the sticky
     stage below has nowhere to travel and the scroll-linked scale in the
     script never advances past 0. */
  .hero-pin-wrapper.scroll-wrapper {
    position: relative;
    height: 260vh;
  }

  /* .hero-pin-stage is the sticky layer that actually pins to the top of
     the viewport while .hero-pin-wrapper scrolls underneath it — this is
     the piece the previous markup was missing. */
  .hero-pin-stage {
    position: sticky;
    top: 0;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    background: radial-gradient(ellipse at 50% 18%, #e8f5ee 0%, #f3faf7 45%, #e5f1ed 100%);
  }

  /* soft vignette so the overlay card reads as sitting in front of the
     globe (depth) rather than a flat box laid on top of it */
  .hero-pin-stage::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 28% 78%, rgba(10,15,20,0.6) 0%, rgba(10,15,20,0.2) 42%, transparent 68%);
    pointer-events: none;
    z-index: 3;
  }

  .hero-pin-stage .hero-container {
    position: absolute;
    inset: 0;
    z-index: 6;
    display: flex;
    align-items: flex-end;
    padding-bottom: 9%;
  }

  .hero-overlay-panel {
    position: relative;
    width: min(100%, 960px);
    min-height: 250px;
    box-sizing: border-box;
    background: linear-gradient(135deg, rgba(51, 102, 224, 0.38) 0%, rgba(31, 127, 78, 0.38) 100%);
    border: 1px solid var(--gdo-line-bright);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    padding: 2.2rem 2.4rem;
    border-radius: 3px;
  }

  @media (max-width: 767px) {
    .hero-pin-wrapper.scroll-wrapper { height: 200vh; }
    .hero-overlay-panel { width: 100%; min-height: auto; padding: 1.6rem 1.8rem; }
    .hero-pin-stage .hero-container { padding-bottom: 6%; }
  }

  .hero-badge {
    display: inline-flex; align-items: center; gap: 0.55rem;
    font-family: var(--gdo-font-mono); font-size: 0.72rem; letter-spacing: 0.14em;
    text-transform: uppercase; color: var(--color-primary);
    margin-bottom: 1.75rem;
  }
  .hero-badge__dot {
    width: 7px; height: 7px; border-radius: 50%; background: var(--color-primary);
    box-shadow: 0 0 0 0 rgba(232,163,61,0.6);
    animation: gdo-pulse 2.2s infinite;
  }
  @keyframes gdo-pulse {
    0% { box-shadow: 0 0 0 0 rgba(232,163,61,0.55); }
    70% { box-shadow: 0 0 0 8px rgba(232,163,61,0); }
    100% { box-shadow: 0 0 0 0 rgba(232,163,61,0); }
  }

  .gdo-hero h1 {
    font-family: var(--gdo-font-display); font-weight: 500; font-style: italic;
    font-size: clamp(2.4rem, 4.4vw, 3.6rem); line-height: 1.06; letter-spacing: -0.01em;
    color: #000000; margin-bottom: 1.25rem;
  }
  .gdo-hero p { font-family: var(--gdo-font-body); font-size: 1.05rem; line-height: 1.65; color: #ffffff; max-width: 46ch; margin-bottom: 2.25rem; }

  .hero-actions { display: flex; gap: 0.9rem; flex-wrap: wrap; }
  .gdo-btn {
    font-family: var(--gdo-font-mono); font-size: 0.78rem; letter-spacing: 0.06em; text-transform: uppercase;
    padding: 0.85rem 1.4rem; border-radius: 2px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;
    transition: all 0.25s ease; border: 1px solid var(--gdo-line-bright);
  }
  .gdo-btn--solid { background: var(--gdo-terrain); color: #0a0f14; border-color: var(--gdo-terrain); font-weight: 500; }
  .gdo-btn--solid:hover { background: var(--gdo-terrain-bright); border-color: var(--gdo-terrain-bright); color: #0a0f14; transform: translateY(-1px); }
  .gdo-btn--ghost { color: var(--gdo-ink); background: transparent; }
  .gdo-btn--ghost:hover { border-color: var(--gdo-signal); color: var(--gdo-signal); transform: translateY(-1px); }
  .hero-actions .gdo-btn--solid { background: #c94343; border-color: #c94343; color: #ffffff; }
  .hero-actions .gdo-btn--solid:hover { background: #a93232; border-color: #a93232; color: #ffffff; }
  .hero-actions .gdo-btn--ghost { border-color: #c94343; color: #c94343; }
  .hero-actions .gdo-btn--ghost:hover { border-color: #a93232; color: #a93232; }

  /* --- 3D stage canvas --- */
  #home-three-visual {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    cursor: grab;
    touch-action: none;
    z-index: 1;
  }
  #home-three-visual.is-dragging { cursor: grabbing; }
  #home-three-visual canvas { display: block; width: 100%; height: 100%; }

  .gdo-hud { position: absolute; inset: 0; pointer-events: none; font-family: var(--gdo-font-mono); z-index: 5; }
  .gdo-hud__corner {
    position: absolute; width: 26px; height: 26px; border-color: rgba(140,163,152,0.55);
    border-style: solid; border-width: 0;
  }
  .gdo-hud__corner--tl { top: 0; left: 0; border-top-width: 1px; border-left-width: 1px; }
  .gdo-hud__corner--tr { top: 0; right: 0; border-top-width: 1px; border-right-width: 1px; }
  .gdo-hud__corner--bl { bottom: 0; left: 0; border-bottom-width: 1px; border-left-width: 1px; }
  .gdo-hud__corner--br { bottom: 0; right: 0; border-bottom-width: 1px; border-right-width: 1px; }

  .gdo-hud__readout {
    position: absolute; bottom: 14px; left: 4px; font-size: 0.68rem; letter-spacing: 0.04em;
    color: var(--gdo-muted); line-height: 1.7; text-shadow: 0 0 12px rgba(10,15,20,0.9);
  }
  .gdo-hud__readout span { color: var(--gdo-terrain-bright); }
  .gdo-hud__tag {
    position: absolute; top: 14px; right: 4px; font-size: 0.66rem; letter-spacing: 0.1em;
    color: var(--gdo-signal); text-transform: uppercase; text-align: right;
  }

  .gdo-scroll-cue {
    position: absolute; bottom: 28px; left: 50%; transform: translateX(-50%);
    display: flex; flex-direction: column; align-items: center; gap: 0.5rem;
    font-family: var(--gdo-font-mono); font-size: 0.65rem; letter-spacing: 0.16em;
    color: var(--gdo-muted); text-transform: uppercase; z-index: 4;
  }
  .gdo-scroll-cue__line { width: 1px; height: 34px; background: linear-gradient(var(--gdo-terrain-bright), transparent); animation: gdo-scrollline 1.8s ease-in-out infinite; }
  @keyframes gdo-scrollline { 0%,100% { transform: scaleY(1); opacity: 0.9; } 50% { transform: scaleY(0.4); opacity: 0.4; } }

  /* ============ SECTION SCAFFOLDING ============ */
  .gdo-section { position: relative; padding: 6.5rem 0; }
  .gdo-section--domains {
    background: linear-gradient(135deg, rgba(15, 62, 51, 0.62), rgba(15, 43, 60, 0.68));
  }
  .gdo-section--domains .gdo-heading__eyebrow { color: #d52f2f; font-weight: 800; }
  .gdo-section--reports {
    background: linear-gradient(135deg, rgba(15, 62, 51, 0.62), rgba(15, 43, 60, 0.68));
  }
  .gdo-section--reports .gdo-heading__eyebrow { color: #c94343; font-weight: 800; }
  .gdo-section--alt { background: linear-gradient(180deg, transparent, rgba(15,23,32,0.6) 12%, rgba(15,23,32,0.6) 88%, transparent); }

  .gdo-heading__eyebrow {
    font-family: var(--gdo-font-mono); font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase;
    color: var(--gdo-terrain-bright); margin-bottom: 0.85rem; display: block;
  }
  .gdo-heading h2 {
    font-family: var(--gdo-font-display); font-style: italic; font-weight: 500;
    font-size: clamp(1.9rem, 3vw, 2.6rem); color: var(--gdo-ink); margin-bottom: 0.6rem;
  }
  .gdo-heading p { font-family: var(--gdo-font-body); color: var(--gdo-muted); max-width: 52ch; }
  .gdo-heading--split { display: flex; justify-content: space-between; align-items: flex-end; gap: 2rem; flex-wrap: wrap; margin-bottom: 3rem; }

  /* ============ INSTRUMENT PANELS (core domains) ============ */
  .gdo-panel {
    position: relative; background: rgba(31, 91, 76, 0.88); border: 1px solid var(--gdo-line);
    padding: 2.1rem 1.9rem 1.8rem; height: 100%;
  }
  .gdo-panel::before, .gdo-panel::after {
    content: ''; position: absolute; width: 16px; height: 16px; border-color: var(--gdo-line-bright); border-style: solid; border-width: 0;
    transition: border-color 0.3s ease;
  }
  .gdo-panel::before { top: -1px; left: -1px; border-top-width: 1px; border-left-width: 1px; }
  .gdo-panel::after { bottom: -1px; right: -1px; border-bottom-width: 1px; border-right-width: 1px; }
  .gdo-panel:hover { border-color: var(--gdo-line-bright); }
  .gdo-panel:hover::before, .gdo-panel:hover::after { border-color: var(--gdo-signal); }

  .gdo-panel__signal { font-family: var(--gdo-font-mono); font-size: 0.68rem; letter-spacing: 0.12em; color: var(--gdo-signal); text-transform: uppercase; display: block; margin-bottom: 1rem; }
  .gdo-panel h3 { font-family: var(--gdo-font-display); font-weight: 500; font-size: 1.5rem; color: var(--gdo-ink); margin-bottom: 0.75rem; }
  .gdo-panel p { font-family: var(--gdo-font-body); color: var(--gdo-muted); font-size: 0.95rem; line-height: 1.6; }

  /* ============ FIELD REPORT CARDS (projects) ============ */
  .gdo-report { background: rgba(31, 91, 76, 0.88); border: 1px solid var(--gdo-line); overflow: hidden; height: 100%; }
  .gdo-report__media-wrap { position: relative; aspect-ratio: 16/9; overflow: hidden; }
  .gdo-report__media { width: 100%; height: 100%; object-fit: cover; filter: saturate(0.85) contrast(1.05); transition: transform 0.6s ease, filter 0.6s ease; }
  .gdo-report:hover .gdo-report__media { transform: scale(1.045); filter: saturate(1.05) contrast(1.08); }
  .gdo-report__scanline {
    position: absolute; inset: 0; pointer-events: none;
    background: linear-gradient(180deg, transparent 0%, rgba(79,174,124,0.14) 50%, transparent 100%);
    transform: translateY(-100%); transition: transform 1.1s ease;
  }
  .gdo-report:hover .gdo-report__scanline { transform: translateY(100%); }
  .gdo-report__body { padding: 1.6rem 1.7rem 1.9rem; background: rgba(31, 91, 76, 0.88); }
  .gdo-pill {
    font-family: var(--gdo-font-mono); font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--gdo-terrain-bright); border: 1px solid rgba(79,174,124,0.4); padding: 0.25rem 0.6rem; border-radius: 2px; display: inline-block; margin-bottom: 0.9rem;
  }
  .gdo-pill--accent { color: var(--gdo-signal); border-color: rgba(232,163,61,0.4); }
  .gdo-report h3 { font-family: var(--gdo-font-display); font-weight: 500; font-size: 1.3rem; color: var(--gdo-ink); margin-bottom: 0.6rem; }
  .gdo-report p { font-family: var(--gdo-font-body); color: var(--gdo-muted); font-size: 0.92rem; line-height: 1.6; margin-bottom: 1.1rem; }
  .gdo-report a { font-family: var(--gdo-font-mono); font-size: 0.75rem; letter-spacing: 0.05em; color: var(--gdo-ink); text-decoration: none; border-bottom: 1px solid var(--gdo-terrain-bright); padding-bottom: 2px; }
  .gdo-report a:hover { color: var(--gdo-terrain-bright); }

  /* ============ NEWSLETTER STRIP ============ */
  .gdo-newsletter {
    display: flex; justify-content: space-between; align-items: center; gap: 2rem; flex-wrap: wrap;
    border: 1px solid rgba(115, 174, 192, 0.7); padding: 2.6rem 2.8rem; position: relative; background: #dff2f7;
  }
  .gdo-newsletter::before {
    content: 'SIG // DIGEST'; position: absolute; top: -0.6rem; left: 2rem; background: var(--gdo-bg);
    padding: 0 0.6rem; font-family: var(--gdo-font-mono); font-size: 0.65rem; letter-spacing: 0.14em; color: var(--gdo-signal);
  }
  .gdo-newsletter h2 { font-family: var(--gdo-font-display); font-style: italic; font-weight: 500; font-size: 1.9rem; color: #123846; margin-bottom: 0.4rem; }
  .gdo-newsletter p { font-family: var(--gdo-font-body); color: #365763; margin: 0; }
  .gdo-newsletter .gdo-btn--solid { background: #c94343; border-color: #c94343; color: #ffffff; }
  .gdo-newsletter .gdo-btn--solid:hover { background: #a93232; border-color: #a93232; color: #ffffff; }

  @media (prefers-reduced-motion: reduce) {
    .gdo-panel, .gdo-report, .gdo-newsletter { opacity: 1 !important; transform: none !important; }
    .hero-badge__dot, .gdo-scroll-cue__line { animation: none; }
  }
</style>

<div class="gdo-page">

  <section class="gdo-hero">
    <div class="hero-pin-wrapper scroll-wrapper">
      <div class="hero-pin-stage">
        <div id="home-three-visual" aria-hidden="true"></div>

        <div class="gdo-hud" aria-hidden="true">
          <div class="gdo-hud__corner gdo-hud__corner--tl"></div>
          <div class="gdo-hud__corner gdo-hud__corner--tr"></div>
          <div class="gdo-hud__corner gdo-hud__corner--bl"></div>
          <div class="gdo-hud__corner gdo-hud__corner--br"></div>
          <div class="gdo-hud__tag">Scan mode&nbsp;/&nbsp;terrestrial</div>
          <div class="gdo-hud__readout" id="gdo-readout">
            LAT <span id="gdo-lat">00.0000</span>&nbsp;&nbsp;LON <span id="gdo-lon">00.0000</span><br>
            ALT <span id="gdo-alt">000km</span>&nbsp;&nbsp;NODES <span id="gdo-nodes">180</span>
          </div>
        </div>

        <div class="container hero-container">
          <div class="hero-overlay-panel">
            <div class="hero-badge" role="status">
              <span class="hero-badge__dot" aria-hidden="true"></span>
              <span>Global Data Observatory Active</span>
            </div>
            <h1>Advancing Geospatial Intelligence</h1>
            <p class="gdo-hero__description"><span class="gdo-hero__description-track"><span>Bridging artificial intelligence and Earth observation to decode complex spatial dynamics, model environmental shifts, and engineer sustainable urban futures through rigorous scientific inquiry.</span><span aria-hidden="true">Bridging artificial intelligence and Earth observation to decode complex spatial dynamics, model environmental shifts, and engineer sustainable urban futures through rigorous scientific inquiry.</span></span></p>
            <div class="hero-actions">
              <a href="research.php" class="gdo-btn gdo-btn--solid">Explore Research</a>
              <a href="publications.php" class="gdo-btn gdo-btn--solid">View Publications</a>
            </div>
          </div>
        </div>

        <div class="gdo-scroll-cue"><span>Scroll</span><div class="gdo-scroll-cue__line"></div></div>
      </div>
    </div>
  </section>

  <section class="gdo-section gdo-section--domains">
    <div class="container">
      <div class="gdo-heading" style="margin-bottom: 3rem;">
        <span class="gdo-heading__eyebrow">01 — Core Domains</span>
        <h2 class="split-heading-target">Methodological foundations for spatial intelligence</h2>
      </div>
      <div class="row g-4 stagger">
        <div class="col-lg-4">
          <article class="gdo-panel">
            <span class="gdo-panel__signal">Signal // GeoAI Forecasting</span>
            <h3 class="geoai-domain-title">GeoAI &amp; Predictive Modeling</h3>
            <p class="gdo-panel__description"><span class="gdo-panel__description-track"><span>Building machine-learning workflows for AQI forecasting, pollution-source attribution, and spatiotemporal risk prediction using environmental and geospatial data.</span><span aria-hidden="true">Building machine-learning workflows for AQI forecasting, pollution-source attribution, and spatiotemporal risk prediction using environmental and geospatial data.</span></span></p>
          </article>
        </div>
        <div class="col-lg-4">
          <article class="gdo-panel">
            <span class="gdo-panel__signal">Signal // EO Monitoring</span>
            <h3 class="blue-domain-title">Earth Observation &amp; Remote Sensing</h3>
            <p class="gdo-panel__description"><span class="gdo-panel__description-track"><span>Integrating satellite, aerial, and sensor data to monitor land-use change, environmental stress, and climate-sensitive conditions across regions.</span><span aria-hidden="true">Integrating satellite, aerial, and sensor data to monitor land-use change, environmental stress, and climate-sensitive conditions across regions.</span></span></p>
          </article>
        </div>
        <div class="col-lg-4">
          <article class="gdo-panel">
            <span class="gdo-panel__signal">Signal // Spatial Infrastructure</span>
            <h3 class="blue-domain-title">Spatial Analytics &amp; Location Intelligence</h3>
            <p class="gdo-panel__description"><span class="gdo-panel__description-track"><span>Developing geospatial pipelines for addressing, administrative hierarchy, and multi-scale analysis to support planning, service delivery, and evidence-based decisions.</span><span aria-hidden="true">Developing geospatial pipelines for addressing, administrative hierarchy, and multi-scale analysis to support planning, service delivery, and evidence-based decisions.</span></span></p>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="gdo-section gdo-section--alt gdo-section--reports">
    <div class="container">
      <div class="gdo-heading gdo-heading--split">
        <div class="gdo-heading">
          <span class="gdo-heading__eyebrow">02 — Field Reports</span>
          <h2>Featured projects</h2>
          <p>Current initiatives shaping sustainable and data-driven urban futures.</p>
        </div>
        <a href="projects.php" class="gdo-btn gdo-btn--ghost">View all projects</a>
      </div>
      <div class="row g-4 stagger">
        <div class="col-md-6 col-lg-4">
          <article class="gdo-report">
            <div class="gdo-report__media-wrap">
              <img src="Project_images/smog_image.jpg" alt="Punjab air quality forecast map" class="gdo-report__media">
              <div class="gdo-report__scanline"></div>
            </div>
            <div class="gdo-report__body">
              <h3 class="blue-domain-title">Smog Monitoring &amp; AQI Forecasting System</h3>
              <p class="gdo-report__description"><span class="gdo-report__description-track"><span>An environmental intelligence platform that monitors pollution across Punjab, explains district-level sources, and forecasts future smog conditions.</span><span aria-hidden="true">An environmental intelligence platform that monitors pollution across Punjab, explains district-level sources, and forecasts future smog conditions.</span></span></p>
              <a href="project.php?project=smog">View project details →</a>
            </div>
          </article>
        </div>
        <div class="col-md-6 col-lg-4">
          <article class="gdo-report">
            <div class="gdo-report__media-wrap">
              <img src="Project_images/HumMuqam_image.jpg" alt="Location intelligence map" class="gdo-report__media">
              <div class="gdo-report__scanline"></div>
            </div>
            <div class="gdo-report__body">
              <h3 class="blue-domain-title">HumMuqaam – Intelligent Geospatial Addressing System</h3>
              <p class="gdo-report__description"><span class="gdo-report__description-track"><span>A national-scale digital location framework that converts administrative boundaries, addresses, and hierarchical grid cells into precise D-Codes.</span><span aria-hidden="true">A national-scale digital location framework that converts administrative boundaries, addresses, and hierarchical grid cells into precise D-Codes.</span></span></p>
              <a href="project.php?project=hummuqaam">View project details →</a>
            </div>
          </article>
        </div>
        <div class="col-md-6 col-lg-4">
          <article class="gdo-report">
            <div class="gdo-report__media-wrap">
              <img src="Project_images/crop_library_image.jpg" alt="Crop library image" class="gdo-report__media">
              <div class="gdo-report__scanline"></div>
            </div>
            <div class="gdo-report__body">
              <h3 class="blue-domain-title">Crop Library</h3>
              <p class="gdo-report__description"><span class="gdo-report__description-track"><span>A searchable agricultural knowledge platform for structured crop profiles, field practices, environmental requirements, and evidence-led decisions.</span><span aria-hidden="true">A searchable agricultural knowledge platform for structured crop profiles, field practices, environmental requirements, and evidence-led decisions.</span></span></p>
              <a href="project.php?project=crop-library">View project details →</a>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="gdo-section" style="padding-top: 0;">
    <div class="container">
      <div class="gdo-newsletter">
        <div>
          <h2>Research updates</h2>
          <p>Quarterly publications and methodological insights from the lab.</p>
        </div>
        <a href="news.php" class="gdo-btn gdo-btn--solid">Read news</a>
      </div>
    </div>
  </section>

</div>

<!-- ============================================================
     three.js is already included in the global head for the site.
     This page uses the scroll-reactive globe without re-importing it.
     ============================================================ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
(function () {
  if (window.gsap && window.ScrollTrigger) {
    gsap.registerPlugin(ScrollTrigger);
    document.querySelectorAll('.gdo-panel, .gdo-report, .gdo-newsletter').forEach(function (el, i) {
      gsap.fromTo(el, {
        opacity: 0,
        y: 28
      }, {
        opacity: 1,
        y: 0,
        duration: 0.8,
        delay: (i % 3) * 0.08,
        ease: 'power2.out',
        scrollTrigger: { trigger: el, start: 'top 88%' }
      });
    });
  }
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var EMBLEM_DATA_URI = "data:image/png;base64,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";

  var wrapper = document.querySelector('.hero-pin-wrapper.scroll-wrapper');
  var container = document.getElementById('home-three-visual');
  var width = container.clientWidth || window.innerWidth;
  var height = container.clientHeight || window.innerHeight;

  var scene = new THREE.Scene();
  var camera = new THREE.PerspectiveCamera(48, width / height, 0.1, 1000);
  camera.position.set(0, 0, 6.6);

  var renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
  renderer.setSize(width, height);
  container.appendChild(renderer.domElement);

  var world = new THREE.Group();
  scene.add(world);

  var innerGeo = new THREE.SphereGeometry(1.78, 64, 64);
  var innerMat = new THREE.MeshStandardMaterial({
    color: 0xdcebe0,
    emissive: 0x1f7f4e,
    emissiveIntensity: 0.18,
    metalness: 0.1,
    roughness: 0.85,
    transparent: true,
    opacity: 0.92
  });
  var innerSphere = new THREE.Mesh(innerGeo, innerMat);
  world.add(innerSphere);

  var wireGeo = new THREE.IcosahedronGeometry(1.86, 4);
  var wireMat = new THREE.MeshBasicMaterial({
    color: 0x3366e0,
    wireframe: true,
    transparent: true,
    opacity: 0.16
  });
  var wireSphere = new THREE.Mesh(wireGeo, wireMat);
  world.add(wireSphere);

  var textureLoader = new THREE.TextureLoader();
  var logoTexture = textureLoader.load(EMBLEM_DATA_URI);
  logoTexture.wrapS = THREE.RepeatWrapping;
  logoTexture.wrapT = THREE.ClampToEdgeWrapping;
  logoTexture.repeat.set(2, 1);
  logoTexture.anisotropy = 4;

  var logoShellGeo = new THREE.SphereGeometry(1.9, 64, 64);
  var logoShellMat = new THREE.MeshBasicMaterial({
    map: logoTexture,
    transparent: true,
    opacity: 0.96,
    depthWrite: false,
    side: THREE.FrontSide
  });
  var logoShell = new THREE.Mesh(logoShellGeo, logoShellMat);
  world.add(logoShell);

  var pointCount = 140;
  var positions = new Float32Array(pointCount * 3);
  var palette = [0x1f7f4e, 0x3366e0, 0xd52f2f];
  var colors = new Float32Array(pointCount * 3);
  var c = new THREE.Color();
  for (var i = 0; i < pointCount; i++) {
    var theta = Math.random() * Math.PI * 2;
    var phi = Math.acos(2 * Math.random() - 1);
    var radius = 1.98 + Math.random() * 0.06;
    positions[i * 3] = radius * Math.sin(phi) * Math.cos(theta);
    positions[i * 3 + 1] = radius * Math.cos(phi);
    positions[i * 3 + 2] = radius * Math.sin(phi) * Math.sin(theta);
    c.set(palette[i % palette.length]);
    colors[i * 3] = c.r; colors[i * 3 + 1] = c.g; colors[i * 3 + 2] = c.b;
  }
  var pointsGeo = new THREE.BufferGeometry();
  pointsGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
  pointsGeo.setAttribute('color', new THREE.BufferAttribute(colors, 3));
  var pointsMat = new THREE.PointsMaterial({ size: 0.03, vertexColors: true, transparent: true, opacity: 0.85 });
  var points = new THREE.Points(pointsGeo, pointsMat);
  world.add(points);

  var badgeGroup = new THREE.Group();
  badgeGroup.position.set(0, 0, 2.65);
  scene.add(badgeGroup);

  var glowCanvas = document.createElement('canvas');
  glowCanvas.width = 256; glowCanvas.height = 256;
  var gctx = glowCanvas.getContext('2d');
  var grad = gctx.createRadialGradient(128, 128, 10, 128, 128, 128);
  grad.addColorStop(0, 'rgba(255,255,255,0.9)');
  grad.addColorStop(0.55, 'rgba(120,180,255,0.25)');
  grad.addColorStop(1, 'rgba(120,180,255,0)');
  gctx.fillStyle = grad;
  gctx.fillRect(0, 0, 256, 256);
  var glowTexture = new THREE.CanvasTexture(glowCanvas);
  var glowMat = new THREE.SpriteMaterial({ map: glowTexture, transparent: true, depthWrite: false, blending: THREE.AdditiveBlending });
  var glowSprite = new THREE.Sprite(glowMat);
  glowSprite.scale.set(2.6, 2.6, 1);
  badgeGroup.add(glowSprite);

  var badgeGeo = new THREE.PlaneGeometry(1.15, 1.9);
  var badgeMat = new THREE.MeshBasicMaterial({ map: logoTexture.clone(), transparent: true, depthWrite: false });
  badgeMat.map.wrapS = THREE.ClampToEdgeWrapping;
  badgeMat.map.repeat.set(1, 1);
  badgeMat.map.needsUpdate = true;
  var badgePlane = new THREE.Mesh(badgeGeo, badgeMat);
  badgeGroup.add(badgePlane);

  scene.add(new THREE.AmbientLight(0xffffff, 0.9));
  var pointLight = new THREE.PointLight(0xffffff, 1.4);
  pointLight.position.set(4, 4, 6);
  scene.add(pointLight);
  var rimLight = new THREE.PointLight(0xd52f2f, 0.6);
  rimLight.position.set(-5, -2, -4);
  scene.add(rimLight);

  var isDragging = false;
  var lastX = 0, lastY = 0;
  var dragVelX = 0, dragVelY = 0;
  var targetRotY = 0, targetRotX = 0;
  var currentRotY = 0, currentRotX = 0;
  var maxRotX = 0.9;
  container.addEventListener('pointerdown', function (e) {
    isDragging = true;
    dragVelX = 0; dragVelY = 0;
    lastX = e.clientX; lastY = e.clientY;
    container.classList.add('is-dragging');
    container.setPointerCapture(e.pointerId);
  });

  container.addEventListener('pointermove', function (e) {
    if (!isDragging) return;
    var dx = e.clientX - lastX;
    var dy = e.clientY - lastY;
    lastX = e.clientX; lastY = e.clientY;

    var sensitivity = 0.006;
    dragVelY = dx * sensitivity;
    dragVelX = dy * sensitivity;

    targetRotY += dragVelY;
    targetRotX = Math.max(-maxRotX, Math.min(maxRotX, targetRotX + dragVelX));
  });

  function endDrag(e) {
    if (!isDragging) return;
    isDragging = false;
    container.classList.remove('is-dragging');
    if (e && e.pointerId !== undefined) {
      try { container.releasePointerCapture(e.pointerId); } catch (err) {}
    }
  }
  container.addEventListener('pointerup', endDrag);
  container.addEventListener('pointerleave', endDrag);
  container.addEventListener('pointercancel', endDrag);

  var scrollProgress = 0;
  var targetScale = 1;
  var currentScale = 1;

  function updateScrollProgress() {
    var rect = wrapper.getBoundingClientRect();
    var scrollable = rect.height - window.innerHeight;
    var raw = scrollable > 0 ? (-rect.top) / scrollable : 0;
    scrollProgress = Math.max(0, Math.min(1, raw));
    var eased = 1 - Math.pow(1 - scrollProgress, 2);
    targetScale = 1 + eased * 0.5;
  }
  document.addEventListener('scroll', updateScrollProgress, { passive: true });
  window.addEventListener('resize', updateScrollProgress);
  updateScrollProgress();

  var clock = new THREE.Clock();

  function animate() {
    requestAnimationFrame(animate);
    var t = clock.getElapsedTime();

    if (!reduceMotion) {
      innerSphere.rotation.y += 0.0012;
      logoShell.rotation.y += 0.0014;
      wireSphere.rotation.y -= 0.0008;
      points.rotation.y += 0.0014;

      if (!isDragging) {
        targetRotY += dragVelY;
        targetRotX = Math.max(-maxRotX, Math.min(maxRotX, targetRotX + dragVelX));
        dragVelY *= 0.94;
        dragVelX *= 0.94;
      }

      currentRotY += (targetRotY - currentRotY) * 0.12;
      currentRotX += (targetRotX - currentRotX) * 0.12;
      world.rotation.y = currentRotY;
      world.rotation.x = currentRotX;

      currentScale += (targetScale - currentScale) * 0.08;
      world.scale.setScalar(currentScale);

      badgeGroup.position.y = Math.sin(t * 0.8) * 0.06;
      badgePlane.lookAt(camera.position);
      glowSprite.material.opacity = 0.75 + Math.sin(t * 1.4) * 0.15;
    } else {
      world.rotation.y = targetRotY;
      world.rotation.x = targetRotX;
      world.scale.setScalar(targetScale);
      badgePlane.lookAt(camera.position);
    }

    renderer.render(scene, camera);
  }

  window.addEventListener('resize', function () {
    var w = container.clientWidth || window.innerWidth;
    var h = container.clientHeight || window.innerHeight;
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
    renderer.setSize(w, h);
  });

  animate();
})();
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>