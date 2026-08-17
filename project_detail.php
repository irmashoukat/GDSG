<?php
$pageTitle = 'Project Detail';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/project_model.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$project = $id ? get_project($pdo, $id) : null;
if (!$project) {
    http_response_code(404);
    echo '<div class="container py-5"><h1>Project not found</h1><p class="text-muted">The requested project does not exist.</p></div>';
    include __DIR__ . '/includes/footer.php';
    exit;
}

$images = get_project_images($project['id']);
$team = get_project_team($project['id']);
$research_area = $project['research_area_id'] ? get_project_research_area($project['research_area_id']) : null;
$techs = array_filter(array_map('trim', explode(',', $project['technologies'] ?? '')));
$highlights = array_filter(array_map('trim', explode(';', $project['key_highlights'] ?? '')));
$deliverables = array_filter(array_map('trim', explode(';', $project['deliverables'] ?? '')));
?>

<!-- Hero Section -->
<section class="project-hero py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="mb-3">
                    <?php echo get_status_badge($project['status']); ?>
                    <?php if ($research_area): ?>
                        <a href="research.php?area=<?php echo $research_area['id']; ?>" class="badge bg-secondary ms-2">
                            <?php echo htmlspecialchars($research_area['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <h1 class="display-5 fw-bold mb-3" style="color: #dc2626;"><?php echo htmlspecialchars($project['title']); ?></h1>
                <p class="lead text-muted"><?php echo htmlspecialchars($project['summary'] ?? ''); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Image -->
<?php if (!empty($project['featured_image'])): ?>
<section class="project-featured-image py-4" style="overflow: hidden;">
    <div class="container">
        <img src="<?php echo asset_url($project['featured_image']); ?>" class="img-fluid rounded-3" style="max-height: 400px; width: 100%; object-fit: cover;" alt="<?php echo htmlspecialchars($project['title']); ?>">
    </div>
</section>
<?php endif; ?>

<!-- Main Content -->
<section class="project-detail py-5" style="background-image: url('assets/images/geo-satellite-clean.jpg'); background-size: cover; background-attachment: fixed; background-position: center; position: relative;">
    <!-- Background Overlay -->
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.55) 0%, rgba(235,240,248,0.50) 100%); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row g-4">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                
                <!-- Quick Overview -->
                <section class="mb-5 p-4 rounded-3" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.25) 0%, rgba(96, 165, 250, 0.20) 100%); border: 2px solid rgba(59, 130, 246, 0.4); box-shadow: 0 8px 24px rgba(59, 130, 246, 0.15);">
                    <h2 class="h3 fw-bold mb-3" style="color: #1e40af;">📋 Project Overview</h2>
                    <div class="overview-content text-dark lh-lg" style="font-weight: 500;">
                        <p><?php echo nl2br(htmlspecialchars($project['summary'] ?? '')); ?></p>
                    </div>
                </section>

                <!-- Objectives Section -->
                <?php if (!empty($project['objectives'])): ?>
                <section class="mb-5 p-4 rounded-3" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.12) 0%, rgba(147, 197, 253, 0.08) 100%);">
                    <h2 class="h3 fw-bold mb-4" style="color: #1e40af;">🎯 Project Objectives</h2>
                    <div class="objectives-list">
                        <?php
                        $objectives = array_filter(array_map('trim', explode(';', $project['objectives'])));
                        if (!empty($objectives)): ?>
                            <ul class="list-unstyled">
                                <?php foreach ($objectives as $obj): ?>
                                    <li class="mb-2 d-flex" style="align-items: flex-start;">
                                        <span style="color: #3b82f6; font-weight: bold; margin-right: 12px; margin-top: 2px;">•</span>
                                        <span style="color: #1e3a8a; font-weight: 500;"><?php echo htmlspecialchars($obj); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p><?php echo nl2br(htmlspecialchars($project['objectives'])); ?></p>
                        <?php endif; ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Approach/Methodology Section -->
                <?php if (!empty($project['approach'])): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">🔬 Approach & Methodology</h2>
                    <div class="approach-content text-muted lh-lg" style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.12) 0%, rgba(134, 239, 172, 0.10) 100%) !important; border-left-color: #22c55e !important;">
                        <p><?php echo nl2br(htmlspecialchars($project['approach'])); ?></p>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Key Highlights Section -->
                <?php if (!empty($highlights)): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">⭐ Key Highlights</h2>
                    <div class="highlights-list">
                        <div class="row g-3">
                            <?php foreach ($highlights as $highlight): ?>
                                <div class="col-md-6">
                                    <div class="highlight-card p-3 rounded-3" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(51, 102, 224, 0.08) 100%); border-left: 4px solid #3b82f6;">
                                        <p class="mb-0">⚡ <?php echo htmlspecialchars($highlight); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Outcomes/Results Section -->
                <?php if (!empty($project['outcomes'])): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">📊 Outcomes & Results</h2>
                    <div class="outcomes-content text-muted lh-lg p-4 rounded-3" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.12) 0%, rgba(96, 165, 250, 0.10) 100%); border-left: 4px solid #3b82f6;">
                        <p><?php echo nl2br(htmlspecialchars($project['outcomes'])); ?></p>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Impact Section -->
                <?php if (!empty($project['impact'])): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">🌍 Impact & Significance</h2>
                    <div class="impact-box p-4 rounded-3" style="background: linear-gradient(135deg, rgba(212, 47, 47, 0.08) 0%, rgba(245, 127, 127, 0.08) 100%); border-left: 4px solid #d52f2f;">
                        <div class="text-muted lh-lg">
                            <p><?php echo nl2br(htmlspecialchars($project['impact'])); ?></p>
                        </div>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Deliverables Section -->
                <?php if (!empty($deliverables)): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">📦 Key Deliverables</h2>
                    <div class="deliverables-list">
                        <ul class="list-unstyled">
                            <?php foreach ($deliverables as $i => $deliverable): ?>
                                <li class="mb-3 d-flex p-3 rounded-2" style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.10) 0%, rgba(16, 185, 129, 0.08) 100%);">
                                    <span class="me-3" style="color: #22c55e; font-weight: bold; font-size: 1.2rem;">✓</span>
                                    <span><?php echo htmlspecialchars($deliverable); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Technologies Section -->
                <?php if (!empty($techs)): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">🛠️ Core Technologies & Capabilities</h2>
                    <div class="tech-tags">
                        <?php foreach ($techs as $i => $tech): ?>
                            <span class="badge text-dark border border-2 me-2 mb-2 p-3" style="background: linear-gradient(135deg, <?php echo ($i % 2 == 0) ? 'rgba(59, 130, 246, 0.15) 0%, rgba(147, 197, 253, 0.12) 100%' : 'rgba(34, 197, 94, 0.15) 0%, rgba(134, 239, 172, 0.12) 100%'; ?>); border-color: <?php echo ($i % 2 == 0) ? '#3b82f6' : '#22c55e'; ?> !important;">
                                <strong><?php echo htmlspecialchars($tech); ?></strong>
                                <br><small class="d-block text-muted mt-2">
                                    <?php echo htmlspecialchars(get_technology_description($tech) ?? ''); ?>
                                </small>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Gallery Section -->
                <?php if (!empty($images)): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">🖼️ Project Gallery</h2>
                    <div class="row g-3">
                        <?php foreach ($images as $img): ?>
                            <div class="col-sm-6 col-md-4">
                                <figure class="text-center">
                                    <a href="<?php echo asset_url($img['image_url']); ?>" target="_blank" class="d-block mb-2">
                                        <img src="<?php echo asset_url($img['image_url']); ?>" class="img-fluid rounded" style="max-height: 250px; object-fit: cover; width: 100%;" alt="<?php echo htmlspecialchars($img['caption'] ?? ''); ?>">
                                    </a>
                                    <?php if (!empty($img['caption'])): ?>
                                        <figcaption class="small text-muted"><?php echo htmlspecialchars($img['caption']); ?></figcaption>
                                    <?php endif; ?>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Additional Content Section -->
                <?php if (!empty($project['content'])): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">📖 Project Details</h2>
                    <div class="project-content text-muted lh-lg">
                        <?php echo $project['content']; ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Team Section -->
                <?php if (!empty($team)): ?>
                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-3">👥 Project Team</h2>
                    <div class="row g-4">
                        <?php foreach ($team as $member): ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="card h-100 text-center team-card">
                                    <?php if (!empty($member['photo_url'])): ?>
                                        <img src="<?php echo asset_url($member['photo_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($member['name']); ?>">
                                    <?php else: ?>
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px; color: #999;">
                                            <span>No Photo</span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($member['name']); ?></h5>
                                        <?php if (!empty($member['position'])): ?>
                                            <p class="card-text small text-primary fw-bold"><?php echo htmlspecialchars($member['position']); ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($member['role'])): ?>
                                            <span class="badge bg-secondary mb-2"><?php echo htmlspecialchars($member['role']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($member['expertise'])): ?>
                                            <p class="card-text small text-muted"><?php echo htmlspecialchars(mb_substr($member['expertise'], 0, 100)); ?></p>
                                        <?php endif; ?>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <?php if (!empty($member['email'])): ?>
                                                <a href="mailto:<?php echo htmlspecialchars($member['email']); ?>" class="btn btn-sm btn-outline-primary" title="Email">✉️</a>
                                            <?php endif; ?>
                                            <?php if (!empty($member['linkedin'])): ?>
                                                <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" class="btn btn-sm btn-outline-info" title="LinkedIn">🔗</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h3 class="card-title mb-3">📌 Project Information</h3>
                        
                        <!-- Status -->
                        <div class="mb-3">
                            <p class="small mb-1" style="color: #dc2626; font-weight: 600;">Status</p>
                            <p class="mb-0"><?php echo get_status_badge($project['status']); ?></p>
                        </div>

                        <!-- Research Area -->
                        <?php if ($research_area): ?>
                        <div class="mb-3">
                            <p class="small mb-1" style="color: #dc2626; font-weight: 600;">Research Area</p>
                            <p class="mb-0">
                                <a href="research.php?area=<?php echo $research_area['id']; ?>" class="text-decoration-none">
                                    <?php echo htmlspecialchars($research_area['title']); ?>
                                </a>
                            </p>
                        </div>
                        <?php endif; ?>

                        <!-- Timeline -->
                        <?php if (!empty($project['timeline'])): ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Timeline</p>
                            <p class="mb-0"><?php echo htmlspecialchars($project['timeline']); ?></p>
                        </div>
                        <?php endif; ?>

                        <!-- Project Duration -->
                        <div class="mb-3">
                            <p class="small mb-1" style="color: #dc2626; font-weight: 600;">Project Started</p>
                            <p class="mb-0"><?php echo date('M d, Y', strtotime($project['created_at'] ?? 'now')); ?></p>
                        </div>

                        <?php if ($project['updated_at'] !== $project['created_at']): ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Last Updated</p>
                            <p class="mb-0"><?php echo date('M d, Y', strtotime($project['updated_at'] ?? 'now')); ?></p>
                        </div>
                        <?php endif; ?>

                        <!-- Funding Info -->
                        <?php if (!empty($project['funding_info'])): ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Funding</p>
                            <p class="mb-0"><?php echo htmlspecialchars($project['funding_info']); ?></p>
                        </div>
                        <?php endif; ?>

                        <!-- Technologies Count -->
                        <?php if (!empty($techs)): ?>
                        <div class="mb-3">
                            <p class="small mb-1" style="color: #dc2626; font-weight: 600;">Technologies Used</p>
                            <p class="mb-0"><strong><?php echo count($techs); ?></strong> core capabilities</p>
                        </div>
                        <?php endif; ?>

                        <!-- Team Size -->
                        <?php if (!empty($team)): ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Team Members</p>
                            <p class="mb-0"><strong><?php echo count($team); ?></strong> people involved</p>
                        </div>
                        <?php endif; ?>

                        <!-- Image Gallery Count -->
                        <?php if (!empty($images)): ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Media Assets</p>
                            <p class="mb-0"><strong><?php echo count($images); ?></strong> images</p>
                        </div>
                        <?php endif; ?>

                        <!-- Key Highlights Count -->
                        <?php if (!empty($highlights)): ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Key Highlights</p>
                            <p class="mb-0"><strong><?php echo count($highlights); ?></strong> highlights</p>
                        </div>
                        <?php endif; ?>

                        <!-- Deliverables Count -->
                        <?php if (!empty($deliverables)): ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Deliverables</p>
                            <p class="mb-0"><strong><?php echo count($deliverables); ?></strong> key outputs</p>
                        </div>
                        <?php endif; ?>

                        <hr class="my-3">

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <a href="projects.php" class="btn" style="border: 2px solid #dc2626; color: #dc2626; font-weight: 600;">← Back to Projects</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
