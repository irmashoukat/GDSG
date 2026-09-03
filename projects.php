<?php
$pageTitle = 'Projects';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/project_model.php';
require __DIR__ . '/includes/header.php';

// Fetch all database projects
$dbProjects = get_projects($pdo, 99);

// Helper function to find matching DB project by keyword
function find_db_project_id($dbProjects, $keywords) {
    if (empty($dbProjects)) return 1;
    foreach ($dbProjects as $p) {
        $t = strtolower($p['title']);
        foreach ($keywords as $kw) {
            if (strpos($t, strtolower($kw)) !== false) {
                return (int)$p['id'];
            }
        }
    }
    return (int)$dbProjects[0]['id'];
}

// 6 Featured Projects matching the reference mockup
$featuredProjects = [
    [
        'id' => find_db_project_id($dbProjects, ['GREEN AI', 'NASTP', 'Air Force']),
        'title' => 'GREEN AI Project at NASTP / Pakistan Air Force',
        'status' => 'COMPLETED',
        'theme' => 'green',
        'icon_bg' => '#ecfdf3',
        'icon_color' => '#027a48',
        'badge_bg' => '#ecfdf3',
        'badge_color' => '#027a48',
        'tag_bg' => '#ecfdf3',
        'tag_color' => '#027a48',
        'tag_border' => 'rgba(2, 122, 72, 0.2)',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 20h10M12 20v-8M12 12c-2.5-3-6-3-6-3s0 4 3 6c2 1.3 3 0 3-3ZM12 10c2.5-3 6-3 6-3s0 4-3 6c-2 1.3-3 0-3-3Z"></path></svg>',
        'desc' => 'Developed and operationalised the AgriVerse & Green-AI ecosystem using artificial intelligence, multispectral imagery, geospatial sensors and cloud-native processing.',
        'capabilities' => ['GeoAI', 'Remote Sensing', 'ML', 'Cloud Computing', '+1'],
        'link_color' => '#027a48'
    ],
    [
        'id' => find_db_project_id($dbProjects, ['GTFS', 'Transit', 'Journey Planner']),
        'title' => 'Google GTFS Journey Planner Punjab Mass Transit Authority',
        'status' => 'COMPLETED',
        'theme' => 'blue',
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'badge_bg' => '#eff8ff',
        'badge_color' => '#175cd3',
        'tag_bg' => '#eff8ff',
        'tag_color' => '#175cd3',
        'tag_border' => 'rgba(23, 92, 211, 0.2)',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="16" rx="2"></rect><path d="M4 11h16M12 3v8M8 19l-2 3M16 19l2 3"></path><circle cx="8" cy="15" r="1"></circle><circle cx="16" cy="15" r="1"></circle></svg>',
        'desc' => 'Supported GTFS-based journey-planning services for Lahore, Multan and emerging EV transport networks across Punjab.',
        'capabilities' => ['GTFS', 'GIS', 'Transit Data', 'Web Service'],
        'link_color' => '#175cd3'
    ],
    [
        'id' => find_db_project_id($dbProjects, ['Smog Prediction', 'Smog', 'AQI']),
        'title' => 'Smog Prediction System Punjab, Pakistan',
        'status' => 'ONGOING',
        'theme' => 'teal',
        'icon_bg' => '#f0fdfa',
        'icon_color' => '#0d9488',
        'badge_bg' => '#f0fdfa',
        'badge_color' => '#0d9488',
        'tag_bg' => '#f0fdfa',
        'tag_color' => '#0d9488',
        'tag_border' => 'rgba(13, 148, 136, 0.2)',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"></path></svg>',
        'desc' => 'Contributed to a machine-learning system for forecasting smog conditions across Punjab for seven-day and fourteen-day periods.',
        'capabilities' => ['ML', 'Environmental Intelligence', 'GIS', 'Forecasting'],
        'link_color' => '#0d9488'
    ],
    [
        'id' => find_db_project_id($dbProjects, ['HUM-MUQAAM', 'HumMuqaam', 'Addressing']),
        'title' => 'HUM-MUQAAM Addressing System Pakistan',
        'status' => 'COMPLETED',
        'theme' => 'green',
        'icon_bg' => '#ecfdf3',
        'icon_color' => '#027a48',
        'badge_bg' => '#ecfdf3',
        'badge_color' => '#027a48',
        'tag_bg' => '#ecfdf3',
        'tag_color' => '#027a48',
        'tag_border' => 'rgba(2, 122, 72, 0.2)',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8Z"></path><circle cx="12" cy="10" r="3"></circle></svg>',
        'desc' => 'Supported the development of a national six-digit digital addressing system for improved service delivery and location identification.',
        'capabilities' => ['GIS', 'Hierarchical Addressing', 'Web Technology', 'Spatial Database'],
        'link_color' => '#027a48'
    ],
    [
        'id' => find_db_project_id($dbProjects, ['BOINC', 'Sentinel', 'Classification']),
        'title' => 'BOINC-Based Crop Classification Using Sentinel Data',
        'status' => 'COMPLETED',
        'theme' => 'blue',
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'badge_bg' => '#eff8ff',
        'badge_color' => '#175cd3',
        'tag_bg' => '#eff8ff',
        'tag_color' => '#175cd3',
        'tag_border' => 'rgba(23, 92, 211, 0.2)',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>',
        'desc' => 'Contributed to a PITB & ITU research project using distributed computing for Sentinel-2-based crop classification.',
        'capabilities' => ['Remote Sensing', 'Image Processing', 'BOINC', 'GeoAI'],
        'link_color' => '#175cd3'
    ],
    [
        'id' => find_db_project_id($dbProjects, ['Sugarcane', 'Suitability']),
        'title' => 'Sugarcane Land Suitability Assessment Punjab',
        'status' => 'COMPLETED',
        'theme' => 'purple',
        'icon_bg' => '#f9f5ff',
        'icon_color' => '#7c3aed',
        'badge_bg' => '#f9f5ff',
        'badge_color' => '#7c3aed',
        'tag_bg' => '#f9f5ff',
        'tag_color' => '#7c3aed',
        'tag_border' => 'rgba(124, 58, 237, 0.2)',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"></path></svg>',
        'desc' => 'Assessed land suitability for sugarcane using remote sensing, soil, temperature, rainfall and pH datasets.',
        'capabilities' => ['GIS', 'Remote Sensing', 'Suitability Analysis', 'Agricultural Knowledge'],
        'link_color' => '#7c3aed'
    ]
];

