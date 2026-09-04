<?php
$pageTitle = 'Blogs & Articles';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require_once __DIR__ . '/includes/blog_data.php';

// Server-side query parameters
$requestedPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$requestedCategorySlug = $_GET['category'] ?? 'all';
$requestedTag = trim($_GET['tag'] ?? '');
$requestedSearch = trim($_GET['search'] ?? '');
$requestedSort = $_GET['sort'] ?? 'latest';

// Determine active category name
$activeCategoryName = 'All Posts';
foreach ($categories as $cat) {
    if ($cat['slug'] === $requestedCategorySlug) {
        $activeCategoryName = $cat['name'];
        break;
    }
}

// Server-side filtering
$filteredPosts = array_values(array_filter($allBlogPosts, function ($post) use ($requestedCategorySlug, $activeCategoryName, $requestedTag, $requestedSearch) {
    if ($requestedCategorySlug !== 'all') {
        $matchesCat = (strtolower($post['category']) === strtolower($activeCategoryName)) ||
                      (strtolower($post['category']) === strtolower($requestedCategorySlug));
        if (!$matchesCat) return false;
    }
    if ($requestedTag !== '') {
        $tagLower = strtolower($requestedTag);
        $hasTag = false;
        foreach ($post['tags'] as $t) {
            if (strtolower($t) === $tagLower) {
                $hasTag = true;
                break;
            }
        }
        if (!$hasTag) return false;
    }
    if ($requestedSearch !== '') {
        $q = strtolower($requestedSearch);
        $inTitle = strpos(strtolower($post['title']), $q) !== false;
        $inSummary = strpos(strtolower($post['summary']), $q) !== false;
        if (!$inTitle && !$inSummary) return false;
    }
    return true;
}));

// Server-side sorting
if ($requestedSort === 'title') {
    usort($filteredPosts, fn($a, $b) => strcmp($a['title'], $b['title']));
} elseif ($requestedSort === 'oldest') {
    usort($filteredPosts, fn($a, $b) => strtotime($a['date']) - strtotime($b['date']));
} else {
    usort($filteredPosts, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));
}

$POSTS_PER_PAGE = 6;
$totalPosts = count($filteredPosts);
$totalPages = max(1, (int)ceil($totalPosts / $POSTS_PER_PAGE));
$currentPage = min($requestedPage, $totalPages);
$offset = ($currentPage - 1) * $POSTS_PER_PAGE;
$pagePosts = array_slice($filteredPosts, $offset, $POSTS_PER_PAGE);

// URL generation helper
function buildBlogUrl($page, $catSlug = null, $tag = null, $search = null, $sort = null) {
    global $requestedCategorySlug, $requestedTag, $requestedSearch, $requestedSort;
    $catSlug = $catSlug !== null ? $catSlug : $requestedCategorySlug;
    $tag = $tag !== null ? $tag : $requestedTag;
    $search = $search !== null ? $search : $requestedSearch;
    $sort = $sort !== null ? $sort : $requestedSort;

    $params = [];
    if ($page > 1) $params['page'] = $page;
    if ($catSlug !== 'all') $params['category'] = $catSlug;
    if (!empty($tag)) $params['tag'] = $tag;
    if (!empty($search)) $params['search'] = $search;
    if ($sort !== 'latest') $params['sort'] = $sort;

    return empty($params) ? 'blogs.php' : ('blogs.php?' . http_build_query($params));
}

require __DIR__ . '/includes/header.php';
?>

<style>
/* ========================================================
   GDSG BLOGS & ARTICLES PAGE STYLING (EXACT DESIGN MATCH)
   ======================================================== */

.blogs-page-wrapper {
    background-color: #f8fafc;
    color: #1e293b;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    padding-bottom: 80px;
}

/* ---------------- HERO SECTION ---------------- */
.blogs-hero-section {
    position: relative;
    background-color: #020c1b;
    background-image: url('/assets/images/blogs/blogs_hero_clean.jpg');
    background-size: cover;
    background-position: center right;
    background-repeat: no-repeat;
    padding: 70px 0 65px;
    color: #ffffff;
    overflow: hidden;
}

.blogs-hero-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
}

.blogs-hero-badge {
    color: #10b981;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 12px;
    display: inline-block;
}

.blogs-hero-title {
    font-size: clamp(2.4rem, 4.5vw, 3.4rem);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.15;
    letter-spacing: -0.02em;
    margin-bottom: 14px;
}

.blogs-hero-desc {
    color: #cbd5e1;
    font-size: 1.05rem;
    line-height: 1.6;
    max-width: 580px;
    margin-bottom: 26px;
}

.blogs-search-form {
    max-width: 440px;
    display: flex;
    align-items: center;
    background: #ffffff;
    border-radius: 10px;
    padding: 4px 5px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
}

