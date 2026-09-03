<?php
$pageTitle = 'Research';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

$dbAreas = get_research_areas_with_projects($pdo, 12);

// Map DB areas by lowercase key for association
$areasByKey = [];
if (!empty($dbAreas)) {
    foreach ($dbAreas as $a) {
        $t = strtolower($a['title']);
        if (strpos($t, 'geoai') !== false || strpos($t, 'decision') !== false) {
            $areasByKey['geoai'] = $a;
        } elseif (strpos($t, 'environmental') !== false || strpos($t, 'air') !== false) {
            $areasByKey['environmental'] = $a;
        } elseif (strpos($t, 'addressing') !== false || strpos($t, 'hierarchical') !== false) {
            $areasByKey['addressing'] = $a;
        } elseif (strpos($t, 'agricultural') !== false || strpos($t, 'knowledge') !== false) {
            $areasByKey['agricultural'] = $a;
        }
    }
}

// 4 Exact Domain Cards matching user reference screenshot
$domains = [
    [
        'key' => 'geoai',
        'title' => 'GeoAI, Spatial Data & Decision Support',
        'desc' => 'Combine PostgreSQL/PostGIS, spatial joins, APIs, coordinate transformations, data engineering, visualization, automation, machine learning, and environmental or agricultural datasets into usable decision-support platforms.',
        'badge' => '3 PROJECTS',
        'badge_bg' => '#ecfdf3',
        'badge_color' => '#027a48',
        'accent_color' => '#027a48',
        'icon_bg' => '#ecfdf3',
        'icon_border' => 'rgba(2, 122, 72, 0.22)',
        'icon_color' => '#027a48',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="6" width="12" height="12" rx="2"></rect><rect x="9.5" y="9.5" width="5" height="5"></rect><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"></path><circle cx="9" cy="2" r="1" fill="currentColor"></circle><circle cx="15" cy="2" r="1" fill="currentColor"></circle><circle cx="9" cy="22" r="1" fill="currentColor"></circle><circle cx="15" cy="22" r="1" fill="currentColor"></circle><circle cx="2" cy="9" r="1" fill="currentColor"></circle><circle cx="2" cy="15" r="1" fill="currentColor"></circle><circle cx="22" cy="9" r="1" fill="currentColor"></circle><circle cx="22" cy="15" r="1" fill="currentColor"></circle></svg>',
        'db_id' => $areasByKey['geoai']['id'] ?? 2
    ],
    [
        'key' => 'environmental',
        'title' => 'Environmental Intelligence & Air Quality',
        'desc' => 'Monitor smog and pollution across Punjab through district-level AQI maps, source-contribution analysis, historical comparisons, and CNN/LSTM-CNN forecasts for 7-day, 14-day, and 21-day horizons.',
        'badge' => '5 PROJECTS',
        'badge_bg' => '#eff8ff',
        'badge_color' => '#175cd3',
        'accent_color' => '#175cd3',
        'icon_bg' => '#eff8ff',
        'icon_border' => 'rgba(23, 92, 211, 0.22)',
        'icon_color' => '#175cd3',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"></path><path d="M5 16h6"></path><path d="M3 19h8"></path><path d="M5 22h4"></path></svg>',
        'db_id' => $areasByKey['environmental']['id'] ?? 3
    ],
    [
        'key' => 'addressing',
        'title' => 'Hierarchical Geospatial Addressing',
        'desc' => "Build precise digital location infrastructure through HumMuqaam's L0-to-L6 hierarchy, administrative boundaries, spatial grids, point-in-polygon analysis, and unique D-Code assignment.",
        'badge' => '2 PROJECTS',
        'badge_bg' => '#f9f5ff',
        'badge_color' => '#6941c6',
        'accent_color' => '#6941c6',
        'icon_bg' => '#f9f5ff',
        'icon_border' => 'rgba(105, 65, 198, 0.22)',
        'icon_color' => '#6941c6',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 12 12 17 22 12"></polyline><polyline points="2 17 12 22 22 17"></polyline></svg>',
        'db_id' => $areasByKey['addressing']['id'] ?? 4
    ],
    [
        'key' => 'agricultural',
        'title' => 'Agricultural Knowledge Systems',
        'desc' => 'Develop structured crop intelligence covering varieties, seasons, soil, climate, irrigation, fertilizer, diseases, pests, treatments, growth stages, and yield information for data-driven agriculture.',
        'badge' => '4 PROJECTS',
        'badge_bg' => '#f0fdf9',
        'badge_color' => '#0e7052',
        'accent_color' => '#0e7052',
        'icon_bg' => '#f0fdf9',
        'icon_border' => 'rgba(14, 112, 82, 0.22)',
        'icon_color' => '#0e7052',
        'svg' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21v-8"></path><path d="M12 13c-3-3-5-5.5-5-7.5a5 5 0 0 1 10 0c0 2-2 4.5-5 7.5Z"></path><path d="M12 7v4"></path><path d="M8 16c-1.8-.8-3-2.5-3-4 0 0 2.5-.8 4.2.8"></path><path d="M16 16c1.8-.8 3-2.5 3-4 0 0-2.5-.8-4.2.8"></path></svg>',
        'db_id' => $areasByKey['agricultural']['id'] ?? 5
    ]
];
?>

