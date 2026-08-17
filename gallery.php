<?php
$pageTitle = 'Gallery';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/header.php';
?>
<section class="py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold">Gallery</h1>
                <p class="lead text-muted">Visual highlights from our research, lab work, and field studies.</p>
            </div>
        </div>
        <div class="row g-4 mt-4 stagger">
            <div class="col-sm-6 col-lg-4">
                <figure class="card card-soft image-card gallery-card mb-0 tilt-card">
                    <img src="assets/images/Agriculture_area_under_flood_GDSG_map.jpg" alt="GDSG map showing agricultural areas affected by flooding" class="image-card__media gallery-card__media">
                    <figcaption class="image-card__body">Agricultural flood impact mapping</figcaption>
                </figure>
            </div>
            <div class="col-sm-6 col-lg-4">
                <figure class="card card-soft image-card gallery-card mb-0 tilt-card">
                    <img src="assets/images/Forest_fire_Severity_Murree_Kotli_Map.jpg" alt="Forest fire severity map for Murree and Kotli" class="image-card__media gallery-card__media">
                    <figcaption class="image-card__body">Forest fire severity analysis</figcaption>
                </figure>
            </div>
            <div class="col-sm-6 col-lg-4">
                <figure class="card card-soft image-card gallery-card mb-0 tilt-card">
                    <img src="assets/images/World_environment_day_GDSG_Post.jpg" alt="GDSG World Environment Day post" class="image-card__media gallery-card__media">
                    <figcaption class="image-card__body">World Environment Day outreach</figcaption>
                </figure>
            </div>
            <div class="col-sm-6 col-lg-4">
                <figure class="card card-soft image-card gallery-card mb-0 tilt-card">
                    <img src="assets/images/25th Aniversary picture.jpg" alt="GDSG anniversary celebration" class="image-card__media gallery-card__media">
                    <figcaption class="image-card__body">25th anniversary celebration</figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