.blogs-search-input {
    flex: 1;
    border: none;
    outline: none;
    padding: 10px 14px;
    font-size: 0.92rem;
    color: #1e293b;
    background: transparent;
}

.blogs-search-input::placeholder {
    color: #94a3b8;
}

.blogs-search-btn {
    background: #059669;
    border: none;
    color: #ffffff;
    width: 42px;
    height: 42px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.15s ease;
}

.blogs-search-btn:hover {
    background: #047857;
    transform: scale(1.02);
}

/* ---------------- MAIN CONTAINER ---------------- */
.blogs-main-container {
    max-width: 1240px;
    margin: 45px auto 0;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 36px;
    align-items: start;
}

@media (max-width: 992px) {
    .blogs-main-container {
        grid-template-columns: 1fr;
    }
}

/* ---------------- SIDEBAR ---------------- */
.blogs-sidebar {
    display: flex;
    flex-direction: column;
    gap: 26px;
}

.sidebar-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 22px 20px;
    box-shadow: 0 2px 10px -2px rgba(15, 23, 42, 0.04);
}

.sidebar-card-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 16px;
    letter-spacing: -0.01em;
}

/* Categories List */
.categories-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.category-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 9px 12px;
    border-radius: 8px;
    color: #475569;
    text-decoration: none;
    font-size: 0.88rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.category-link:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.category-link.active {
    background: #ecfdf5;
    color: #059669;
    font-weight: 600;
}

.category-link-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.category-link-left .material-symbols-outlined {
    font-size: 18px;
    color: #64748b;
    transition: color 0.2s ease;
}

.category-link.active .category-link-left .material-symbols-outlined {
    color: #059669;
}

.category-count {
    font-size: 0.75rem;
    background: #f1f5f9;
    color: #64748b;
    padding: 2px 8px;
    border-radius: 9999px;
    font-weight: 600;
}

.category-link.active .category-count {
    background: #d1fae5;
    color: #059669;
}

/* Popular Tags */
.popular-tags-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 14px;
}

.tag-pill {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 0.78rem;
    font-weight: 500;
    padding: 5px 12px;
    border-radius: 9999px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.tag-pill:hover,
.tag-pill.active {
    background: #059669;
    color: #ffffff;
    border-color: #059669;
}

.view-all-tags-link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    color: #059669;
    font-size: 0.82rem;
    font-weight: 600;
    text-decoration: none;
    margin-top: 4px;
    transition: color 0.2s ease;
}

.view-all-tags-link:hover {
    color: #047857;
}

.view-all-tags-link .material-symbols-outlined {
    font-size: 16px;
}

/* Stay Updated */
.stay-updated-card p {
    font-size: 0.84rem;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 14px;
}

.sidebar-subscribe-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.sidebar-subscribe-input {
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 9px 12px;
    font-size: 0.85rem;
    color: #1e293b;
    outline: none;
    transition: border-color 0.2s ease;
}

.sidebar-subscribe-input:focus {
    border-color: #059669;
}

.sidebar-subscribe-btn {
    background: #059669;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 10px;
    font-size: 0.86rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: background 0.2s ease;
}

.sidebar-subscribe-btn:hover {
    background: #047857;
}

.sidebar-subscribe-btn .material-symbols-outlined {
    font-size: 16px;
}

/* ---------------- RIGHT CONTENT / POSTS GRID ---------------- */
.blogs-content-col {
    min-width: 0;
}

.blogs-content-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.blogs-content-title {
    font-size: 1.45rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.02em;
    margin: 0;
}

.blogs-sort-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #64748b;
}

.blogs-sort-select {
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 0.85rem;
    color: #1e293b;
    background: #ffffff;
    cursor: pointer;
    outline: none;
    transition: border-color 0.2s ease;
}

.blogs-sort-select:focus {
    border-color: #059669;
}

/* 6-Post Grid: 3 columns matching design */
.blogs-posts-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

@media (max-width: 1100px) {
    .blogs-posts-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .blogs-posts-grid {
        grid-template-columns: 1fr;
    }
}

.blog-post-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 18px -2px rgba(15, 23, 42, 0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    cursor: pointer;
}

.blog-post-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px -4px rgba(15, 23, 42, 0.09);
    border-color: #cbd5e1;
}

.blog-card-thumb {
    width: 100%;
    height: 155px;
    overflow: hidden;
    background: #0f172a;
    position: relative;
}

.blog-card-thumb a {
    display: block;
    width: 100%;
    height: 100%;
}

.blog-card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}

.blog-post-card:hover .blog-card-thumb img {
    transform: scale(1.05);
}

.blog-card-body {
    padding: 18px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.blog-card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
    gap: 8px;
    flex-wrap: wrap;
}

.blog-card-badge {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.02em;
    padding: 3px 9px;
    border-radius: 9999px;
    display: inline-block;
}