// List of "More Research Projects"
$moreProjects = [
    // Column 1
    [
        'title' => 'Agri-Insite & Dashboard for Punjab',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['Agri-Insite', 'Extension', 'Geofencing']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>'
    ],
    [
        'title' => 'Flood Risk Estimation using GIS & Remote Sensing',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['Flood Risk', 'Enhanced Flood', 'Flood']),
        'icon_bg' => '#ecfdf3',
        'icon_color' => '#027a48',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>'
    ],
    [
        'title' => 'Forest Cover Mapping Bago Region, Myanmar',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['Forest Cover', 'Myanmar', 'Bago']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path></svg>'
    ],
    [
        'title' => 'CORONA / COVID-19 BOT and Tracker Punjab',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['CORONA', 'COVID-19', 'Tracker']),
        'icon_bg' => '#ecfdf3',
        'icon_color' => '#027a48',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="8"></circle><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line></svg>'
    ],
    [
        'title' => 'RCT-Based Survey Project ITU Pakistan & Liberia',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['RCT-Based', 'Survey', 'Liberia']),
        'icon_bg' => '#f9f5ff',
        'icon_color' => '#7c3aed',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>'
    ],
    // Column 2
    [
        'title' => 'Crop Health Monitoring with Sentinel-2',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['Crop Health', 'Yield Estimation']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"></path></svg>'
    ],
    [
        'title' => 'Urban Heat Island Analysis Punjab Cities',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['Urban Heat', 'Island Analysis']),
        'icon_bg' => '#ecfdf3',
        'icon_color' => '#027a48',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle></svg>'
    ],
    [
        'title' => 'EVACCS Project Punjab & Khyber Pakhtunkhwa',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['EVACCS', 'Khyber']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>'
    ],
    [
        'title' => 'PASBAN App & e-Ticketing National Highways & Motorway Police',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['PASBAN', 'e-Ticketing', 'Motorway']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l18-5v12L3 14v-3z"></path></svg>'
    ],
    [
        'title' => 'Property Digitisation using GIS Chaklala Scheme, Rawalpindi',
        'status' => 'COMPLETED',
        'id' => find_db_project_id($dbProjects, ['Property Digitisation', 'Chaklala', 'Rawalpindi']),
        'icon_bg' => '#ecfdf3',
        'icon_color' => '#027a48',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>'
    ],
    // Column 3
    [
        'title' => 'Punjab Flood Monitoring System',
        'status' => 'ONGOING',
        'id' => find_db_project_id($dbProjects, ['Flood Monitoring', 'Flood Rescue']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"></path></svg>'
    ],
    [
        'title' => 'Polio Mapping Punjab & Balochistan',
        'status' => 'ONGOING',
        'id' => find_db_project_id($dbProjects, ['Polio Mapping', 'Balochistan']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>'
    ],
    [
        'title' => 'Waseela-e-Taleem Program',
        'status' => 'ONGOING',
        'id' => find_db_project_id($dbProjects, ['Waseela-e-Taleem', 'Benazir']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path></svg>'
    ],
    [
        'title' => 'Pakistan Air Force Land-Management Project',
        'status' => 'ONGOING',
        'id' => find_db_project_id($dbProjects, ['Air Force Land-Management', 'Land-Management']),
        'icon_bg' => '#eff8ff',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"></path></svg>'
    ]
];
?>

<div class="projects-page-new">
    <!-- Hero Section with Geospatial Network Map -->
    <section class="projects-hero-section">
        <div class="container-fluid projects-container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="projects-kicker">COMPREHENSIVE RESEARCH PORTFOLIO</span>
                    <h1 class="projects-hero-title">
                        Projects by <span class="title-gdsg">GDSG</span>
                    </h1>
                    <p class="projects-hero-lead">
                        19 research projects spanning geospatial intelligence, environmental monitoring, agricultural systems, and public-service mapping across Pakistan and internationally.
                    </p>

                    <!-- Stat Card -->
                    <div class="projects-stat-card">
                        <div class="stat-icon-circle">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                        </div>
                        <div class="stat-details">
                            <span class="stat-label">Total Projects</span>
                            <span class="stat-value">19</span>
                            <span class="stat-sub">Driving innovation. Delivering impact.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <div class="container-fluid projects-container">
        <!-- Filter Pills & Search Bar -->
        <div class="projects-toolbar">
            <div class="projects-filter-pills" role="tablist">
                <button type="button" class="filter-btn-pill is-active" data-filter="all" onclick="filterProjects('all', this)">All Projects</button>
                <button type="button" class="filter-btn-pill" data-filter="completed" onclick="filterProjects('completed', this)">Completed</button>
                <button type="button" class="filter-btn-pill" data-filter="ongoing" onclick="filterProjects('ongoing', this)">Ongoing</button>
            </div>
            <div class="projects-search-wrap">
                <input type="text" id="projects-search" class="projects-search-input" placeholder="Search projects..." oninput="handleSearch(this.value)">
                <svg class="projects-search-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
        </div>

        <!-- 6 Featured Projects Grid -->
        <div class="projects-featured-grid" id="featured-grid">
            <?php foreach ($featuredProjects as $p): ?>
                <article class="project-feature-card" data-status="<?php echo strtolower($p['status']); ?>" data-title="<?php echo htmlspecialchars(strtolower($p['title'])); ?>">
                    <div class="feature-card-top">
                        <div class="card-theme-icon" style="background: <?php echo $p['icon_bg']; ?>; color: <?php echo $p['icon_color']; ?>;">
                            <?php echo $p['svg']; ?>
                        </div>
                        <span class="project-badge-pill" style="background: <?php echo $p['badge_bg']; ?>; color: <?php echo $p['badge_color']; ?>;">
                            <?php echo htmlspecialchars($p['status']); ?>
                        </span>
                    </div>
                    <h2 class="feature-project-title"><?php echo htmlspecialchars($p['title']); ?></h2>
                    <p class="feature-project-desc"><?php echo htmlspecialchars($p['desc']); ?></p>
                    
                    <span class="feature-subhead">CORE CAPABILITIES</span>
                    <div class="feature-capabilities">
                        <?php foreach ($p['capabilities'] as $cap): ?>
                            <?php $capDesc = get_technology_description($cap); ?>
                            <button type="button" 
                                    class="capability-tag" 
                                    data-name="<?php echo htmlspecialchars($cap); ?>"
                                    data-info="<?php echo htmlspecialchars($capDesc); ?>"
                                    title="<?php echo htmlspecialchars($capDesc); ?>"
                                    style="background: <?php echo $p['tag_bg']; ?>; color: <?php echo $p['tag_color']; ?>; border: 1px solid <?php echo $p['tag_border']; ?>;"
                                    onclick="toggleCapabilityDesc(this, event)">
                                <?php echo htmlspecialchars($cap); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Interactive Capability Description Drawer -->
                    <div class="capability-desc-box" style="display: none;">
                        <div class="desc-box-content">
                            <span class="desc-box-icon">💡</span>
                            <div class="desc-box-text">
                                <strong class="desc-cap-title"></strong>: <span class="desc-cap-body"></span>
                            </div>
                            <button type="button" class="desc-box-close" onclick="closeCapabilityDesc(this, event)" aria-label="Close">&times;</button>
                        </div>
                    </div>

                    <a href="project_detail.php?id=<?php echo (int)$p['id']; ?>" class="feature-card-link" style="color: <?php echo $p['link_color']; ?>;">
                        View project <span>&rarr;</span>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- More Research Projects Section -->
        <div class="more-projects-panel" id="more-panel">
            <div class="more-projects-header">
                <div class="more-header-left">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#0d7a57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <h3>More Research Projects</h3>
                </div>
                <a href="#featured-grid" class="more-header-right" onclick="filterProjects('all')">
                    View all 19 projects <span>&rarr;</span>
                </a>
            </div>

            <div class="more-projects-grid" id="more-grid">
                <?php foreach ($moreProjects as $mp): ?>
                    <?php 
                    $stClass = (strtoupper($mp['status']) === 'COMPLETED') ? '#027a48' : '#175cd3';
                    ?>
                    <a href="project_detail.php?id=<?php echo (int)$mp['id']; ?>" class="more-project-item" data-status="<?php echo strtolower($mp['status']); ?>" data-title="<?php echo htmlspecialchars(strtolower($mp['title'])); ?>">
                        <div class="more-item-left">
                            <div class="more-item-icon" style="background: <?php echo $mp['icon_bg']; ?>; color: <?php echo $mp['icon_color']; ?>;">
                                <?php echo $mp['svg']; ?>
                            </div>
                            <div class="more-item-info">
                                <span class="more-item-title"><?php echo htmlspecialchars($mp['title']); ?></span>
                                <span class="more-item-status" style="color: <?php echo $stClass; ?>;"><?php echo htmlspecialchars($mp['status']); ?></span>
                            </div>
                        </div>
                        <span class="more-item-arrow">&rsaquo;</span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
let activeFilter = 'all';
let currentSearch = '';

function filterProjects(status, btn) {
    activeFilter = status;

    if (btn) {
        document.querySelectorAll('.filter-btn-pill').forEach(function(b) {
            b.classList.remove('is-active');
        });
        btn.classList.add('is-active');
    }

    applyFiltering();
}

function handleSearch(val) {
    currentSearch = val.toLowerCase().trim();
    applyFiltering();
}

function applyFiltering() {
    // Filter Featured Cards
    const cards = document.querySelectorAll('.project-feature-card');
    cards.forEach(function(card) {
        const cStatus = card.getAttribute('data-status');
        const cTitle = card.getAttribute('data-title');
        
        const matchesStatus = (activeFilter === 'all' || cStatus === activeFilter);
        const matchesSearch = (!currentSearch || cTitle.includes(currentSearch));

        if (matchesStatus && matchesSearch) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });

    // Filter More Projects List
    const items = document.querySelectorAll('.more-project-item');
    items.forEach(function(item) {
        const iStatus = item.getAttribute('data-status');
        const iTitle = item.getAttribute('data-title');

        const matchesStatus = (activeFilter === 'all' || iStatus === activeFilter);
        const matchesSearch = (!currentSearch || iTitle.includes(currentSearch));

        if (matchesStatus && matchesSearch) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
}

function toggleCapabilityDesc(btn, e) {
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }
    const card = btn.closest('.project-feature-card');
    if (!card) return;

    const descBox = card.querySelector('.capability-desc-box');
    const titleSpan = descBox.querySelector('.desc-cap-title');
    const bodySpan = descBox.querySelector('.desc-cap-body');
    const isAlreadyActive = btn.classList.contains('is-active');

    // Reset other active tags in this card
    card.querySelectorAll('.capability-tag').forEach(function(t) {
        t.classList.remove('is-active');
    });

    if (isAlreadyActive && descBox.style.display !== 'none') {
        descBox.style.display = 'none';
    } else {
        btn.classList.add('is-active');
        titleSpan.textContent = btn.dataset.name || btn.textContent.trim();
        bodySpan.textContent = btn.dataset.info || 'Specialized geospatial technique applied to this project.';
        descBox.style.display = 'block';
    }
}

function closeCapabilityDesc(closeBtn, e) {
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }
    const card = closeBtn.closest('.project-feature-card');
    if (!card) return;

    card.querySelectorAll('.capability-tag').forEach(function(t) {
        t.classList.remove('is-active');
    });
    const descBox = card.querySelector('.capability-desc-box');
    if (descBox) {
        descBox.style.display = 'none';
    }
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
