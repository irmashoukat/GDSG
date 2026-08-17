<?php
$pageTitle = 'Admin Gallery';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/admin-header.php';
?>
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold">Gallery</h1>
                <p class="text-muted">Upload and manage gallery images for the public site.</p>
            </div>
            <a href="gallery.php?action=add" class="btn btn-add">Add Image</a>
        </div>
        <div class="table-responsive card card-soft p-4">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Caption</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Field Research Setup</td>
                        <td>gallery-1.jpg</td>
                        <td>Satellite observation monitoring in action</td>
                        <td class="text-end"><a href="#" class="btn btn-sm btn-outline-secondary">Edit</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