.badge-iot {
    background: #dcfce7;
    color: #15803d;
}

.badge-security {
    background: #dbeafe;
    color: #1d4ed8;
}

.badge-gis {
    background: #f3e8ff;
    color: #7e22ce;
}

.badge-wireless {
    background: #ffedd5;
    color: #c2410c;
}

.badge-ai {
    background: #ccfbf1;
    color: #0f766e;
}

.badge-tutorial {
    background: #fee2e2;
    color: #b91c1c;
}

.blog-card-date {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.75rem;
    color: #64748b;
    font-weight: 500;
    margin: 0;
}

.blog-card-date .material-symbols-outlined {
    font-size: 14px;
    color: #64748b;
}

.blog-card-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.35;
    margin: 0 0 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
}

.blog-card-title a:hover {
    color: #059669;
}

.blog-card-summary {
    font-size: 0.83rem;
    color: #475569;
    line-height: 1.5;
    margin-bottom: 18px;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-card-readmore {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.84rem;
    font-weight: 600;
    color: #059669;
    text-decoration: none;
    transition: color 0.2s ease, transform 0.2s ease;
    margin-top: auto;
}

.blog-card-readmore:hover {
    color: #047857;
    transform: translateX(4px);
}

.blog-card-readmore .material-symbols-outlined {
    font-size: 16px;
}

/* Pagination */
.blogs-pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 42px;
}

.page-btn {
    min-width: 36px;
    height: 36px;
    padding: 0 10px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #475569;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    user-select: none;
}

.page-btn:hover {
    background: #f1f5f9;
    color: #0f172a;
    border-color: #cbd5e1;
}

.page-btn.active {
    background: #059669;
    color: #ffffff;
    border-color: #059669;
    box-shadow: 0 2px 8px rgba(5, 150, 105, 0.25);
}

.page-btn[disabled] {
    opacity: 0.45;
    cursor: not-allowed;
    pointer-events: none;
}

.page-btn-arrow {
    gap: 4px;
    padding: 0 12px;
}

.page-btn-arrow .material-symbols-outlined {
    font-size: 16px;
}

.page-dots {
    color: #94a3b8;
    font-weight: 700;
    letter-spacing: 2px;
    padding: 0 4px;
}

/* ---------------- BOTTOM NEWSLETTER CALLOUT BANNER ---------------- */
.blogs-newsletter-callout {
    max-width: 1240px;
    margin: 50px auto 0;
    padding: 0 24px;
}

.newsletter-callout-card {
    background: #eef7fc;
    border: 1px solid #d1e9f6;
    border-radius: 20px;
    padding: 32px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
    box-shadow: 0 4px 20px -2px rgba(5, 150, 105, 0.04);
}

@media (max-width: 992px) {
    .newsletter-callout-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 28px;
    }
}

.callout-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

.callout-icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #ffffff;
    color: #059669;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(5, 150, 105, 0.12);
}

.callout-icon-circle .material-symbols-outlined {
    font-size: 30px;
}

.callout-heading {
    font-size: 1.45rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 4px;
    letter-spacing: -0.01em;
}

.callout-desc {
    font-size: 0.88rem;
    color: #475569;
    margin: 0;
    line-height: 1.5;
}

.callout-form {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

@media (max-width: 600px) {
    .callout-form {
        flex-direction: column;
        width: 100%;
    }
}

.callout-input {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 16px;
    font-size: 0.88rem;
    color: #1e293b;
    outline: none;
    width: 250px;
    transition: border-color 0.2s ease;
}

@media (max-width: 600px) {
    .callout-input {
        width: 100%;
    }
}

.callout-input:focus {
    border-color: #059669;
}

.callout-btn {
    background: #059669;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background 0.2s ease, transform 0.2s ease;
    white-space: nowrap;
}

.callout-btn:hover {
    background: #047857;
    transform: translateY(-1px);
}

.callout-btn .material-symbols-outlined {
    font-size: 16px;
}

/* Toast Notification */
.blogs-toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: #0f172a;
    color: #ffffff;
    padding: 14px 22px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 99999;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
    pointer-events: none;
}

.blogs-toast.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}
</style>

