<?php
$pageTitle = 'News & Events';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

// Fetch all news items from DB
$news_items = get_news_items($pdo, 20);

// Default featured items matching mockup
$featured_news = [
    [
        'id' => 1,
        'title' => 'New GeoAI collaboration announced',
        'category' => 'News',
        'date' => '2024-01-15',
        'summary' => 'GDSG partners with academic institutions to accelerate climate analytics research.',
        'image' => '/assets/images/World_environment_day_GDSG_Post.jpg',
        'type' => 'news',
        'badge_class' => 'badge-green',
        'bar_class' => 'bar-green',
        'btn_class' => 'btn-green'
    ],
    [
        'id' => 2,
        'title' => 'Workshop on Earth Observation analytics',
        'category' => 'Event',
        'date' => '2024-01-10',
        'summary' => 'A hands-on workshop covering remote sensing, data fusion, and spatial modeling.',
        'image' => '/assets/images/Earth_day_Founder_Maria_Seminar.jpg',
        'type' => 'event',
        'badge_class' => 'badge-red',
        'bar_class' => 'bar-red',
        'btn_class' => 'btn-red'
    ]
];

// If DB has custom entries for ID 1 and 2, merge them
if (!empty($news_items)) {
    foreach ($news_items as $item) {
        if ($item['id'] == 1) {
            $featured_news[0]['title'] = $item['title'] ?: $featured_news[0]['title'];
            $featured_news[0]['summary'] = $item['summary'] ?: $featured_news[0]['summary'];
            if (!empty($item['published_at'])) {
                $featured_news[0]['date'] = date('Y-m-d', strtotime($item['published_at']));
            }
        } elseif ($item['id'] == 2) {
            $featured_news[1]['title'] = $item['title'] ?: $featured_news[1]['title'];
            $featured_news[1]['summary'] = $item['summary'] ?: $featured_news[1]['summary'];
            if (!empty($item['published_at'])) {
                $featured_news[1]['date'] = date('Y-m-d', strtotime($item['published_at']));
            }
        }
    }
}
?>

<style>
/* ========================================================
   GDSG NEWS & EVENTS PAGE STYLING (EXACT DESIGN MATCH)
   ======================================================== */

.news-page-wrapper {
    background-color: #f8fafc;
    color: #1e293b;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    padding-bottom: 90px;
    min-height: 80vh;
}

/* ---------------- 1. HERO SECTION ---------------- */
.news-hero-section {
    position: relative;
    background-color: #02173c;
    background-image: url('/assets/images/news/news_hero_clean.jpg');
    background-size: cover;
    background-position: center right;
    background-repeat: no-repeat;
    padding: 75px 0 70px;
    color: #ffffff;
    overflow: hidden;
}

.news-hero-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
}

/* 4x4 decorative dot grid on top left */
.hero-dot-grid {
    position: absolute;
    top: -45px;
    left: -10px;
    width: 68px;
    height: 68px;
    background-image: radial-gradient(#38bdf8 1.8px, transparent 1.8px);
    background-size: 17px 17px;
    opacity: 0.55;
    pointer-events: none;
}

/* Badge & Horizontal Accent Line */
.news-hero-badge-wrap {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}

.news-hero-badge {
    color: #38bdf8;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.news-hero-badge-line {
    display: inline-block;
    width: 28px;
    height: 2px;
    background: #10b981;
    border-radius: 2px;
}

/* Main Heading */
.news-hero-title {
    font-size: clamp(2.4rem, 4.5vw, 3.4rem);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.15;
    letter-spacing: -0.02em;
    margin: 0 0 16px;
}

.text-brand-green {
    color: #10b981;
    display: block;
}

/* Subtitle */
.news-hero-desc {
    color: #cbd5e1;
    font-size: 1.05rem;
    line-height: 1.6;
    max-width: 540px;
    margin: 0;
}

/* ---------------- 2. MAIN SECTION ---------------- */
.news-main-section {
    max-width: 1240px;
    margin: 45px auto 0;
    padding: 0 24px;
}

/* Section Header Bar */
.news-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    gap: 20px;
}

.section-title-wrap {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-shrink: 0;
}

.section-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #d1fae5;
    color: #059669;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(5, 150, 105, 0.12);
}

.section-icon-circle .material-symbols-outlined {
    font-size: 24px;
}

