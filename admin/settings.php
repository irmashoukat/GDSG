<?php
$pageTitle = 'Admin Settings';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/admin-header.php';
?>
<section class="py-5">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold">Settings</h1>
                <p class="text-muted">Configure site-wide metadata and CMS settings.</p>
                <div class="card card-soft p-4 mt-4">
                    <form class="admin-form">
                        <div class="form-group">
                            <label>Site Name</label>
                            <input type="text" class="form-control" value="Geospatial Data Science Group">
                        </div>
                        <div class="form-group">
                            <label>Site Description</label>
                            <textarea class="form-control" rows="4">GDSG is a research institute focused on GIS, GeoAI, remote sensing, spatial analytics, and Earth observation.</textarea>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-add">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
