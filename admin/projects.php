<?php
$pageTitle = 'Admin Projects';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/project_model.php';
require __DIR__ . '/../includes/admin-header.php';

$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

// Handle POST requests for add/edit
// Handle POST requests for add/edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Skip if this is the separate upload_image action handled later
    if (isset($_POST['action']) && $_POST['action'] === 'upload_image') {
        // noop here; upload_image handled below
    } else {
        $title = $_POST['title'] ?? '';
        $slug = $_POST['slug'] ?? '';
        $summary = $_POST['summary'] ?? '';
        $objectives = $_POST['objectives'] ?? '';
        $technologies = $_POST['technologies'] ?? '';
        $tags = trim($_POST['tags'] ?? '');
        $status = $_POST['status'] ?? 'ongoing';

        // limit tags to max 5
        $tagList = array_filter(array_map('trim', array_slice(explode(',', $tags), 0, 5)));
        $tagsStored = $tagList ? implode(', ', $tagList) : null;

        // handle featured image upload if provided
        $featured = null;
        if (!empty($_FILES['featured_image']) && !empty($_FILES['featured_image']['tmp_name'])) {
            $file = $_FILES['featured_image'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if (in_array($ext, $allowed) && $file['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../assets/images/projects/';
                if (!is_dir($uploadDir)) @mkdir($uploadDir, 0755, true);
                $name = bin2hex(random_bytes(8)) . '_' . time() . '.' . $ext;
                $dest = $uploadDir . $name;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $featured = 'assets/images/projects/' . $name;
                }
            }
        }

        if ($action === 'add') {
            if (create_project(['title' => $title, 'slug' => $slug, 'summary' => $summary, 'objectives' => $objectives, 'technologies' => $technologies, 'research_area_id' => $_POST['research_area_id'] ?? null, 'status' => $status, 'featured_image' => $featured, 'tags' => $tagsStored])) {
                $message = 'Project added successfully!';
                $action = 'list';
            } else {
                $error = 'Failed to add project.';
            }
        } elseif ($action === 'edit') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                // if featured image uploaded, attempt to remove old one
                if ($featured) {
                    $old = get_project($id);
                    if (!empty($old['featured_image'])) {
                        $oldPath = __DIR__ . '/../' . ltrim($old['featured_image'], '/');
                        if (is_file($oldPath)) @unlink($oldPath);
                    }
                }
                $data = ['title'=>$title, 'slug'=>$slug, 'summary'=>$summary, 'objectives'=>$objectives, 'technologies'=>$technologies, 'research_area_id'=>$_POST['research_area_id'] ?? null, 'status'=>$status, 'featured_image'=>$featured ?? ($old['featured_image'] ?? null), 'tags'=>$tagsStored];
                if (update_project($id, $data)) {
                    $message = 'Project updated successfully!';
                    $action = 'list';
                } else {
                    $error = 'Failed to update project.';
                }
            }
        }
    }
}

// Handle delete
if ($action === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (delete_project($id)) {
        $message = 'Project deleted successfully!';
        $action = 'list';
    } else {
        $error = 'Failed to delete project.';
    }
}

$projects = get_projects();
$current_project = null;
if (($action === 'edit' || $action === 'delete') && isset($_GET['id'])) {
    $current_project = get_project($_GET['id']);
}

// Handle image upload for projects (separate action)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'upload_image') {
    $projId = (int)($_POST['project_id'] ?? 0);
    if ($projId && !empty($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
        $uploadDir = __DIR__ . '/../assets/images/projects/';
        if (!is_dir($uploadDir)) @mkdir($uploadDir, 0755, true);
        $file = $_FILES['image'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed) && $file['error'] === UPLOAD_ERR_OK) {
            $name = bin2hex(random_bytes(8)) . '_' . time() . '.' . $ext;
            $dest = $uploadDir . $name;
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $rel = 'assets/images/projects/' . $name;
                $caption = trim($_POST['caption'] ?? '');
                add_project_image($projId, $rel, $caption);
            }
        }
    }
    header('Location: projects.php?action=edit&id=' . ($projId ?: ''));
    exit;
}