<div class="research-page">
    <!-- Hero Section with Globe Background -->
    <section class="research-hero-section">
        <div class="container-fluid research-container">
            <div class="row align-items-center">
                <div class="col-lg-7 research-hero-content">
                    <div class="research-kicker-wrap">
                        <span class="research-kicker">OUR RESEARCH</span>
                        <span class="research-kicker-bar"></span>
                    </div>
                    <h1 class="research-main-title">
                        <span class="title-dark">Research</span>
                        <span class="title-gradient">Domains</span>
                    </h1>
                    <p class="research-intro-lead">
                        Our research connects environmental intelligence, hierarchical geospatial infrastructure, and agricultural knowledge with GIS, data engineering, and AI.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Research Domain Cards Section -->
    <section class="research-domains-section">
        <div class="container-fluid research-container">
            <div class="research-domains-grid">
                <?php foreach ($domains as $d): ?>
                    <article class="research-domain-card-new" onclick="showProjectsForArea(event, <?php echo (int)$d['db_id']; ?>)" role="button" tabindex="0">
                        <div class="domain-card-top">
                            <div class="domain-icon-badge" style="background: <?php echo $d['icon_bg']; ?>; border: 1px solid <?php echo $d['icon_border']; ?>; color: <?php echo $d['icon_color']; ?>;">
                                <?php echo $d['svg']; ?>
                            </div>
                            <span class="domain-pill-badge" style="background: <?php echo $d['badge_bg']; ?>; color: <?php echo $d['badge_color']; ?>;">
                                <?php echo htmlspecialchars($d['badge']); ?>
                            </span>
                        </div>
                        <div class="domain-accent-bar" style="background: <?php echo $d['accent_color']; ?>;"></div>
                        <h2 class="domain-title"><?php echo htmlspecialchars($d['title']); ?></h2>
                        <p class="domain-description"><?php echo htmlspecialchars($d['desc']); ?></p>
                        <a href="#research-projects-<?php echo (int)$d['db_id']; ?>" class="domain-link" style="color: <?php echo $d['accent_color']; ?>;" onclick="showProjectsForArea(event, <?php echo (int)$d['db_id']; ?>)">
                            Learn more <span>&rarr;</span>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Dynamic Project Lists per Research Domain -->
            <?php if (!empty($dbAreas)): ?>
                <?php foreach ($dbAreas as $a): ?>
                    <?php $areaProjects = get_projects_by_research_area($pdo, (int)$a['id']); ?>
                    <div id="research-projects-<?php echo (int)$a['id']; ?>" class="research-projects-section" style="display: none;">
                        <div class="research-projects-header">
                            <h2>Projects in <span><?php echo htmlspecialchars($a['title']); ?></span></h2>
                            <button type="button" class="close-projects-btn" onclick="closeProjects(<?php echo (int)$a['id']; ?>)" aria-label="Close">&times;</button>
                        </div>
                        <div class="row g-4">
                            <?php if (!empty($areaProjects)): ?>
                                <?php foreach ($areaProjects as $proj): ?>
                                    <div class="col-lg-6 col-xl-4">
                                        <article class="project-item-card">
                                            <span class="project-item-status"><?php echo htmlspecialchars(ucfirst($proj['status'] ?? 'Active')); ?></span>
                                            <h3 class="project-item-title"><?php echo htmlspecialchars($proj['title']); ?></h3>
                                            <p class="project-item-summary"><?php echo htmlspecialchars(mb_substr($proj['summary'] ?? $proj['objectives'] ?? '', 0, 220)); ?>...</p>
                                            <a href="project_detail.php?id=<?php echo (int)$proj['id']; ?>" class="project-item-btn">
                                                View Project Details <span>&rarr;</span>
                                            </a>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12"><p class="text-muted text-center py-4">No projects listed under this research area currently.</p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</div>

<script>
function showProjectsForArea(e, researchId) {
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }
    const projectsSection = document.getElementById('research-projects-' + researchId);
    if (!projectsSection) return false;

    const isAlreadyOpen = (projectsSection.style.display === 'block');

    document.querySelectorAll('.research-projects-section').forEach(function (section) {
        section.style.display = 'none';
    });

    if (!isAlreadyOpen) {
        projectsSection.style.display = 'block';
        projectsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    return false;
}

function closeProjects(researchId) {
    const projectsSection = document.getElementById('research-projects-' + researchId);
    if (projectsSection) {
        projectsSection.style.display = 'none';
    }
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