.section-main-title {
    font-size: 1.55rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
    letter-spacing: -0.02em;
}

.section-header-divider {
    flex: 1;
    height: 1px;
    background: #e2e8f0;
    margin: 0 10px;
}

.view-all-link {
    color: #2563eb;
    font-weight: 600;
    font-size: 0.92rem;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    transition: transform 0.2s ease, color 0.2s ease;
    flex-shrink: 0;
}

.view-all-link:hover {
    color: #1d4ed8;
    transform: translateX(3px);
}

.view-all-link .material-symbols-outlined {
    font-size: 18px;
}

/* ---------------- 3. CARDS GRID ---------------- */
.news-cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 340px;
    gap: 24px;
    align-items: stretch;
}

@media (max-width: 1200px) {
    .news-cards-grid {
        grid-template-columns: 1fr 1fr;
    }
    .news-newsletter-card {
        grid-column: span 2;
    }
}

@media (max-width: 768px) {
    .news-cards-grid {
        grid-template-columns: 1fr;
    }
    .news-newsletter-card {
        grid-column: span 1;
    }
}

/* Horizontal Split News Card */
.news-card-horizontal {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #eef2f6;
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
    overflow: hidden;
    display: flex;
    flex-direction: row;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    cursor: pointer;
}

.news-card-horizontal:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 36px -4px rgba(15, 23, 42, 0.1);
    border-color: #cbd5e1;
}

/* Poster column */
.news-card-poster {
    width: 195px;
    flex-shrink: 0;
    padding: 14px;
    background: #ffffff;
    display: flex;
    align-items: center;
}

.news-card-poster a {
    display: block;
    width: 100%;
    height: 100%;
}

.news-card-poster img {
    width: 100%;
    height: 100%;
    max-height: 255px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    display: block;
    transition: transform 0.4s ease;
}

.news-card-horizontal:hover .news-card-poster img {
    transform: scale(1.03);
}

@media (max-width: 540px) {
    .news-card-horizontal {
        flex-direction: column;
    }
    .news-card-poster {
        width: 100%;
        padding: 16px 16px 0;
    }
    .news-card-poster img {
        max-height: 220px;
    }
}

/* Content column */
.news-card-content {
    padding: 22px 22px 22px 8px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex: 1;
    min-width: 0;
}

@media (max-width: 540px) {
    .news-card-content {
        padding: 16px 20px 22px;
    }
}

/* Meta: Badge and Date */
.news-card-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 12px;
    flex-wrap: wrap;
}

.news-badge {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.02em;
    padding: 3px 12px;
    border-radius: 9999px;
    display: inline-block;
    color: #ffffff;
}

.badge-green {
    background: #059669;
}

.badge-red {
    background: #dc2626;
}

.news-card-date {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.78rem;
    color: #64748b;
    font-weight: 500;
}

.news-card-date .material-symbols-outlined {
    font-size: 15px;
    color: #94a3b8;
}

/* Title */
.news-card-title {
    font-size: 1.16rem;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.35;
    margin: 0 0 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
}

.news-card-title a:hover {
    color: #059669;
}

/* Small Accent Bar */
.news-card-accent-bar {
    width: 32px;
    height: 3px;
    border-radius: 2px;
    margin: 8px 0 12px;
}

.bar-green {
    background: #059669;
}

.bar-red {
    background: #dc2626;
}

