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
                                <a href="#research-projects" class="project-badge project-badge-link" data-research-id="<?php echo (int)$a['id']; ?>" data-research-title="<?php echo htmlspecialchars($a['title']); ?>" onclick="showProjectsForArea(event)">
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

        <!-- Research Projects Section -->
        <div id="research-projects" class="research-projects-section mt-5" style="display: none;">
            <div class="research-projects-header">
                <h2>Projects in <span id="selected-area-title">Research Area</span></h2>
                <button class="close-projects-btn" onclick="closeProjects()">×</button>
            </div>
            <div id="projects-container" class="row g-4 mt-4">
                <!-- Projects will be loaded here -->
            </div>
        </div>
    </div>
</section>

<script>
function showProjectsForArea(e) {
    e.preventDefault();
    
    const badge = e.target.closest('.project-badge-link');
    if (!badge) return;
    
    const researchId = badge.dataset.researchId;
    const researchTitle = badge.dataset.researchTitle;
    
    // Show loading state
    const container = document.getElementById('projects-container');
    container.innerHTML = '<div class="col-12 text-center"><p class="text-muted">Loading projects...</p></div>';
    
    document.getElementById('selected-area-title').textContent = researchTitle;
    document.getElementById('research-projects').style.display = 'block';
    
    // Scroll to projects section
    setTimeout(() => {
        document.getElementById('research-projects').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 100);
    
    // Fetch projects via AJAX
    fetch(`api/get_research_projects.php?research_id=${researchId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                container.innerHTML = data.html;
            } else {
                container.innerHTML = '<div class="col-12"><p class="text-center text-danger">Error: ' + (data.message || 'Failed to load projects') + '</p></div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            container.innerHTML = '<div class="col-12"><p class="text-center text-danger">Error loading projects. Please try again.</p></div>';
        });
}

function closeProjects() {
    document.getElementById('research-projects').style.display = 'none';
}
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>
