<?php
$pageTitle = 'Publications';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

$q = trim($_GET['q'] ?? '');
$year = trim($_GET['year'] ?? '');

// fetch available years for the filter dropdown
$availableYears = [];
if ($pdo) {
    try {
        $yrs = $pdo->query('SELECT DISTINCT year FROM publications WHERE year IS NOT NULL ORDER BY year DESC')->fetchAll(PDO::FETCH_COLUMN);
        if ($yrs) $availableYears = $yrs;
    } catch (Exception $e) { /* ignore */ }
}
?>
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<section class="publications-section py-5">
    <div class="container">
        <div class="publications-header row align-items-center gy-4">
            <div class="col-lg-8">
                <div class="publications-header-content">
                    <h1 class="publications-title display-5 fw-bold">Research Publications</h1>
                    <p class="publications-subtitle lead">Explore recent peer-reviewed research, conference papers, and technical reports from GDSG.</p>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-primary publications-browse-btn" onclick="openPublicationsListModal()">📚 Browse Publications</button>
            </div>
        </div>
        <div id="publication-list" class="row g-4 mt-5 stagger justify-content-center publication-cards-container">
            <?php
            // Render DB-driven publications first (if any), then fall back to static seeded cards.
            $pubs = get_publications_filtered($pdo, 12, $q ?: null, $year ?: null);
            if (!empty($pubs)) {
                foreach ($pubs as $p) {
                    ?>
                <div class="col-md-6 col-xl-4">
                        <article class="card publication-card card-soft image-card h-100 tilt-card" style="cursor: pointer;" onclick="openPublicationModal(<?php echo htmlspecialchars(json_encode($p)); ?>)">
                            <div class="publication-card-img-wrapper">
                                <?php if (!empty($p['featured_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($p['featured_image']); ?>" alt="Journal cover for <?php echo htmlspecialchars($p['title']); ?>" class="image-card__media publication-card__media">
                                <?php endif; ?>
                            </div>
                            <div class="image-card__body d-flex flex-column publication-card-body">
                                <span class="publication-journal text-muted small"><?php echo htmlspecialchars($p['journal'] ?: 'Publication'); ?></span>
                                <h3 class="publication-title h5 mt-2"><?php echo htmlspecialchars($p['title']); ?></h3>
                                <p class="publication-meta text-muted small"><?php echo htmlspecialchars($p['authors']); ?> — <span class="publication-year"><?php echo htmlspecialchars($p['year']); ?></span></p>
                                <?php if (!empty($p['summary'])): ?>
                                    <p class="publication-summary text-muted small"><?php echo htmlspecialchars(mb_substr($p['summary'],0,120)) . '...'; ?></p>
                                <?php endif; ?>
                                <a href="publication_detail.php?id=<?php echo (int)$p['id']; ?>" class="btn btn-outline-secondary btn-sm publication-view-btn align-self-start mt-auto">View publication</a>
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

<!-- Publication Modal -->
<div id="publicationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="publicationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="publicationModalLabel">Publication Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Content will be filled by JavaScript -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a id="modalViewBtn" href="#" class="btn btn-primary">View Full Publication</a>
      </div>
    </div>
  </div>
</div>

<script>
function openPublicationModal(publication) {
    const modal = new bootstrap.Modal(document.getElementById('publicationModal'));
    
    let html = `
        <div class="publication-modal-content">
    `;
    
    if (publication.featured_image) {
        html += `<img src="${publication.featured_image}" alt="Journal cover" class="img-fluid mb-3" style="max-height: 300px;">`;
    }
    
    html += `
        <h3>${publication.title}</h3>
        <p class="text-muted mb-3">
            <strong>${publication.journal || 'Publication'}</strong> • ${publication.year}
        </p>
        <p><strong>Authors:</strong> ${publication.authors}</p>
    `;
    
    if (publication.summary) {
        html += `<p><strong>Summary:</strong><br>${publication.summary}</p>`;
    }
    
    if (publication.doi) {
        html += `<p><strong>DOI:</strong> <a href="${publication.doi}" target="_blank">${publication.doi}</a></p>`;
    }
    
    if (publication.keywords) {
        html += `<p><strong>Keywords:</strong> ${publication.keywords}</p>`;
    }
    
    html += `</div>`;
    
    document.getElementById('modalBody').innerHTML = html;
    document.getElementById('modalViewBtn').href = `publication_detail.php?id=${publication.id}`;
    
    modal.show();
}

function openPublicationsListModal() {
    const listModal = new bootstrap.Modal(document.getElementById('publicationsListModal'));
    listModal.show();
}
</script>

<!-- Publications List Modal -->
<div id="publicationsListModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="publicationsListLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="publicationsListLabel">📚 Research Publications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="list-group">
          <?php 
          $all_pubs = get_publications_filtered($pdo, 50);
          foreach ($all_pubs as $pub): 
          ?>
          <a href="javascript:void(0)" class="list-group-item list-group-item-action" onclick="openPublicationModal(<?php echo htmlspecialchars(json_encode($pub)); ?>); document.getElementById('publicationsListModal').closest('.modal').hide?.() || bootstrap.Modal.getInstance(document.getElementById('publicationsListModal')).hide();">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1"><?php echo htmlspecialchars($pub['title']); ?></h6>
              <small><?php echo htmlspecialchars($pub['year']); ?></small>
            </div>
            <p class="mb-1 text-muted small"><?php echo htmlspecialchars($pub['journal'] ?: 'Publication'); ?></p>
            <small><?php echo htmlspecialchars($pub['authors']); ?></small>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
