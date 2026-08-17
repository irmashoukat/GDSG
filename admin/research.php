<?php
$pageTitle = 'Admin Research Areas';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/admin-header.php';

$action = $_GET['action'] ?? 'list';

function slugify($text) {
    $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
    $text = strtolower(trim($text, '-'));
    $text = preg_replace('/-+/', '-', $text);
    return $text ?: 'area-' . time();
}

// Handle create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'create_research') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if (!$slug) $slug = slugify($title);
    if ($pdo && $title) {
        $stmt = $pdo->prepare('INSERT INTO research_areas (title, slug, summary, content) VALUES (:title, :slug, :summary, :content)');
        $stmt->execute([':title'=>$title, ':slug'=>$slug, ':summary'=>$summary, ':content'=>$content]);
    }
    header('Location: research.php#research-form');
    exit;
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'edit_research') {
    $id = (int)($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if (!$slug) $slug = slugify($title);
    if ($pdo && $id) {
        $stmt = $pdo->prepare('UPDATE research_areas SET title=:title, slug=:slug, summary=:summary, content=:content WHERE id = :id');
        $stmt->execute([':title'=>$title, ':slug'=>$slug, ':summary'=>$summary, ':content'=>$content, ':id'=>$id]);
    }
    header('Location: research.php#research-form');
    exit;
}

// Handle delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($pdo) {
        $stmt = $pdo->prepare('DELETE FROM research_areas WHERE id = :id');
        $stmt->execute([':id'=>$id]);
    }
    header('Location: research.php');
    exit;
}

?>
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold">Research Areas</h1>
                <p class="text-muted">Manage research domains shown on the public site.</p>
            </div>
            <a href="#research-form" class="btn btn-primary">Add Area</a>
        </div>

        <div class="table-responsive card card-soft p-4">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Summary</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($pdo) {
                        $stmt = $pdo->query('SELECT id, title, slug, summary, created_at FROM research_areas ORDER BY created_at DESC');
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['slug']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars(mb_substr($row['summary'] ?? '', 0, 180))); ?></td>
                        <td class="text-end">
                            <a href="research.php?action=edit&id=<?php echo (int)$row['id']; ?>#research-form" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="research.php?action=delete&id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this area?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; } else { ?>
                    <tr><td colspan="4">No database connection.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php if ($pdo): ?>
    <?php
    $editItem = null;
    if (isset($_GET['action']) && $_GET['action'] === 'edit' && !empty($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM research_areas WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $editItem = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <section id="research-form" class="py-4">
        <div class="container">
            <h3><?php echo $editItem ? 'Edit Research Area' : 'Add Research Area'; ?></h3>
            <form method="post" action="research.php" class="admin-form">
                <?php if ($editItem): ?>
                    <input type="hidden" name="action" value="edit_research">
                    <input type="hidden" name="id" value="<?php echo (int)$editItem['id']; ?>">
                <?php else: ?>
                    <input type="hidden" name="action" value="create_research">
                <?php endif; ?>
                <div class="form-group"><label>Title</label><input name="title" class="form-control" required value="<?php echo htmlspecialchars($editItem['title'] ?? ''); ?>"></div>
                <div class="form-group"><label>Slug (optional)</label><input name="slug" class="form-control" value="<?php echo htmlspecialchars($editItem['slug'] ?? ''); ?>"></div>
                <div class="form-group"><label>Summary</label><textarea name="summary" class="form-control"><?php echo htmlspecialchars($editItem['summary'] ?? ''); ?></textarea></div>
                <div class="form-group"><label>Content</label><textarea name="content" class="form-control" rows="8"><?php echo htmlspecialchars($editItem['content'] ?? ''); ?></textarea></div>
                <div class="form-actions"><button class="btn btn-primary"><?php echo $editItem ? 'Update' : 'Add Area'; ?></button></div>
            </form>
        </div>
    </section>
<?php endif; ?>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