<div class="blogs-page-wrapper">
    <!-- 1. HERO SECTION -->
    <section class="blogs-hero-section">
        <div class="blogs-hero-container">
            <span class="blogs-hero-badge">BLOGS &amp; ARTICLES</span>
            <h1 class="blogs-hero-title">Insights. Innovation. Impact.</h1>
            <p class="blogs-hero-desc">Explore the latest blogs, research updates, and expert perspectives from GDSG.</p>
            
            <form class="blogs-search-form" id="blogsHeroSearchForm" onsubmit="event.preventDefault(); triggerFilterSearch();">
                <input type="text" 
                       id="blogsSearchInput" 
                       class="blogs-search-input" 
                       placeholder="Search blogs..." 
                       value="<?php echo htmlspecialchars($requestedSearch); ?>"
                       aria-label="Search blogs">
                <button type="submit" class="blogs-search-btn" aria-label="Search">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>
        </div>
    </section>

    <!-- 2. MAIN 2-COLUMN LAYOUT -->
    <div class="blogs-main-container">
        <!-- LEFT SIDEBAR -->
        <aside class="blogs-sidebar">
            <!-- Categories Card -->
            <div class="sidebar-card">
                <h3 class="sidebar-card-title">Categories</h3>
                <ul class="categories-list">
                    <?php foreach ($categories as $cat): ?>
                        <?php 
                            $isCatActive = ($cat['slug'] === $requestedCategorySlug); 
                            $catUrl = buildBlogUrl(1, $cat['slug']);
                        ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($catUrl); ?>" 
                               class="category-link js-category-filter <?php echo $isCatActive ? 'active' : ''; ?>"
                               data-category-slug="<?php echo htmlspecialchars($cat['slug']); ?>"
                               data-category-name="<?php echo htmlspecialchars($cat['name']); ?>">
                                <span class="category-link-left">
                                    <span class="material-symbols-outlined"><?php echo htmlspecialchars($cat['icon']); ?></span>
                                    <span><?php echo htmlspecialchars($cat['name']); ?></span>
                                </span>
                                <span class="category-count"><?php echo htmlspecialchars($cat['count']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Popular Tags Card -->
            <div class="sidebar-card">
                <h3 class="sidebar-card-title">Popular Tags</h3>
                <div class="popular-tags-wrap">
                    <?php foreach ($popularTags as $tag): ?>
                        <?php 
                            $isTagActive = (strtolower($tag) === strtolower($requestedTag));
                            $tagUrl = buildBlogUrl(1, null, $isTagActive ? '' : $tag);
                        ?>
                        <a href="<?php echo htmlspecialchars($tagUrl); ?>" 
                           class="tag-pill js-tag-filter <?php echo $isTagActive ? 'active' : ''; ?>" 
                           data-tag="<?php echo htmlspecialchars($tag); ?>">
                            <?php echo htmlspecialchars($tag); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <a href="blogs.php" class="view-all-tags-link" id="clearTagsBtn">
                    <span>View all tags</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>

            <!-- Stay Updated Card -->
            <div class="sidebar-card stay-updated-card">
                <h3 class="sidebar-card-title">Stay Updated</h3>
                <p>Subscribe to our newsletter to get the latest blogs, events, and updates.</p>
                <form class="sidebar-subscribe-form js-newsletter-form">
                    <input type="email" 
                           class="sidebar-subscribe-input" 
                           placeholder="Enter your email" 
                           required>
                    <button type="submit" class="sidebar-subscribe-btn">
                        <span>Subscribe</span>
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- RIGHT POSTS GRID -->
        <main class="blogs-content-col">
            <div class="blogs-content-header" id="postsSectionAnchor">
                <h2 class="blogs-content-title" id="postsSectionTitle">
                    <?php
                    if ($requestedCategorySlug !== 'all') {
                        echo htmlspecialchars($activeCategoryName);
                    } elseif (!empty($requestedTag)) {
                        echo 'Tag: #' . htmlspecialchars($requestedTag);
                    } elseif (!empty($requestedSearch)) {
                        echo 'Search: "' . htmlspecialchars($requestedSearch) . '"';
                    } else {
                        echo 'All Posts';
                    }
                    ?>
                </h2>
                <div class="blogs-sort-wrap">
                    <span>Sort by:</span>
                    <select class="blogs-sort-select" id="blogsSortSelect">
                        <option value="latest" <?php echo $requestedSort === 'latest' ? 'selected' : ''; ?>>Latest</option>
                        <option value="oldest" <?php echo $requestedSort === 'oldest' ? 'selected' : ''; ?>>Oldest</option>
                        <option value="title" <?php echo $requestedSort === 'title' ? 'selected' : ''; ?>>Title (A-Z)</option>
                    </select>
                </div>
            </div>

            <!-- Server-Side Pre-Rendered Posts Grid -->
            <div class="blogs-posts-grid" id="blogsPostsGrid" style="<?php echo empty($pagePosts) ? 'display: none;' : ''; ?>">
                <?php foreach ($pagePosts as $post): ?>
                    <?php $detailUrl = 'blog_detail.php?slug=' . urlencode($post['slug']); ?>
                    <article class="blog-post-card" onclick="location.href='<?php echo htmlspecialchars($detailUrl); ?>'">
                        <div class="blog-card-thumb">
                            <a href="<?php echo htmlspecialchars($detailUrl); ?>" tabindex="-1">
                                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" loading="lazy">
                            </a>
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-card-meta">
                                <span class="blog-card-badge <?php echo htmlspecialchars($post['badge_class']); ?>">
                                    <?php echo htmlspecialchars($post['category']); ?>
                                </span>
                                <span class="blog-card-date">
                                    <span class="material-symbols-outlined">calendar_today</span>
                                    <?php echo htmlspecialchars($post['date']); ?>
                                </span>
                            </div>
                            <h3 class="blog-card-title">
                                <a href="<?php echo htmlspecialchars($detailUrl); ?>"><?php echo htmlspecialchars($post['title']); ?></a>
                            </h3>
                            <p class="blog-card-summary">
                                <?php echo htmlspecialchars($post['summary']); ?>
                            </p>
                            <a href="<?php echo htmlspecialchars($detailUrl); ?>" class="blog-card-readmore" onclick="event.stopPropagation();">
                                <span>Read more</span>
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Empty state if search finds nothing -->
            <div id="noPostsFound" style="<?php echo empty($pagePosts) ? 'display: block;' : 'display: none;'; ?> padding: 48px; text-align: center; background: #ffffff; border-radius: 16px; border: 1px dashed #cbd5e1; margin-top: 10px;">
                <span class="material-symbols-outlined" style="font-size: 48px; color: #94a3b8; margin-bottom: 12px;">search_off</span>
                <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin-bottom: 6px;">No blog posts found</h4>
                <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 16px;">Try adjusting your search terms or selecting a different category.</p>
                <button type="button" class="btn btn-outline-success btn-sm" onclick="resetFilters()">Reset all filters</button>
            </div>

            <!-- Server-Side Pre-Rendered Pagination -->
            <div class="blogs-pagination-wrap" id="blogsPaginationWrap">
                <?php if ($totalPages > 1): ?>
                    <?php if ($currentPage > 1): ?>
                        <a href="<?php echo htmlspecialchars(buildBlogUrl($currentPage - 1)); ?>" 
                           class="page-btn page-btn-arrow" 
                           data-goto="<?php echo $currentPage - 1; ?>">
                            <span class="material-symbols-outlined">arrow_back</span>
                            <span>Prev</span>
                        </a>
                    <?php endif; ?>

                    <?php
                    if ($totalPages <= 7) {
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $isActive = ($i === $currentPage);
                            echo '<a href="' . htmlspecialchars(buildBlogUrl($i)) . '" class="page-btn ' . ($isActive ? 'active' : '') . '" data-goto="' . $i . '">' . $i . '</a>';
                        }
                    } else {
                        if ($currentPage <= 3) {
                            for ($i = 1; $i <= 3; $i++) {
                                $isActive = ($i === $currentPage);
                                echo '<a href="' . htmlspecialchars(buildBlogUrl($i)) . '" class="page-btn ' . ($isActive ? 'active' : '') . '" data-goto="' . $i . '">' . $i . '</a>';
                            }
                            echo '<span class="page-dots">...</span>';
                            $isActive = ($totalPages === $currentPage);
                            echo '<a href="' . htmlspecialchars(buildBlogUrl($totalPages)) . '" class="page-btn ' . ($isActive ? 'active' : '') . '" data-goto="' . $totalPages . '">' . $totalPages . '</a>';
                        } elseif ($currentPage >= $totalPages - 2) {
                            echo '<a href="' . htmlspecialchars(buildBlogUrl(1)) . '" class="page-btn" data-goto="1">1</a>';
                            echo '<span class="page-dots">...</span>';
                            for ($i = $totalPages - 2; $i <= $totalPages; $i++) {
                                $isActive = ($i === $currentPage);
                                echo '<a href="' . htmlspecialchars(buildBlogUrl($i)) . '" class="page-btn ' . ($isActive ? 'active' : '') . '" data-goto="' . $i . '">' . $i . '</a>';
                            }
                        } else {
                            echo '<a href="' . htmlspecialchars(buildBlogUrl(1)) . '" class="page-btn" data-goto="1">1</a>';
                            echo '<span class="page-dots">...</span>';
                            echo '<a href="' . htmlspecialchars(buildBlogUrl($currentPage)) . '" class="page-btn active" data-goto="' . $currentPage . '">' . $currentPage . '</a>';
                            echo '<span class="page-dots">...</span>';
                            echo '<a href="' . htmlspecialchars(buildBlogUrl($totalPages)) . '" class="page-btn" data-goto="' . $totalPages . '">' . $totalPages . '</a>';
                        }
                    }
                    ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="<?php echo htmlspecialchars(buildBlogUrl($currentPage + 1)); ?>" 
                           class="page-btn page-btn-arrow" 
                           data-goto="<?php echo $currentPage + 1; ?>">
                            <span>Next</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- 3. BOTTOM NEWSLETTER CALLOUT BANNER -->
    <div class="blogs-newsletter-callout">
        <div class="newsletter-callout-card">
            <div class="callout-left">
                <div class="callout-icon-circle">
                    <span class="material-symbols-outlined">mail</span>
                </div>
                <div>
                    <h3 class="callout-heading">Never miss an update</h3>
                    <p class="callout-desc">Subscribe to our newsletter and get the latest news, events, and blogs delivered to your inbox.</p>
                </div>
            </div>
            <form class="callout-form js-newsletter-form">
                <input type="email" 
                       class="callout-input" 
                       placeholder="Enter your email" 
                       required>
                <button type="submit" class="callout-btn">
                    <span>Subscribe</span>
                    <span class="material-symbols-outlined">send</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- TOAST NOTIFICATION -->
