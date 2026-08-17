<?php
$pageTitle = 'About';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/header.php';
?>
<section class="about-page py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7">
                <h1 class="display-6 fw-bold">About the Geospatial Data Science Group</h1>
                <p class="lead text-muted">GDSG advances geospatial science through innovative research, GeoAI solutions, environmental analytics, and interdisciplinary partnerships.</p>
                <div class="row g-4 mt-4 stagger">
                    <div class="col-md-4">
                        <div class="card about-principle-card p-4 card-soft h-100 tilt-card">
                            <h3 class="h6 about-principle-title">Vision</h3>
                            <p class="mb-0 text-muted">Advance geospatial science through innovation, AI, and interdisciplinary collaboration.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card about-principle-card p-4 card-soft h-100 tilt-card">
                            <h3 class="h6 about-principle-title">Mission</h3>
                            <p class="mb-0 text-muted">Conduct impactful research, develop GeoAI solutions, and train future geospatial leaders.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card about-principle-card p-4 card-soft h-100 tilt-card">
                            <h3 class="h6 about-principle-title">Values</h3>
                            <p class="mb-0 text-muted">Scientific rigor, open collaboration, sustainability, and accessible research.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card feature-card research-philosophy-card p-4 h-100 shadow-sm tilt-card">
                    <h3 class="h5 mb-3 research-philosophy-title">Research Philosophy</h3>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-3"><strong class="scientific-excellence-label">Scientific Excellence:</strong> Rigorous methods and peer-reviewed work.</li>
                        <li class="mb-3"><strong>Interdisciplinary Collaboration:</strong> Partnerships that connect science, industry, and policy.</li>
                        <li><strong>Open Science:</strong> Transparent methodologies and shared geospatial data.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-5 stagger">
            <div class="col-lg-4">
                <div class="card about-detail-card p-4 card-soft h-100 tilt-card">
                    <h4 class="about-principle-title">History</h4>
                    <p class="text-muted">Founded to unite geospatial expertise around AI, remote sensing, and urban-environmental analytics.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card about-detail-card p-4 card-soft h-100 tilt-card">
                    <h4 class="about-principle-title">Leadership</h4>
                    <p class="text-muted">Led by an experienced team of researchers from geography, computer science, and environmental science.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card about-detail-card p-4 card-soft h-100 tilt-card">
                    <h4 class="about-principle-title">Core Values</h4>
                    <p class="text-muted">Impact, integrity, innovation, and inclusion across all research efforts.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
