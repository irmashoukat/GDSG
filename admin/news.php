<?php
$pageTitle = 'Admin News';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/admin-header.php';

$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

$uploadDir = __DIR__ . '/../assets/images/news/';
if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0755, true);
}

function save_uploaded_image($file, $uploadDir) {
    if (empty($file) || empty($file['tmp_name'])) return null;
    if ($file['error'] !== UPLOAD_ERR_OK) return null;
    $allowed = ['jpg','jpeg','png','gif','webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $maxSize) return null;
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return null;
    $basename = bin2hex(random_bytes(8)) . '_' . time();
    $filename = $basename . '.' . $ext;
    $dest = rtrim($uploadDir, '/') . '/' . $filename;
    if (!move_uploaded_file($file['tmp_name'], $dest)) return null;
    return 'assets/images/news/' . $filename;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $published_at = trim($_POST['published_at'] ?? null) ?: null;

    if ($action === 'add') {
        if ($pdo) {
            // handle uploaded image
            $featured_image = null;
            if (!empty($_FILES['featured_image'])) {
                $uploaded = save_uploaded_image($_FILES['featured_image'], $uploadDir);
                if ($uploaded) $featured_image = $uploaded;
            }
            $stmt = $pdo->prepare('INSERT INTO news (title, category, summary, content, featured_image, published_at) VALUES (:title, :category, :summary, :content, :featured_image, :published_at)');
            $stmt->execute([':title'=>$title, ':category'=>$category, ':summary'=>$summary, ':content'=>$content, ':featured_image'=>$featured_image, ':published_at'=>$published_at]);
            $message = 'News item added.';
            $action = 'list';
        }
    } elseif ($action === 'edit') {
        $id = (int)($_POST['id'] ?? 0);
        if ($pdo && $id) {
            // fetch existing to manage current image
            $stmt = $pdo->prepare('SELECT featured_image FROM news WHERE id = :id');
            $stmt->execute([':id'=>$id]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);
            $featured_image = $existing['featured_image'] ?? null;
            if (!empty($_FILES['featured_image']) && $_FILES['featured_image']['tmp_name']) {
                $uploaded = save_uploaded_image($_FILES['featured_image'], $uploadDir);
                if ($uploaded) {
                    // delete old file if present and inside assets/images/news
                    if (!empty($featured_image) && strpos($featured_image, 'assets/images/news/') === 0) {
                        $oldPath = __DIR__ . '/../' . $featured_image;
                        if (is_file($oldPath)) @unlink($oldPath);
                    }
                    $featured_image = $uploaded;
                }
            }
            $stmt = $pdo->prepare('UPDATE news SET title = :title, category = :category, summary = :summary, content = :content, featured_image = :featured_image, published_at = :published_at WHERE id = :id');
            $stmt->execute([':title'=>$title, ':category'=>$category, ':summary'=>$summary, ':content'=>$content, ':featured_image'=>$featured_image, ':published_at'=>$published_at, ':id'=>$id]);
            $message = 'News item updated.';
            $action = 'list';
        }
    }
}

if ($action === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($pdo && $id) {
        // delete image file if present
        $stmt = $pdo->prepare('SELECT featured_image FROM news WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($row['featured_image']) && strpos($row['featured_image'], 'assets/images/news/') === 0) {
            $oldPath = __DIR__ . '/../' . $row['featured_image'];
            if (is_file($oldPath)) @unlink($oldPath);
        }
        $stmt = $pdo->prepare('DELETE FROM news WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $message = 'News item deleted.';
        $action = 'list';
    }
}

$current = null;
if (($action === 'edit' || $action === 'delete') && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($pdo) {
        $stmt = $pdo->prepare('SELECT * FROM news WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $current = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$news_items = [];
if ($pdo) {
    $stmt = $pdo->query('SELECT id, title, category, published_at, created_at, featured_image FROM news ORDER BY created_at DESC');
    $news_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold">News</h1>
                <p class="text-muted">Publish news, workshops, conferences, and events.</p>
            </div>
            <a href="news.php?action=add" class="btn btn-add">Add News</a>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($action === 'add'): ?>
            <form method="post" class="admin-form" enctype="multipart/form-data">
                <div class="form-group"><label>Title</label><input name="title" class="form-control" required></div>
                <div class="form-group"><label>Category</label><input name="category" class="form-control"></div>
                <div class="form-group"><label>Featured Image</label><input type="file" name="featured_image" accept="image/*" class="form-control"></div>
                <div class="form-group"><label>Summary</label><textarea name="summary" class="form-control" rows="3"></textarea></div>
                <div class="form-group"><label>Content</label><textarea name="content" class="form-control" rows="6"></textarea></div>
                <div class="form-group"><label>Published Date</label><input type="date" name="published_at" class="form-control"></div>
                <div class="form-actions"><button class="btn btn-add" type="submit">Add News</button><a class="btn btn-secondary" href="news.php">Cancel</a></div>
            </form>

        <?php elseif ($action === 'edit' && $current): ?>
            <form method="post" class="admin-form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo (int)$current['id']; ?>">
                <div class="form-group"><label>Title</label><input name="title" class="form-control" value="<?php echo htmlspecialchars($current['title']); ?>" required></div>
                <div class="form-group"><label>Category</label><input name="category" class="form-control" value="<?php echo htmlspecialchars($current['category']); ?>"></div>
                <?php if (!empty($current['featured_image'])): ?>
                    <div class="form-group">
                        <label>Current Image</label>
                        <?php
                        $imgPath = $current['featured_image'];
                        // admin/ is one level deep; prefix ../ when rendering from admin folder
                        if (strpos($imgPath, '/') !== 0 && strpos($imgPath, 'http') !== 0) {
                            $imgPath = '../' . ltrim($imgPath, '/');
                        }
                        ?>
                        <div><img src="<?php echo htmlspecialchars($imgPath); ?>" alt="current" style="max-width:200px;height:auto;border:1px solid #ddd;padding:4px;border-radius:4px"></div>
                    </div>
                <?php endif; ?>
                <div class="form-group"><label>Change Featured Image</label><input type="file" name="featured_image" accept="image/*" class="form-control"></div>
                <div class="form-group"><label>Summary</label><textarea name="summary" class="form-control" rows="3"><?php echo htmlspecialchars($current['summary']); ?></textarea></div>
                <div class="form-group"><label>Content</label><textarea name="content" class="form-control" rows="6"><?php echo htmlspecialchars($current['content']); ?></textarea></div>
                <div class="form-group"><label>Published Date</label><input type="date" name="published_at" class="form-control" value="<?php echo htmlspecialchars($current['published_at']); ?>"></div>
                <div class="form-actions"><button class="btn btn-edit" type="submit">Update News</button><a class="btn btn-secondary" href="news.php">Cancel</a></div>
            </form>

        <?php else: ?>
            <div class="table-responsive card card-soft p-4">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($news_items)): ?>
                            <?php foreach ($news_items as $n): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($n['title']); ?></td>
                                    <td><?php echo htmlspecialchars($n['category']); ?></td>
                                    <td><?php echo htmlspecialchars($n['published_at'] ?: $n['created_at']); ?></td>
                                    <td class="text-end">
                                        <a href="news.php?action=edit&id=<?php echo (int)$n['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="news.php?action=delete&id=<?php echo (int)$n['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this item?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">No news items yet</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