<div id="blogsToast" class="blogs-toast">
    <span class="material-symbols-outlined" style="color: #10b981;">check_circle</span>
    <span id="blogsToastMsg">Thank you for subscribing to GDSG blogs!</span>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

<!-- Embed shared dataset as JSON for seamless client-side enhancement -->
<script>
const BLOG_POSTS_DATA = <?php echo json_encode($allBlogPosts, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
const CATEGORIES_DATA = <?php echo json_encode($categories, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('blogsSearchInput');
    const categoryLinks = document.querySelectorAll('.js-category-filter');
    const tagButtons = document.querySelectorAll('.js-tag-filter');
    const clearTagsBtn = document.getElementById('clearTagsBtn');
    const sortSelect = document.getElementById('blogsSortSelect');
    const postsGrid = document.getElementById('blogsPostsGrid');
    const noPostsFound = document.getElementById('noPostsFound');
    const postsSectionTitle = document.getElementById('postsSectionTitle');
    const paginationWrap = document.getElementById('blogsPaginationWrap');
    const toast = document.getElementById('blogsToast');
    const toastMsg = document.getElementById('blogsToastMsg');

    const POSTS_PER_PAGE = 6;
    
    // Read initial state from URL parameters
    const initialUrlParams = new URLSearchParams(window.location.search);
    let currentPage = parseInt(initialUrlParams.get('page'), 10) || <?php echo (int)$currentPage; ?>;
    let activeCategorySlug = initialUrlParams.get('category') || '<?php echo addslashes($requestedCategorySlug); ?>';
    let activeTag = initialUrlParams.get('tag') || <?php echo json_encode($requestedTag); ?>;
    let searchQuery = initialUrlParams.get('search') || <?php echo json_encode($requestedSearch); ?>;
    let sortMode = initialUrlParams.get('sort') || '<?php echo addslashes($requestedSort); ?>';

    function getCategoryNameBySlug(slug) {
        if (!slug || slug === 'all') return 'All Posts';
        const found = CATEGORIES_DATA.find(c => c.slug === slug);
        return found ? found.name : slug;
    }

    function showToast(msg) {
        toastMsg.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3500);
    }

    // Build URL query string
    function buildQueryUrl(page) {
        const params = new URLSearchParams();
        if (page > 1) params.set('page', page);
        if (activeCategorySlug && activeCategorySlug !== 'all') params.set('category', activeCategorySlug);
        if (activeTag) params.set('tag', activeTag);
        if (searchQuery) params.set('search', searchQuery);
        if (sortMode && sortMode !== 'latest') params.set('sort', sortMode);
        const q = params.toString();
        return q ? ('blogs.php?' + q) : 'blogs.php';
    }

    function syncBrowserUrl() {
        const newUrl = buildQueryUrl(currentPage);
        window.history.pushState({
            page: currentPage,
            category: activeCategorySlug,
            tag: activeTag,
            search: searchQuery,
            sort: sortMode
        }, '', newUrl);
    }

    // Filter and Sort dataset
    function getFilteredPosts() {
        const query = (searchQuery || '').trim().toLowerCase();
        const activeName = getCategoryNameBySlug(activeCategorySlug).toLowerCase();
        
        let filtered = BLOG_POSTS_DATA.filter(function (post) {
            const title = (post.title || '').toLowerCase();
            const summary = (post.summary || '').toLowerCase();
            const category = (post.category || '').toLowerCase();
            const tags = (post.tags || []).map(t => t.toLowerCase());

            const matchesSearch = !query || title.includes(query) || summary.includes(query);
            const matchesCategory = (activeCategorySlug === 'all') || (category === activeName) || (category === activeCategorySlug.toLowerCase());
            const matchesTag = !activeTag || tags.includes(activeTag.toLowerCase());

            return matchesSearch && matchesCategory && matchesTag;
        });

        // Apply sorting
        if (sortMode === 'title') {
            filtered.sort((a, b) => a.title.localeCompare(b.title));
        } else if (sortMode === 'oldest') {
            filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
        } else {
            // latest
            filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
        }

        return filtered;
    }

    // Render cards for the current page
    function renderPage(page, shouldScroll) {
        const filteredPosts = getFilteredPosts();
        const totalPosts = filteredPosts.length;
        const totalPages = Math.max(1, Math.ceil(totalPosts / POSTS_PER_PAGE));

        currentPage = Math.max(1, Math.min(page, totalPages));

        // Slice for current page
        const startIndex = (currentPage - 1) * POSTS_PER_PAGE;
        const pagePosts = filteredPosts.slice(startIndex, startIndex + POSTS_PER_PAGE);

        if (pagePosts.length === 0) {
            postsGrid.style.display = 'none';
            noPostsFound.style.display = 'block';
            paginationWrap.innerHTML = '';
            return;
        }

        postsGrid.style.display = 'grid';
        noPostsFound.style.display = 'none';

        // Render HTML for cards
        let html = '';
        pagePosts.forEach(function (post) {
            const detailUrl = 'blog_detail.php?slug=' + encodeURIComponent(post.slug);
            html += `
                <article class="blog-post-card" onclick="location.href='${detailUrl}'">
                    <div class="blog-card-thumb">
                        <a href="${detailUrl}" tabindex="-1">
                            <img src="${post.image}" alt="${escapeHtml(post.title)}" loading="lazy">
                        </a>
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-card-meta">
                            <span class="blog-card-badge ${post.badge_class}">
                                ${escapeHtml(post.category)}
                            </span>
                            <span class="blog-card-date">
                                <span class="material-symbols-outlined">calendar_today</span>
                                ${escapeHtml(post.date)}
                            </span>
                        </div>
                        <h3 class="blog-card-title">
                            <a href="${detailUrl}">${escapeHtml(post.title)}</a>
                        </h3>
                        <p class="blog-card-summary">
                            ${escapeHtml(post.summary)}
                        </p>
                        <a href="${detailUrl}" class="blog-card-readmore" onclick="event.stopPropagation();">
                            <span>Read more</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    </div>
                </article>
            `;
        });

        postsGrid.innerHTML = html;
        renderPagination(totalPages);

        if (shouldScroll) {
            const anchor = document.getElementById('postsSectionAnchor');
            if (anchor) {
                anchor.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    }

    // Render pagination controls matching mockup [1] [2] [3] ... [8] [Next →]
    function renderPagination(totalPages) {
        if (totalPages <= 1) {
            paginationWrap.innerHTML = '';
            return;
        }

        let phtml = '';

        // Previous button if on page > 1
        if (currentPage > 1) {
            phtml += `<a href="${buildQueryUrl(currentPage - 1)}" class="page-btn page-btn-arrow" data-goto="${currentPage - 1}">
                <span class="material-symbols-outlined">arrow_back</span>
                <span>Prev</span>
            </a>`;
        }

        // Build page buttons sequence
        if (totalPages <= 7) {
            for (let i = 1; i <= totalPages; i++) {
                phtml += `<a href="${buildQueryUrl(i)}" class="page-btn ${i === currentPage ? 'active' : ''}" data-goto="${i}">${i}</a>`;
            }
        } else {
            // If totalPages > 7 (e.g. 8 pages like mockup)
            if (currentPage <= 3) {
                for (let i = 1; i <= 3; i++) {
                    phtml += `<a href="${buildQueryUrl(i)}" class="page-btn ${i === currentPage ? 'active' : ''}" data-goto="${i}">${i}</a>`;
                }
                phtml += `<span class="page-dots">...</span>`;
                phtml += `<a href="${buildQueryUrl(totalPages)}" class="page-btn ${totalPages === currentPage ? 'active' : ''}" data-goto="${totalPages}">${totalPages}</a>`;
            } else if (currentPage >= totalPages - 2) {
                phtml += `<a href="${buildQueryUrl(1)}" class="page-btn" data-goto="1">1</a>`;
                phtml += `<span class="page-dots">...</span>`;
                for (let i = totalPages - 2; i <= totalPages; i++) {
                    phtml += `<a href="${buildQueryUrl(i)}" class="page-btn ${i === currentPage ? 'active' : ''}" data-goto="${i}">${i}</a>`;
                }
            } else {
                phtml += `<a href="${buildQueryUrl(1)}" class="page-btn" data-goto="1">1</a>`;
                phtml += `<span class="page-dots">...</span>`;
                phtml += `<a href="${buildQueryUrl(currentPage)}" class="page-btn active" data-goto="${currentPage}">${currentPage}</a>`;
                phtml += `<span class="page-dots">...</span>`;
                phtml += `<a href="${buildQueryUrl(totalPages)}" class="page-btn" data-goto="${totalPages}">${totalPages}</a>`;
            }
        }

        // Next button if not on last page
        if (currentPage < totalPages) {
            phtml += `<a href="${buildQueryUrl(currentPage + 1)}" class="page-btn page-btn-arrow" data-goto="${currentPage + 1}">
                <span>Next</span>
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>`;
        }

        paginationWrap.innerHTML = phtml;
    }

    // Delegated click listener on pagination container
    paginationWrap.addEventListener('click', function (e) {
        const btn = e.target.closest('.page-btn');
        if (!btn) return;
        const targetPage = parseInt(btn.getAttribute('data-goto'), 10);
        if (targetPage && targetPage !== currentPage) {
            e.preventDefault();
            currentPage = targetPage;
            renderPage(currentPage, true);
            syncBrowserUrl();
        }
    });

    function updateSectionTitle() {
        if (activeCategorySlug !== 'all') {
            postsSectionTitle.textContent = getCategoryNameBySlug(activeCategorySlug);
        } else if (activeTag) {
            postsSectionTitle.textContent = `Tag: #${activeTag}`;
        } else if (searchQuery) {
            postsSectionTitle.textContent = `Search: "${searchQuery}"`;
        } else {
            postsSectionTitle.textContent = 'All Posts';
        }
    }

    window.triggerFilterSearch = function () {
        searchQuery = (searchInput.value || '').trim();
        currentPage = 1;
        updateSectionTitle();
        renderPage(1, true);
        syncBrowserUrl();
    };

    window.resetFilters = function () {
        searchInput.value = '';
        activeCategorySlug = 'all';
        activeTag = null;
        searchQuery = '';
        categoryLinks.forEach(l => l.classList.remove('active'));
        if (categoryLinks[0]) categoryLinks[0].classList.add('active');
        tagButtons.forEach(b => b.classList.remove('active'));
        currentPage = 1;
        updateSectionTitle();
        renderPage(1, true);
        syncBrowserUrl();
    };

    // Category click
    categoryLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            categoryLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
            activeCategorySlug = link.getAttribute('data-category-slug') || 'all';
            activeTag = null;
            tagButtons.forEach(b => b.classList.remove('active'));
            currentPage = 1;
            updateSectionTitle();
            renderPage(1, true);
            syncBrowserUrl();
        });
    });

    // Tag click
    tagButtons.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const tag = btn.getAttribute('data-tag');
            if (activeTag === tag) {
                activeTag = null;
                btn.classList.remove('active');
            } else {
                tagButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeTag = tag;
            }
            currentPage = 1;
            updateSectionTitle();
            renderPage(1, true);
            syncBrowserUrl();
        });
    });

    if (clearTagsBtn) {
        clearTagsBtn.addEventListener('click', function (e) {
            e.preventDefault();
            activeTag = null;
            tagButtons.forEach(b => b.classList.remove('active'));
            currentPage = 1;
            updateSectionTitle();
            renderPage(1, true);
            syncBrowserUrl();
        });
    }

    // Real-time search
    searchInput.addEventListener('input', function () {
        searchQuery = (searchInput.value || '').trim();
        currentPage = 1;
        updateSectionTitle();
        renderPage(1, false);
        syncBrowserUrl();
    });

    // Sort select
    sortSelect.addEventListener('change', function () {
        sortMode = sortSelect.value;
        currentPage = 1;
        renderPage(1, true);
        syncBrowserUrl();
    });

    // Browser back/forward navigation support
    window.addEventListener('popstate', function (e) {
        const state = e.state;
        const currentUrlParams = new URLSearchParams(window.location.search);
        currentPage = parseInt(currentUrlParams.get('page'), 10) || 1;
        activeCategorySlug = currentUrlParams.get('category') || 'all';
        activeTag = currentUrlParams.get('tag') || null;
        searchQuery = currentUrlParams.get('search') || '';
        sortMode = currentUrlParams.get('sort') || 'latest';

        // Update UI inputs
        searchInput.value = searchQuery;
        sortSelect.value = sortMode;
        categoryLinks.forEach(l => {
            const slug = l.getAttribute('data-category-slug');
            if (slug === activeCategorySlug) {
                l.classList.add('active');
            } else {
                l.classList.remove('active');
            }
        });
        tagButtons.forEach(b => {
            const tag = b.getAttribute('data-tag');
            if (activeTag && tag.toLowerCase() === activeTag.toLowerCase()) {
                b.classList.add('active');
            } else {
                b.classList.remove('active');
            }
        });

        updateSectionTitle();
        renderPage(currentPage, false);
    });

    // Newsletter forms
    document.querySelectorAll('.js-newsletter-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const input = form.querySelector('input[type="email"]');
            if (input && input.value) {
                showToast(`Thanks for subscribing with ${input.value}!`);
                input.value = '';
            }
        });
    });

    function escapeHtml(text) {
        if (!text) return '';
        const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }
});
</script>