// Handle delete image
if ($action === 'delete_image' && !empty($_GET['img_id'])) {
    $imgId = (int)$_GET['img_id'];
    delete_project_image($imgId);
    $returnTo = isset($_GET['id']) ? ('projects.php?action=edit&id=' . (int)$_GET['id']) : 'projects.php';
    header('Location: ' . $returnTo);
    exit;
}
?>
<section class="py-5">
    <div class="container">
        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($action === 'add'): ?>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-6 fw-bold">Add New Project</h1>
                <a href="projects.php" class="btn btn-secondary">Back to List</a>
            </div>
            <form method="POST" class="admin-form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                </div>
                <div class="form-group">
                    <label for="summary">Summary</label>
                    <textarea class="form-control" id="summary" name="summary" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="objectives">Objectives</label>
                    <textarea class="form-control" id="objectives" name="objectives" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="technologies">Technologies (comma separated)</label>
                    <input type="text" class="form-control" id="technologies" name="technologies">
                </div>
                <div class="form-group">
                    <label for="tags">Tags (comma separated, max 5)</label>
                    <input type="text" class="form-control" id="tags" name="tags">
                </div>
                <div class="form-group">
                    <label for="featured_image">Featured Image (optional)</label>
                    <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Add Project</button>
                    <a href="projects.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

        <?php elseif ($action === 'edit' && $current_project): ?>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-6 fw-bold">Edit Project</h1>
                <a href="projects.php" class="btn btn-secondary">Back to List</a>
            </div>
            <form method="POST" class="admin-form">
                <input type="hidden" name="id" value="<?php echo $current_project['id']; ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($current_project['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?php echo htmlspecialchars($current_project['slug']); ?>">
                </div>
                <div class="form-group">
                    <label for="summary">Summary</label>
                    <textarea class="form-control" id="summary" name="summary" rows="4"><?php echo htmlspecialchars($current_project['summary'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="objectives">Objectives</label>
                    <textarea class="form-control" id="objectives" name="objectives" rows="3"><?php echo htmlspecialchars($current_project['objectives'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="technologies">Technologies (comma separated)</label>
                    <input type="text" class="form-control" id="technologies" name="technologies" value="<?php echo htmlspecialchars($current_project['technologies'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="tags">Tags (comma separated, max 5)</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="<?php echo htmlspecialchars($current_project['tags'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>Current Featured Image</label>
                    <?php if (!empty($current_project['featured_image'])): ?>
                        <div class="mb-2"><img src="<?php echo asset_url($current_project['featured_image']); ?>" alt="featured" style="max-width:200px;display:block;border-radius:.5rem;border:1px solid #e6e9ef"></div>
                    <?php else: ?>
                        <p class="text-muted">No featured image set.</p>
                    <?php endif; ?>
                    <label for="featured_image">Replace featured image</label>
                    <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="ongoing" <?php echo $current_project['status'] === 'ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                        <option value="completed" <?php echo $current_project['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                        <option value="archived" <?php echo $current_project['status'] === 'archived' ? 'selected' : ''; ?>>Archived</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning">Update Project</button>
                    <a href="projects.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            <hr>
            <h4>Project Images</h4>
            <div class="mb-3">
                <?php $images = get_project_images($current_project['id']); ?>
                <?php if (!empty($images)): ?>
                    <div class="row g-3">
                        <?php foreach ($images as $img): ?>
                            <div class="col-6 col-md-4">
                                <div class="card">
                                    <img src="<?php echo asset_url($img['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($img['caption'] ?? ''); ?>">
                                    <div class="card-body p-2">
                                        <p class="small mb-2"><?php echo htmlspecialchars($img['caption'] ?? ''); ?></p>
                                        <div class="d-flex justify-content-between">
                                            <a href="?action=delete_image&id=<?php echo (int)$current_project['id']; ?>&img_id=<?php echo (int)$img['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this image?')">Delete</a>
                                            <a href="<?php echo asset_url($img['image_url']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No images uploaded yet.</p>
                <?php endif; ?>
            </div>

            <form method="post" action="projects.php" enctype="multipart/form-data" class="row g-3">
                <input type="hidden" name="action" value="upload_image">
                <input type="hidden" name="project_id" value="<?php echo (int)$current_project['id']; ?>">
                <div class="col-12 col-md-6">
                    <label class="form-label">Image file</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Caption (optional)</label>
                    <input type="text" name="caption" class="form-control">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary">Upload Image</button>
                </div>
            </form>

        <?php elseif ($action === 'delete' && $current_project): ?>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-6 fw-bold">Delete Project</h1>
                <a href="projects.php" class="btn btn-secondary">Back to List</a>
            </div>
            <div class="card p-4 border-danger">
                <h3 class="text-danger">Are you sure you want to delete this project?</h3>
                <p><strong>Title:</strong> <?php echo htmlspecialchars($current_project['title']); ?></p>
                <p class="text-muted">This action cannot be undone.</p>
                <div>
                    <a href="?action=delete&id=<?php echo $current_project['id']; ?>&confirm=yes" class="btn btn-danger">Yes, Delete</a>
                    <a href="projects.php" class="btn btn-secondary">No, Cancel</a>
                </div>
            </div>

        <?php else: // List view ?>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-6 fw-bold">Projects</h1>
                    <p class="text-muted">Manage project records and research details.</p>
                </div>
                <a href="projects.php?action=add" class="btn btn-success">+ Add Project</a>
            </div>
            <div class="table-responsive card card-soft p-4">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($projects)): ?>
                            <?php foreach ($projects as $proj): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($proj['title']); ?></td>
                                    <td><?php echo htmlspecialchars($proj['status']); ?></td>
                                    <td><?php echo htmlspecialchars($proj['updated_at']); ?></td>
                                    <td class="text-end">
                                        <a href="?action=edit&id=<?php echo $proj['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="?action=delete&id=<?php echo $proj['id']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">No projects found. <a href="projects.php?action=add">Add one now</a>.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