/* Summary */
.news-card-summary {
    font-size: 0.85rem;
    color: #64748b;
    line-height: 1.5;
    margin: 0 0 18px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Read more Buttons */
.news-btn {
    border: none;
    padding: 8px 18px;
    border-radius: 8px;
    font-size: 0.84rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    width: fit-content;
    transition: all 0.2s ease;
    color: #ffffff;
    cursor: pointer;
}

.btn-green {
    background: #059669;
}

.btn-green:hover {
    background: #047857;
    color: #ffffff;
    transform: translateX(3px);
}

.btn-red {
    background: #dc2626;
}

.btn-red:hover {
    background: #b91c1c;
    color: #ffffff;
    transform: translateX(3px);
}

.news-btn .material-symbols-outlined {
    font-size: 16px;
}

/* ---------------- 4. NEWSLETTER CARD ---------------- */
.news-newsletter-card {
    background: #eafaf1;
    border-radius: 24px;
    padding: 32px 26px;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 20px -2px rgba(16, 185, 129, 0.08);
    border: 1px solid #d1fae5;
}

/* Top-right subtle dot pattern */
.newsletter-dot-pattern {
    position: absolute;
    top: 18px;
    right: 18px;
    width: 65px;
    height: 65px;
    background-image: radial-gradient(#6ee7b7 1.6px, transparent 1.6px);
    background-size: 13px 13px;
    opacity: 0.7;
    pointer-events: none;
}

.newsletter-icon-circle {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: #ffffff;
    color: #059669;
    box-shadow: 0 4px 14px rgba(5, 150, 105, 0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.newsletter-icon-circle .material-symbols-outlined {
    font-size: 26px;
}

.newsletter-card-heading {
    font-size: 1.38rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px;
    letter-spacing: -0.01em;
}

.newsletter-card-desc {
    font-size: 0.86rem;
    color: #475569;
    line-height: 1.5;
    margin: 0 0 24px;
}

.newsletter-card-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.newsletter-card-input {
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    padding: 11px 16px;
    font-size: 0.88rem;
    color: #1e293b;
    outline: none;
    width: 100%;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.newsletter-card-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

.newsletter-card-btn {
    background: linear-gradient(135deg, #1d4ed8, #2563eb, #3b82f6);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    padding: 12px 20px;
    font-size: 0.9rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
    transition: all 0.2s ease;
}

.newsletter-card-btn:hover {
    background: linear-gradient(135deg, #1e40af, #1d4ed8, #2563eb);
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(37, 99, 235, 0.35);
}

.newsletter-card-btn .material-symbols-outlined {
    font-size: 17px;
}

/* ---------------- 5. EXPANDED ALL NEWS SECTION ---------------- */
.news-all-archive {
    margin-top: 50px;
    display: none;
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.archive-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 20px;
}

/* Toast */
.news-toast {
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

.news-toast.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}
</style>

<div class="news-page-wrapper">
    <!-- 1. HERO SECTION (EXACT MATCH TO MOCKUP) -->
    <section class="news-hero-section">
        <div class="news-hero-container">
            <div class="hero-dot-grid" aria-hidden="true"></div>
            
            <div class="news-hero-badge-wrap">
                <span class="news-hero-badge">NEWS &amp; EVENTS</span>
                <span class="news-hero-badge-line"></span>
            </div>

            <h1 class="news-hero-title">
                Stay Updated with
                <span class="text-brand-green">GDSG</span>
            </h1>

            <p class="news-hero-desc">
                Latest news, workshops, conferences, and research milestones from GDSG.
            </p>
        </div>
    </section>

    <!-- 2. MAIN SECTION (EXACT 3-CARD LAYOUT) -->
    <section class="news-main-section">
        <!-- Section Header -->
        <div class="news-section-header">
            <div class="section-title-wrap">
                <div class="section-icon-circle">
                    <span class="material-symbols-outlined">feed</span>
                </div>
                <h2 class="section-main-title">Latest Updates</h2>
            </div>
            <div class="section-header-divider"></div>
            <a href="#all-news" class="view-all-link" id="viewAllNewsBtn" onclick="toggleAllNews(event)">
                <span id="viewAllText">View all news</span>
                <span class="material-symbols-outlined" id="viewAllIcon">arrow_forward</span>
            </a>
        </div>

        <!-- 3-Card Grid -->
        <div class="news-cards-grid">
            <?php foreach ($featured_news as $item): ?>
                <article class="news-card-horizontal" onclick="location.href='news_detail.php?id=<?php echo (int)$item['id']; ?>'">
                    <!-- Left Poster -->
                    <div class="news-card-poster">
                        <a href="news_detail.php?id=<?php echo (int)$item['id']; ?>" tabindex="-1">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" loading="lazy">
                        </a>
                    </div>
                    <!-- Right Content -->
                    <div class="news-card-content">
                        <div>
                            <div class="news-card-meta">
                                <span class="news-badge <?php echo htmlspecialchars($item['badge_class']); ?>">
                                    <?php echo htmlspecialchars($item['category']); ?>
                                </span>
                                <span class="news-card-date">
                                    <span class="material-symbols-outlined">calendar_today</span>
                                    <span><?php echo htmlspecialchars($item['date']); ?></span>
                                </span>
                            </div>
                            <h3 class="news-card-title">
                                <a href="news_detail.php?id=<?php echo (int)$item['id']; ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                            </h3>
                            <div class="news-card-accent-bar <?php echo htmlspecialchars($item['bar_class']); ?>"></div>
                            <p class="news-card-summary">
                                <?php echo htmlspecialchars($item['summary']); ?>
                            </p>
                        </div>
                        <div class="news-card-action">
                            <a href="news_detail.php?id=<?php echo (int)$item['id']; ?>" class="news-btn <?php echo htmlspecialchars($item['btn_class']); ?>" onclick="event.stopPropagation();">
                                <span>Read more</span>
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

            <!-- Card 3: Never Miss an Update Newsletter Card -->
            <div class="news-newsletter-card">
                <div class="newsletter-dot-pattern" aria-hidden="true"></div>
                <div>
                    <div class="newsletter-icon-circle">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <h3 class="newsletter-card-heading">Never Miss an Update</h3>
                    <p class="newsletter-card-desc">
                        Subscribe to our newsletter and get the latest news, events, and opportunities from GDSG.
                    </p>
                </div>
                <form class="newsletter-card-form" onsubmit="event.preventDefault(); showNewsToast();">
                    <input type="email" 
                           class="newsletter-card-input" 
                           placeholder="Enter your email" 
                           required 
                           id="newsSubscribeEmail">
                    <button type="submit" class="newsletter-card-btn">
                        <span>Subscribe</span>
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Optional Expanded Archive Grid (Shown when user clicks 'View all news') -->
        <div class="news-all-archive" id="newsArchiveWrap">
            <h3 class="archive-title">All News &amp; Past Updates</h3>
            <div class="row g-4">
                <?php if (!empty($news_items)): ?>
                    <?php foreach ($news_items as $item): ?>
                        <?php 
                            $date = format_news_date($item);
                            $imgSrc = !empty($item['featured_image']) ? $item['featured_image'] : '/assets/images/placeholder.svg';
                            if (strpos($imgSrc, '/') !== 0 && strpos($imgSrc, 'http') !== 0) $imgSrc = '/' . ltrim($imgSrc, '/');
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden" onclick="location.href='news_detail.php?id=<?php echo (int)$item['id']; ?>'" style="cursor: pointer;">
                                <div style="height: 180px; overflow: hidden; background: #0f172a;">
                                    <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-success-subtle text-success"><?php echo htmlspecialchars($item['category'] ?: 'News'); ?></span>
                                            <small class="text-muted"><?php echo htmlspecialchars($date); ?></small>
                                        </div>
                                        <h5 class="fw-bold mb-2 text-dark"><?php echo htmlspecialchars($item['title']); ?></h5>
                                        <p class="text-muted small mb-3"><?php echo htmlspecialchars($item['summary']); ?></p>
                                    </div>
                                    <a href="news_detail.php?id=<?php echo (int)$item['id']; ?>" class="text-success fw-bold text-decoration-none d-inline-flex align-items-center gap-1 small">
                                        <span>Read article</span>
                                        <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<!-- Toast Notification -->
<div id="newsToast" class="news-toast">
    <span class="material-symbols-outlined" style="color: #10b981;">check_circle</span>
    <span id="newsToastMsg">Thank you for subscribing to GDSG updates!</span>
</div>

<script>
function showNewsToast() {
    const input = document.getElementById('newsSubscribeEmail');
    const toast = document.getElementById('newsToast');
    const toastMsg = document.getElementById('newsToastMsg');
    
    if (input && input.value) {
        toastMsg.textContent = `Thanks for subscribing with ${input.value}!`;
        input.value = '';
    }
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3500);
}

function toggleAllNews(e) {
    e.preventDefault();
    const archive = document.getElementById('newsArchiveWrap');
    const text = document.getElementById('viewAllText');
    const icon = document.getElementById('viewAllIcon');
    
    if (archive.style.display === 'block') {
        archive.style.display = 'none';
        text.textContent = 'View all news';
        icon.textContent = 'arrow_forward';
    } else {
        archive.style.display = 'block';
        text.textContent = 'Hide archive';
        icon.textContent = 'expand_less';
        archive.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
