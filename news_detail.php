<?php
$pageTitle = 'News';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = $id ? get_news_item($pdo, $id) : null;
if (!$item) {
    http_response_code(404);
}
?>
<section class="py-5 news-detail-page">
    <div class="container">
        <?php if (!$item): ?>
            <div class="alert alert-warning">News item not found.</div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <article class="card card-soft p-4">
                        <header class="mb-3">
                            <h1 class="display-6 fw-bold"><?php echo htmlspecialchars($item['title']); ?></h1>
                            <div class="text-muted mb-2"><?php echo htmlspecialchars($item['category']); ?> — <?php echo htmlspecialchars($item['published_at'] ?: $item['created_at']); ?></div>
                        </header>
                        <?php if (!empty($item['featured_image'])): ?>
                            <?php $img = $item['featured_image']; if (strpos($img, '/') !== 0 && strpos($img, 'http') !== 0) $img = '/' . ltrim($img, '/'); ?>
                            <div class="mb-3 text-center"><img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="img-fluid news-detail-image" style="max-width:100%;height:auto;object-fit:contain;display:block;margin:0 auto;border-radius:6px;background:#f0f0f0;padding:1rem"></div>
                        <?php endif; ?>
                        <div class="content-break">
                            <?php echo nl2br(htmlspecialchars($item['content'])); ?>
                        </div>
                        <footer class="mt-4 text-muted">Published: <?php echo htmlspecialchars($item['published_at'] ?: $item['created_at']); ?></footer>
                    </article>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
