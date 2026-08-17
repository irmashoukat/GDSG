<?php
$pageTitle = 'Research Detail';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = $id ? get_research_area($pdo, $id) : null;
if (!$item) {
    http_response_code(404);
}
?>
<section class="py-5">
    <div class="container">
        <?php if (!$item): ?>
            <div class="alert alert-warning">Research area not found.</div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <article class="card card-soft p-4">
                        <header class="mb-3">
                            <h1 class="display-6 fw-bold"><?php echo htmlspecialchars($item['title']); ?></h1>
                            <div class="text-muted mb-2">Added: <?php echo htmlspecialchars($item['created_at']); ?></div>
                        </header>
                        <div class="content-break">
                            <?php echo nl2br(htmlspecialchars($item['content'] ?? $item['summary'])); ?>
                        </div>
                    </article>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
