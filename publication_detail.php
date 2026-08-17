<?php
$pageTitle = 'Publication Detail';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = $id ? get_publication($pdo, $id) : null;
if (!$item) {
    http_response_code(404);
}
?>
<section class="publication-detail-section py-5">
    <div class="container">
        <?php if (!$item): ?>
            <div class="alert alert-warning">Publication not found.</div>
        <?php else: ?>
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <article class="publication-detail-article card-soft p-4">
                        <header class="mb-4">
                            <h1 class="display-6 fw-bold mb-3"><?php echo htmlspecialchars($item['title']); ?></h1>
                            <div class="text-muted mb-2">
                                <strong>Authors:</strong> <?php echo htmlspecialchars($item['authors']); ?>
                            </div>
                            <div class="text-muted mb-2">
                                <strong>Journal:</strong> <?php echo htmlspecialchars($item['journal']); ?> 
                                <?php if (!empty($item['volume'])): ?>
                                    Vol. <?php echo htmlspecialchars($item['volume']); ?>
                                <?php endif; ?>
                                <?php if (!empty($item['issue'])): ?>
                                    No. <?php echo htmlspecialchars($item['issue']); ?>
                                <?php endif; ?>
                                (<?php echo htmlspecialchars($item['year']); ?>)
                            </div>
                            <?php if (!empty($item['published_date'])): ?>
                                <div class="text-muted mb-2">
                                    <strong>Published:</strong> <?php echo date('F d, Y', strtotime($item['published_date'])); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($item['pages'])): ?>
                                <div class="text-muted mb-2">
                                    <strong>Pages:</strong> <?php echo htmlspecialchars($item['pages']); ?>
                                </div>
                            <?php endif; ?>
                        </header>

                        <!-- Abstract Section -->
                        <?php if (!empty($item['abstract'])): ?>
                            <div class="mb-4">
                                <h2 class="h4 fw-bold mb-2">Abstract</h2>
                                <div class="content-break text-justify">
                                    <?php echo nl2br(htmlspecialchars($item['abstract'])); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Keywords Section -->
                        <?php if (!empty($item['keywords'])): ?>
                            <div class="mb-4">
                                <h2 class="h5 fw-bold mb-2">Keywords</h2>
                                <div>
                                    <?php 
                                    $keywords = array_filter(array_map('trim', explode(',', $item['keywords'])));
                                    foreach ($keywords as $keyword): 
                                    ?>
                                        <span class="badge bg-info me-2 mb-2"><?php echo htmlspecialchars($keyword); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- DOI and Links -->
                        <div class="publication-links mb-4">
                            <h2 class="h5 fw-bold mb-2">Publication Links</h2>
                            <?php if (!empty($item['doi'])): ?>
                                <p class="mb-2">
                                    <strong>DOI:</strong> <a href="<?php echo htmlspecialchars($item['doi']); ?>" target="_blank" rel="noopener">
                                        <?php echo htmlspecialchars($item['doi']); ?>
                                    </a>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($item['journal_url'])): ?>
                                <p class="mb-2">
                                    <strong>Journal:</strong> <a href="<?php echo htmlspecialchars($item['journal_url']); ?>" target="_blank" rel="noopener">
                                        View on Journal Website
                                    </a>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($item['pdf_url'])): $pdf = $item['pdf_url']; if (strpos($pdf, '/') !== 0 && strpos($pdf, 'http') !== 0) $pdf = '/' . ltrim($pdf, '/'); ?>
                                <p>
                                    <a class="btn btn-primary btn-sm" href="<?php echo htmlspecialchars($pdf); ?>" target="_blank" rel="noopener">
                                        📥 Download Full PDF
                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>

                        <footer class="mt-4 pt-4 border-top text-muted">
                            <small>Added: <?php echo date('F d, Y', strtotime($item['created_at'])); ?></small>
                        </footer>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 publication-detail-sidebar">
                    <?php if (!empty($item['featured_image'])): ?>
                        <div class="card card-soft overflow-hidden mb-4">
                            <img src="<?php echo htmlspecialchars($item['featured_image']); ?>" alt="Journal cover" class="card-img-top" style="height: 350px; object-fit: cover;">
                        </div>
                    <?php endif; ?>

                    <!-- Publication Metadata Card -->
                    <div class="card card-soft p-4 mb-4">
                        <h3 class="h5 fw-bold mb-3">Publication Details</h3>
                        
                        <?php if (!empty($item['publication_frequency'])): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block"><strong>Publication Frequency</strong></small>
                                <span><?php echo htmlspecialchars($item['publication_frequency']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['peer_review_type'])): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block"><strong>Peer Review</strong></small>
                                <span><?php echo htmlspecialchars($item['peer_review_type']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['publication_fee'])): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block"><strong>Publication Fee</strong></small>
                                <span><?php echo htmlspecialchars($item['publication_fee']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['issn_e'])): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block"><strong>ISSN (E)</strong></small>
                                <span><?php echo htmlspecialchars($item['issn_e']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['issn_p'])): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block"><strong>ISSN (P)</strong></small>
                                <span><?php echo htmlspecialchars($item['issn_p']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['abbreviation'])): ?>
                            <div class="mb-0">
                                <small class="text-muted d-block"><strong>Abbreviation</strong></small>
                                <span><?php echo htmlspecialchars($item['abbreviation']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Share Card -->
                    <div class="card card-soft p-4">
                        <h3 class="h5 fw-bold mb-3">Citation</h3>
                        <p class="small text-muted">
                            <?php echo htmlspecialchars($item['authors']); ?> (<?php echo htmlspecialchars($item['year']); ?>). 
                            <?php echo htmlspecialchars($item['title']); ?>. 
                            <em><?php echo htmlspecialchars($item['journal']); ?></em>
                            <?php if (!empty($item['volume'])): ?>, <?php echo htmlspecialchars($item['volume']); ?><?php endif; ?>
                            <?php if (!empty($item['doi'])): ?>. <a href="<?php echo htmlspecialchars($item['doi']); ?>" target="_blank">
                                <?php echo htmlspecialchars($item['doi']); ?>
                            </a><?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
