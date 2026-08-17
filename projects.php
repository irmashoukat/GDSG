<?php
$pageTitle = 'Projects';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/project_model.php';
require __DIR__ . '/includes/header.php';
?>
<section class="projects-page py-5">
    <div class="container">
        <div class="projects-intro row align-items-end gy-4">
            <div class="col-lg-8">
                <span class="section-kicker">Comprehensive research portfolio</span>
                <h1 class="display-6 fw-bold">Projects by GDSD</h1>
                <p class="lead text-muted mb-0">19 research projects spanning geospatial intelligence, environmental monitoring, agricultural systems, and public-service mapping across Pakistan and internationally.</p>
            </div>
            <div class="col-lg-4">
                <div class="projects-intro__note">Total <strong>19 projects</strong></div>
            </div>
        </div>
        <div class="row g-4 mt-5 stagger">
            <?php
            $projects = get_projects($pdo, 99);
            if (!empty($projects)) {
                foreach ($projects as $proj) {
                    $slugClass = preg_replace('/[^a-z0-9\-]/', '', strtolower($proj['slug'] ?? 'project'));
                    $metric = htmlspecialchars(ucfirst($proj['status'] ?? 'ongoing'));
                    $techs = array_filter(array_map('trim', explode(',', $proj['technologies'] ?? '')));
                    ?>
                    <div class="col-md-6 col-xl-4">
                        <article class="card project-card project-card--<?php echo $slugClass; ?> h-100 tilt-card">
                            <div class="project-card__body">
                                <span class="project-pill"><?php echo htmlspecialchars(ucfirst($proj['status'] ?? 'ongoing')); ?></span>
                                <h2><?php echo htmlspecialchars($proj['title']); ?></h2>
                                <p class="text-muted"><?php echo htmlspecialchars(mb_substr($proj['summary'] ?? $proj['objectives'] ?? '', 0, 200)); ?></p>
                                <?php if (!empty($techs)): ?>
                                    <h3 class="project-card__subhead">Core capabilities</h3>
                                    <div class="project-tech-list" role="group" aria-label="Project technologies">
                                        <?php foreach ($techs as $t): ?>
                                            <button type="button" class="project-tech-button" data-info="<?php echo htmlspecialchars(get_technology_description($t)); ?>"><?php echo htmlspecialchars($t); ?></button>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="mt-3">
                                    <a href="project_detail.php?id=<?php echo (int)$proj['id']; ?>" class="btn btn-dark btn-sm align-self-start mt-auto">View project</a>
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
<script>
document.querySelectorAll('.project-tech-list').forEach(function (techList) {
    var detail = techList.nextElementSibling;

    techList.querySelectorAll('.project-tech-button').forEach(function (button) {
        button.addEventListener('click', function () {
            var isActive = button.classList.contains('is-active');

            techList.querySelectorAll('.project-tech-button').forEach(function (item) {
                item.classList.remove('is-active');
                item.setAttribute('aria-pressed', 'false');
            });

            if (isActive) {
                detail.hidden = true;
                detail.textContent = '';
                return;
            }

            button.classList.add('is-active');
            button.setAttribute('aria-pressed', 'true');
            detail.textContent = button.dataset.info;
            detail.hidden = false;
        });

        button.setAttribute('aria-pressed', 'false');
    });
});
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>
