<?php
$pageTitle = 'News';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';
?>
<section class="py-5 news-page">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold">News & Events</h1>
                <p class="lead text-muted">Latest news, workshops, conferences, and research milestones from GDSG.</p>
            </div>
        </div>
        <div class="row g-4 mt-4 stagger">
            <?php
            // Load DB items first (if any), then always render original static cards afterwards.
            $news_items = get_news_items($pdo, 9);
            if (!empty($news_items)) {
                foreach ($news_items as $item) {
                    $date = format_news_date($item);
                    ?>
                    <div class="col-md-6 col-xl-4">
                        <article class="card card-soft image-card h-100 tilt-card">
                                <?php
                                // quick approach: use original image if available, otherwise placeholder
                                $imgSrc = 'assets/images/placeholder.svg';
                                if (!empty($item['featured_image'])) {
                                    $orig = $item['featured_image'];
                                    $origFull = __DIR__ . '/' . ltrim($orig, '/');
                                    if (is_file($origFull)) {
                                        $imgSrc = $orig;
                                    }
                                }
                                // normalize path for browser
                                if (strpos($imgSrc, '/') !== 0 && strpos($imgSrc, 'http') !== 0) $imgSrc = '/' . ltrim($imgSrc, '/');
                                ?>
                                    <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="image-card__media">
                            <div class="image-card__body">
                                <div class="image-card__meta">
                                    <span class="badge bg-secondary text-white"><?php echo htmlspecialchars($item['category'] ?: 'News'); ?></span>
                                    <span class="image-card__date">📅 <?php echo htmlspecialchars($date); ?></span>
                                </div>
                                <h3 class="h5"><?php echo htmlspecialchars($item['title']); ?></h3>
                                <p class="text-muted"><?php echo htmlspecialchars($item['summary']); ?></p>
                                <div class="image-card__footer">
                                    <a href="news_detail.php?id=<?php echo (int)$item['id']; ?>" class="text-primary">Read more</a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
