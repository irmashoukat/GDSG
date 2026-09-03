<?php
$pageTitle = 'About';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/header.php';
?>

<div class="about-page">
    <!-- Hero Section with Globe Background -->
    <section class="about-hero-section">
        <div class="container-fluid about-hero-container">
            <div class="row align-items-center g-5">
                <!-- Left Column: Title, Subtitle, Description, 3 Core Cards -->
                <div class="col-xl-7 col-lg-7 about-hero-left">
                    <div class="about-header-group">
                        <span class="about-kicker">About the</span>
                        <h1 class="about-main-title no-split">
                            <span class="title-white">Geospatial Data </span><span class="title-green">Science Group</span>
                        </h1>
                        <p class="about-description">
                            GDSG advances geospatial science through innovative research, GeoAI solutions, environmental analytics, and interdisciplinary partnerships.
                        </p>
                    </div>

                    <!-- 3 Glassmorphism Cards: Vision, Mission, Values -->
                    <div class="about-pillars-grid">
                        <!-- Vision Card -->
                        <div class="about-pillar-card">
                            <div class="pillar-icon-badge">
                                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 10h4" />
                                    <path d="M19 7V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v3" />
                                    <path d="M7 7V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v3" />
                                    <rect x="2" y="7" width="6" height="14" rx="2" />
                                    <rect x="16" y="7" width="6" height="14" rx="2" />
                                </svg>
                            </div>
                            <h3 class="pillar-title">Vision</h3>
                            <p class="pillar-text">Advance geospatial science through innovation, AI, and interdisciplinary collaboration.</p>
                        </div>

                        <!-- Mission Card -->
                        <div class="about-pillar-card">
                            <div class="pillar-icon-badge">
                                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z" />
                                    <line x1="4" y1="22" x2="4" y2="15" />
                                </svg>
                            </div>
                            <h3 class="pillar-title">Mission</h3>
                            <p class="pillar-text">Conduct impactful research, develop GeoAI solutions, and train future geospatial leaders.</p>
                        </div>

                        <!-- Values Card -->
                        <div class="about-pillar-card">
                            <div class="pillar-icon-badge">
                                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 3h12l4 6-10 12L2 9z" />
                                    <path d="M11 3v18" />
                                    <path d="M2 9h20" />
                                </svg>
                            </div>
                            <h3 class="pillar-title">Values</h3>
                            <p class="pillar-text">Scientific rigor, open collaboration, sustainability, and accessible research.</p>
                            <div class="pillar-accent-line"></div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Research Philosophy Glass Panel -->
                <div class="col-xl-5 col-lg-5 about-hero-right">
                    <div class="about-philosophy-panel">
                        <div class="philosophy-panel-header">
                            <div class="philosophy-header-icon">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="2" />
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" transform="rotate(45 12 12)" />
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" transform="rotate(-45 12 12)" />
                                </svg>
                            </div>
                            <h2 class="philosophy-header-title">Research Philosophy</h2>
                        </div>

                        <div class="philosophy-items-list">
                            <!-- Item 1: Scientific Excellence -->
                            <div class="philosophy-item">
                                <div class="philosophy-item-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6" />
                                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18" />
                                        <path d="M4 22h16" />
                                        <path d="M10 14.66V17c0 .55-.45 1-1 1H8v2h8v-2h-1c-.55 0-1-.45-1-1v-2.34" />
                                        <path d="M6 4h12a2 2 0 0 1 2 2v3a6 6 0 0 1-6 6h0a6 6 0 0 1-6-6V6a2 2 0 0 1 2-2z" />
                                    </svg>
                                </div>
                                <div class="philosophy-item-body">
                                    <h4 class="philosophy-item-title">Scientific Excellence</h4>
                                    <p class="philosophy-item-desc">Rigorous methods and peer-reviewed work.</p>
                                </div>
                            </div>

                            <div class="philosophy-divider"></div>

                            <!-- Item 2: Interdisciplinary Collaboration -->
                            <div class="philosophy-item">
                                <div class="philosophy-item-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                                <div class="philosophy-item-body">
                                    <h4 class="philosophy-item-title">Interdisciplinary Collaboration</h4>
                                    <p class="philosophy-item-desc">Partnerships that connect science, industry, and policy.</p>
                                </div>
                            </div>

                            <div class="philosophy-divider"></div>

                            <!-- Item 3: Open Science -->
                            <div class="philosophy-item">
                                <div class="philosophy-item-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2" />
                                        <polyline points="2 17 12 22 22 17" />
                                        <polyline points="2 12 12 17 22 12" />
                                    </svg>
                                </div>
                                <div class="philosophy-item-body">
                                    <h4 class="philosophy-item-title">Open Science</h4>
                                    <p class="philosophy-item-desc">Transparent methodologies and shared geospatial data.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Feature Ribbon Strip -->
    <section class="about-ribbon-strip">
        <div class="container-fluid about-ribbon-container">
            <div class="about-ribbon-card">
                <div class="ribbon-card-inner">
                    <!-- Badge 1: Mint Icon (Remote sensing / analytics) -->
                    <div class="ribbon-badge-pill">
                        <div class="ribbon-pill-icon mint-circle">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3" />
                                <path d="M4.93 4.93l4.24 4.24" />
                                <path d="M14.83 14.83l4.24 4.24" />
                                <path d="M14.83 9.17l4.24-4.24" />
                                <path d="M4.93 19.07l4.24-4.24" />
                            </svg>
                        </div>
                        <span class="ribbon-pill-text">AI, remote sensing, and urban-environmental analytics.</span>
                    </div>

                    <!-- Badge 2: Blue Icon (Geography & CS) -->
                    <div class="ribbon-badge-pill">
                        <div class="ribbon-pill-icon blue-circle">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="2" y1="12" x2="22" y2="12" />
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                            </svg>
                        </div>
                        <span class="ribbon-pill-text">from geography, computer science, and environmental science.</span>
                    </div>

                    <!-- Badge 3: Purple Icon (All research efforts) -->
                    <div class="ribbon-badge-pill">
                        <div class="ribbon-pill-icon purple-circle">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <span class="ribbon-pill-text">across all research efforts.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
