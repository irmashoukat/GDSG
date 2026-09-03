<?php
$pageTitle = 'Research';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';
?>
<section class="research-page py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold">Research Domains</h1>
                <p class="lead text-muted">Our research connects environmental intelligence, hierarchical geospatial infrastructure, and agricultural knowledge with GIS, data engineering, and AI.</p>
            </div>
        </div>
        <div class="row g-4 mt-4 stagger">
            <?php
            $areas = get_research_areas_with_projects($pdo, 12);
            if (!empty($areas)) {
                foreach ($areas as $a) {
                    ?>
                    <div class="col-lg-6">
                        <article class="card research-domain-card p-4 card-soft h-100 feature-card tilt-card">
                            <div class="research-domain-header">
                                <h3><?php echo htmlspecialchars($a['title']); ?></h3>
                                <a href="#research-projects" class="project-badge project-badge-link" data-research-id="<?php echo (int)$a['id']; ?>" data-research-title="<?php echo htmlspecialchars($a['title']); ?>" onclick="showProjectsForArea(event, this)">
                                    <?php echo (int)$a['project_count']; ?> <?php echo (int)$a['project_count'] === 1 ? 'Project' : 'Projects'; ?>
                                </a>
                            </div>
                            <p class="text-muted"><?php echo htmlspecialchars(mb_substr($a['summary'] ?? $a['content'], 0, 300)); ?></p>
                        </article>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <?php if (!empty($areas)): ?>
            <?php foreach ($areas as $a): ?>
                <?php $areaProjects = get_projects_by_research_area($pdo, (int)$a['id']); ?>
                <div id="research-projects-<?php echo (int)$a['id']; ?>" class="research-projects-section mt-5" style="display: none;">
                    <div class="research-projects-header">
                        <h2>Projects in <span><?php echo htmlspecialchars($a['title']); ?></span></h2>
                        <button type="button" class="close-projects-btn" onclick="closeProjects(<?php echo (int)$a['id']; ?>)">×</button>
                    </div>
                    <div class="row g-4 mt-4">
                        <?php if (!empty($areaProjects)): ?>
                            <?php foreach ($areaProjects as $proj): ?>
                                <?php
                                $techs = array_filter(array_map('trim', explode(',', $proj['technologies'] ?? '')));
                                $techPreview = !empty($techs) ? implode(', ', array_slice($techs, 0, 3)) : 'Multi-disciplinary';
                                ?>
                                <div class="col-lg-6 col-xl-4">
                                    <article class="research-card h-100">
                                        <div class="research-card-header">
                                            <span class="research-status"><?php echo htmlspecialchars(ucfirst($proj['status'] ?? 'ongoing')); ?></span>
                                            <h3 class="research-card-title"><?php echo htmlspecialchars($proj['title']); ?></h3>
                                        </div>
                                        <div class="research-card-body">
                                            <p class="research-summary"><?php echo htmlspecialchars(mb_substr($proj['summary'] ?? $proj['objectives'] ?? '', 0, 280)); ?></p>
                                            <div class="research-technologies">
                                                <small class="tech-label">Technologies:</small>
                                                <p class="tech-list"><?php echo htmlspecialchars($techPreview); ?></p>
                                            </div>
                                        </div>
                                        <a href="project_detail.php?id=<?php echo (int)$proj['id']; ?>" class="research-view-btn">View Project</a>
                                    </article>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12"><p class="text-center text-muted">No projects found for this research area.</p></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<script>
function showProjectsForArea(e, badge) {
    e.preventDefault();
    badge = badge || e.target.closest('.project-badge-link');
    if (!badge) return false;
    
    const researchId = badge.dataset.researchId;
    const projectsSection = document.getElementById('research-projects-' + researchId);
    if (!projectsSection) return false;

    document.querySelectorAll('.research-projects-section').forEach(function (section) {
        section.style.display = section === projectsSection ? 'block' : 'none';
    });
    projectsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });

    return false;
}

function closeProjects(researchId) {
    const projectsSection = document.getElementById('research-projects-' + researchId);
    if (projectsSection) projectsSection.style.display = 'none';
}
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>
