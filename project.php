<?php
require __DIR__ . '/includes/functions.php';

$projects = [
    'smog' => [
        'title' => 'Smog Monitoring & AQI Forecasting System',
        'lead' => 'An environmental intelligence platform that monitors pollution across Punjab, explains district-level sources, and forecasts future smog conditions.',
        'overview' => 'This initiative combines air quality monitoring, satellite observations, and machine learning to deliver district-wise AQI forecasts and pollution source analysis for Punjab.',
        'objectives' => [
            'Monitor air quality and pollution sources across Punjab',
            'Forecast AQI for 7-day, 14-day, and 21-day horizons',
            'Support health advisories and policy interventions with spatial insights',
        ],
        'technologies' => 'GIS mapping, CNN and LSTM-CNN forecasting, time-series analytics, API-based visualization.',
        'publications' => [
            'Punjab AQI forecasting with hybrid deep learning',
            'Spatial sources of urban air pollution in Pakistan',
        ],
        'metadata' => [
            'Status' => 'Ongoing',
            'Domain' => 'Earth Observation, GeoAI',
            'Team' => 'GDSD',
        ],
        'pis' => ['GDSD'],
    ],
    'hummuqaam' => [
        'title' => 'HumMuqaam – Intelligent Geospatial Addressing System',
        'lead' => 'A national-scale digital location framework that converts administrative boundaries, addresses, and hierarchical grid cells into precise D-Codes.',
        'overview' => 'HumMuqaam maps Pakistan’s administrative hierarchy, address records, and geographic coordinates into a digital location system for reliable navigation, planning, and services.',
        'objectives' => [
            'Build a hierarchical L0–L6 digital addressing scheme',
            'Automatically assign D-Codes using spatial joins and point-in-polygon logic',
            'Make location data searchable and interoperable for public services',
        ],
        'technologies' => 'PostGIS spatial databases, GIS operations, administrative boundary modeling, automated address geocoding.',
        'publications' => [
            'A digital address framework for Pakistan',
            'Spatial indexing and hierarchy for national location systems',
        ],
        'metadata' => [
            'Status' => 'Ongoing',
            'Domain' => 'Spatial Analytics, GeoAI',
            'Team' => 'GDSD',
        ],
        'pis' => ['GDSD'],
    ],
    'crop-library' => [
        'title' => 'Crop Library',
        'lead' => 'A searchable agricultural knowledge platform for structured crop profiles, field practices, environmental requirements, and evidence-led decisions.',
        'overview' => 'Crop Library organizes crop varieties, growing conditions, risks, and recommendations into a location-aware knowledge base for farmers, advisors, and planners.',
        'objectives' => [
            'Document crop varieties, seasons, soils, and irrigation needs',
            'Link crop guidance with weather, soil, and environmental data',
            'Enable evidence-based decisions through searchable agriculture knowledge',
        ],
        'technologies' => 'Data management, GeoAI, weather data integration, precision agriculture analytics.',
        'publications' => [
            'Knowledge-driven agriculture for resilient crop systems',
            'GeoAI-enabled decisions for smallholder farming',
        ],
        'metadata' => [
            'Status' => 'Ongoing',
            'Domain' => 'Agriculture, Earth Observation',
            'Team' => 'GDSD',
        ],
        'pis' => ['GDSD'],
    ],
];

$projectKey = isset($_GET['project']) ? trim($_GET['project']) : 'smog';
if (!array_key_exists($projectKey, $projects)) {
    $projectKey = 'smog';
}
$project = $projects[$projectKey];
$pageTitle = $project['title'];

require __DIR__ . '/includes/header.php';

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<section class="py-5 project-detail-page project-detail-page--<?php echo e($projectKey); ?>">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold"><?php echo e($project['title']); ?></h1>
                <p class="lead text-muted"><?php echo e($project['lead']); ?></p>
                <div class="card p-4 card-soft mb-4 reveal about-detail-card">
                    <h3 class="h5">Project Overview</h3>
                    <p class="text-muted"><?php echo e($project['overview']); ?></p>
                </div>
                <div class="row g-4 stagger">
                    <div class="col-md-6">
                        <div class="card p-4 card-soft tilt-card about-detail-card">
                            <h4>Objectives</h4>
                            <ul class="text-muted">
                                <?php foreach ($project['objectives'] as $objective): ?>
                                    <li><?php echo e($objective); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-4 card-soft tilt-card about-detail-card">
                            <h4>Technologies</h4>
                            <p class="text-muted"><?php echo e($project['technologies']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="card p-4 card-soft mt-4 reveal about-detail-card">
                    <h4>Related Publications</h4>
                    <ul class="list-unstyled mb-0 text-muted">
                        <?php foreach ($project['publications'] as $publication): ?>
                            <li><?php echo e($publication); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-4 card-soft mb-4 about-detail-card">
                    <h5>Project Metadata</h5>
                    <dl class="row">
                        <?php foreach ($project['metadata'] as $label => $value): ?>
                            <dt class="col-6 text-muted"><?php echo e($label); ?></dt>
                            <dd class="col-6"><?php echo e($value); ?></dd>
                        <?php endforeach; ?>
                    </dl>
                </div>
                <div class="card p-4 card-soft about-detail-card">
                    <h5>Principal Investigators</h5>
                    <?php foreach ($project['pis'] as $pi): ?>
                        <p class="text-muted mb-2"><?php echo e($pi); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
