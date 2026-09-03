<?php
$pageTitle = 'Publications';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

// Fetch publications from database
$pubs = get_publications_filtered($pdo, 12);

// Map known journals, volume tags, and thumbnails matching the reference screenshot
function get_pub_meta($p) {
    $t = strtolower($p['title'] ?? '');
    
    if (strpos($t, 'evapotranspiration') !== false || strpos($t, 'wheat') !== false) {
        return [
            'journal' => 'JOURNAL OF PUBLIC POLICY PRACTITIONERS',
            'volume' => 'Vol. 4, No. 1',
            'image' => 'assets/images/publications/pub_wheat_clear.jpg'
        ];
    } elseif (strpos($t, 'mustafabad') !== false || strpos($t, 'crop types') !== false) {
        return [
            'journal' => 'JOURNAL OF AGRICULTURAL POLICY AND TRANSFORMATION',
            'volume' => 'Vol. 1, No. 1',
            'image' => 'assets/images/publications/pub_gis_clear.jpg'
        ];
    } else {
        // Fallback for any other database publication
        $j = !empty($p['journal']) ? strtoupper($p['journal']) : 'JOURNAL OF GEOSPATIAL DATA SCIENCE';
        return [
            'journal' => $j,
            'volume' => 'Vol. 1, No. 1',
            'image' => !empty($p['featured_image']) ? $p['featured_image'] : 'assets/images/Optimizing_agriculture_policy_journal.jpg'
        ];
    }
}
?>

<div class="publications-page-wrap">
    <!-- Hero Section with Dark Emerald World Publications Background -->
    <section class="publications-hero">
        <div class="container-fluid publications-container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="publications-kicker">RESEARCH PUBLICATIONS</span>
                    <h1 class="publications-main-title">
                        Research <span class="title-accent">Publications</span>
                    </h1>
                    <span class="publications-accent-line"></span>
                    <p class="publications-subtitle-lead">
                        Explore recent peer-reviewed research, conference papers, and technical reports from GDSG.
                    </p>
                </div>
                <div class="col-lg-4 d-flex justify-content-lg-end mt-4 mt-lg-0">
                    <div class="publications-browse-wrapper">
                        <button type="button" class="publications-browse-btn-new" id="browsePubsBtn" onclick="toggleBrowseDropdown(event)" aria-expanded="false">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                            </svg>
                            <span>Browse Publications</span>
                            <svg class="browse-chevron" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <!-- Sleek Dropdown with Both Publications -->
                        <div class="publications-dropdown-menu" id="browsePubsDropdown">
                            <div class="dropdown-header-label">RESEARCH PAPERS (2)</div>
                            
                            <a href="publication_detail.php?id=2" class="pub-dropdown-item">
                                <div class="dropdown-item-icon">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#027a48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </div>
                                <div class="dropdown-item-text">
                                    <span class="dropdown-item-title">Strategic Assessment of Evapotranspiration for Wheat Cultivation</span>
                                    <span class="dropdown-item-meta">Journal of Public Policy Practitioners &bull; 2025</span>
                                </div>
                                <span class="dropdown-item-arrow">&rarr;</span>
                            </a>

                            <a href="publication_detail.php?id=3" class="pub-dropdown-item">
                                <div class="dropdown-item-icon">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#027a48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </div>
                                <div class="dropdown-item-text">
                                    <span class="dropdown-item-title">Classification and Distribution Analysis of Crop Types Using GIS</span>
                                    <span class="dropdown-item-meta">Journal of Agricultural Policy &bull; 2025</span>
                                </div>
                                <span class="dropdown-item-arrow">&rarr;</span>
                            </a>

                            <div class="dropdown-footer-link">
                                <a href="#publications-grid" onclick="closeBrowseDropdown()">View full papers on page &darr;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Publications Grid Section -->
    <div class="container-fluid publications-container">
        <div class="publications-cards-grid" id="publications-grid">
            <?php if (!empty($pubs)): ?>
                <?php foreach ($pubs as $p): ?>
                    <?php $meta = get_pub_meta($p); ?>
                    <article class="publication-feature-card">
                        <!-- Left: Paper Preview Thumbnail -->
                        <div class="pub-card-preview">
                            <img src="<?php echo htmlspecialchars($meta['image']); ?>" alt="Document preview of <?php echo htmlspecialchars($p['title']); ?>">
                        </div>

                        <!-- Right: Details -->
                        <div class="pub-card-content">
                            <div class="pub-journal-header">
                                <div class="pub-journal-icon">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                                        <path d="M6 6h10M6 10h10"></path>
                                    </svg>
                                </div>
                                <span class="pub-journal-name"><?php echo htmlspecialchars($meta['journal']); ?></span>
                            </div>

                            <span class="pub-volume-pill"><?php echo htmlspecialchars($meta['volume']); ?></span>

                            <h2 class="pub-article-title"><?php echo htmlspecialchars($p['title']); ?></h2>

                            <p class="pub-article-meta">
                                <?php echo htmlspecialchars($p['authors']); ?> <span class="text-muted">|</span> <strong><?php echo htmlspecialchars($p['year'] ?? '2025'); ?></strong>
                            </p>

                            <p class="pub-article-excerpt">
                                <?php echo htmlspecialchars($p['summary'] ?? ''); ?>
                            </p>

                            <a href="publication_detail.php?id=<?php echo (int)$p['id']; ?>" class="pub-view-link">
                                View Publication <span>&rarr;</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 py-5 text-center text-muted">
                    No publications found.
                </div>
            <?php endif; ?>
        </div>
</div>

<script>
function toggleBrowseDropdown(e) {
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }
    const btn = document.getElementById('browsePubsBtn');
    const dropdown = document.getElementById('browsePubsDropdown');
    if (btn && dropdown) {
        btn.classList.toggle('is-open');
        dropdown.classList.toggle('show');
    }
}

function closeBrowseDropdown() {
    const btn = document.getElementById('browsePubsBtn');
    const dropdown = document.getElementById('browsePubsDropdown');
    if (btn) btn.classList.remove('is-open');
    if (dropdown) dropdown.classList.remove('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    const wrapper = document.querySelector('.publications-browse-wrapper');
    if (wrapper && !wrapper.contains(e.target)) {
        closeBrowseDropdown();
    }
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
