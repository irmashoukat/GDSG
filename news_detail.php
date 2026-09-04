<?php
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = $id ? get_news_item($pdo, $id) : null;

// Fallback if DB item not found for standard 1 and 2
if (!$item) {
    if ($id == 1) {
        $item = [
            'id' => 1,
            'title' => 'New GeoAI collaboration announced',
            'category' => 'News',
            'published_at' => '2024-01-15',
            'summary' => 'GDSG partners with academic institutions to accelerate climate analytics research.',
            'featured_image' => '/assets/images/World_environment_day_GDSG_Post.jpg',
            'content' => "We are excited to announce a groundbreaking collaboration between the Geospatial Data Science Group (GDSG) and leading academic institutions worldwide. This partnership focuses on advancing GeoAI technologies for climate analytics and environmental monitoring.\n\nKey highlights of this collaboration:\n\n• Joint Research Initiatives: Combined expertise in geospatial analysis, AI, and climate science\n• Open Data Sharing: Access to satellite imagery and environmental datasets\n• Student Exchange Programs: Opportunities for graduate students and researchers\n• Conference Partnerships: Co-hosting international conferences on GeoAI and Earth observation\n• Funding Opportunities: Joint grants for collaborative research projects\n\nThis collaboration marks a significant milestone in our commitment to addressing global climate challenges through innovative geospatial technology and artificial intelligence."
        ];
    } elseif ($id == 2) {
        $item = [
            'id' => 2,
            'title' => 'Workshop on Earth Observation analytics',
            'category' => 'Event',
            'published_at' => '2024-01-10',
            'summary' => 'A hands-on workshop covering remote sensing, data fusion, and spatial modeling.',
            'featured_image' => '/assets/images/Earth_day_Founder_Maria_Seminar.jpg',
            'content' => "Join us for an intensive workshop on Earth Observation Analytics! This comprehensive training program is designed for geospatial professionals, researchers, and students who want to master advanced remote sensing and spatial analysis techniques.\n\nWorkshop Details:\nDate: February 20-22, 2024\nLocation: GDSG Research Center\nDuration: 3 days (8 hours per day)\nParticipants: Maximum 50\n\nCourse Curriculum:\nDay 1: Fundamentals of Remote Sensing and Satellite Imagery\n• Introduction to satellite platforms and sensors\n• Understanding spectral bands and their applications\n• Hands-on: Image preprocessing and radiometric corrections\n\nDay 2: Advanced Data Fusion and Image Classification\n• Multi-sensor data integration techniques\n• Machine learning for image classification\n• Change detection methods\n\nDay 3: Practical Applications and Spatial Modeling\n• Real-world case studies\n• Building spatial models for environmental monitoring\n• Interactive projects with participants\n\nInstructor: GDSG Research Team\nRegistration: Early bird discount available until January 31, 2024"
        ];
    }
}

$pageTitle = $item ? $item['title'] : 'News Not Found';
require __DIR__ . '/includes/header.php';

$category = $item['category'] ?? 'News';
$isEvent = (strtolower($category) === 'event');
$badgeClass = $isEvent ? 'bg-danger text-white' : 'bg-success text-white';
$dateStr = !empty($item['published_at']) ? date('F d, Y', strtotime($item['published_at'])) : date('F d, Y');
$imgSrc = !empty($item['featured_image']) ? $item['featured_image'] : '/assets/images/placeholder.svg';
if (strpos($imgSrc, '/') !== 0 && strpos($imgSrc, 'http') !== 0) $imgSrc = '/' . ltrim($imgSrc, '/');
?>

<div class="py-5" style="background: #f8fafc; min-height: 80vh;">
    <div class="container" style="max-width: 960px;">
        <div class="mb-4">
            <a href="news.php" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-2" style="border-radius: 8px; font-weight: 600;">
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                Back to News &amp; Events
            </a>
        </div>

        <?php if (!$item): ?>
            <div class="alert alert-warning p-4 rounded-4 shadow-sm">
                <h4 class="fw-bold mb-2">News Item Not Found</h4>
                <p class="mb-3 text-muted">The requested news or event article could not be located.</p>
                <a href="news.php" class="btn btn-primary btn-sm">Return to News</a>
            </div>
        <?php else: ?>
            <article class="bg-white p-4 p-md-5 rounded-4 shadow-sm border border-light-subtle">
                <!-- Meta Row -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                    <span class="badge <?php echo $badgeClass; ?> fw-bold px-3 py-2 rounded-pill text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                        <?php echo htmlspecialchars($category); ?>
                    </span>
                    <span class="d-inline-flex align-items-center gap-1 text-muted small">
                        <span class="material-symbols-outlined" style="font-size: 16px;">calendar_today</span>
                        <span><?php echo htmlspecialchars($dateStr); ?></span>
                    </span>
                </div>

                <!-- Title -->
                <h1 class="display-6 fw-bold text-dark mb-3"><?php echo htmlspecialchars($item['title']); ?></h1>
                
                <div class="d-flex align-items-center gap-2 mb-4 text-muted small">
                    <span>Published by <strong>GDSG Communications</strong></span>
                    <span>•</span>
                    <span>Geospatial Data Science Group</span>
                </div>

                <!-- Featured Image -->
                <?php if (!empty($imgSrc)): ?>
                    <div class="mb-4 text-center rounded-3 overflow-hidden" style="background: #0f172a; max-height: 520px;">
                        <img src="<?php echo htmlspecialchars($imgSrc); ?>" 
                             alt="<?php echo htmlspecialchars($item['title']); ?>" 
                             class="img-fluid" 
                             style="max-height: 520px; width: auto; object-fit: contain;">
                    </div>
                <?php endif; ?>

                <!-- Summary Callout -->
                <?php if (!empty($item['summary'])): ?>
                    <div class="p-3 mb-4 rounded-3 border-start border-4 border-success bg-light text-secondary fw-semibold">
                        <?php echo htmlspecialchars($item['summary']); ?>
                    </div>
                <?php endif; ?>

                <!-- Content Body -->
                <div class="article-content" style="font-size: 1.05rem; line-height: 1.8; color: #334155;">
                    <?php echo nl2br(htmlspecialchars($item['content'])); ?>
                </div>

                <div class="border-top pt-4 mt-5 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <a href="news.php" class="btn btn-outline-success d-inline-flex align-items-center gap-2" style="border-radius: 8px;">
                        <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                        <span>Back to all updates</span>
                    </a>
                    <span class="text-muted small">Share: GDSG News &amp; Events</span>
                </div>
            </article>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
