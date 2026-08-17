<?php
$pageTitle = 'Admin Publications';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/admin-header.php';

$uploadDir = __DIR__ . '/../assets/files/publications/';
if (!is_dir($uploadDir)) @mkdir($uploadDir, 0755, true);

function save_publication_pdf($file, $uploadDir) {
    if (empty($file) || empty($file['tmp_name'])) return null;
    if ($file['error'] !== UPLOAD_ERR_OK) return null;
    $allowed = ['pdf'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return null;
    $basename = bin2hex(random_bytes(8)) . '_' . time();
    $filename = $basename . '.' . $ext;
    $dest = rtrim($uploadDir, '/') . '/' . $filename;
    if (!move_uploaded_file($file['tmp_name'], $dest)) return null;
    return 'assets/files/publications/' . $filename;
}

// Handle create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'create_publication') {
    $title = trim($_POST['title'] ?? '');
    $authors = trim($_POST['authors'] ?? '');
    $journal = trim($_POST['journal'] ?? '');
    $year = (int)($_POST['year'] ?? 0);
    $summary = trim($_POST['summary'] ?? '');
    $pdf = null;
    if (!empty($_FILES['pdf']) && $_FILES['pdf']['tmp_name']) {
        $pdf = save_publication_pdf($_FILES['pdf'], $uploadDir);
    }
    if ($pdo && $title) {
        $stmt = $pdo->prepare('INSERT INTO publications (title, authors, journal, year, summary, pdf_url) VALUES (:title, :authors, :journal, :year, :summary, :pdf_url)');
        $stmt->execute([':title' => $title, ':authors' => $authors, ':journal' => $journal, ':year' => $year, ':summary' => $summary, ':pdf_url' => $pdf]);
    }
    header('Location: publications.php');
    exit;
}

// Handle edit/update (replace or remove PDF)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'edit_publication') {
    $id = (int)($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $authors = trim($_POST['authors'] ?? '');
    $journal = trim($_POST['journal'] ?? '');
    $year = (int)($_POST['year'] ?? 0);
    $summary = trim($_POST['summary'] ?? '');
    if ($pdo && $id) {
        // fetch existing pdf
        $stmt = $pdo->prepare('SELECT pdf_url FROM publications WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        $pdf = $existing['pdf_url'] ?? null;

        // remove if requested
        if (!empty($_POST['remove_pdf'])) {
            if (!empty($pdf) && strpos($pdf, 'assets/files/publications/') === 0) {
                $oldPath = __DIR__ . '/../' . $pdf;
                if (is_file($oldPath)) @unlink($oldPath);
            }
            $pdf = null;
        }

        // replace if a new file uploaded
        if (!empty($_FILES['pdf']) && $_FILES['pdf']['tmp_name']) {
            $uploaded = save_publication_pdf($_FILES['pdf'], $uploadDir);
            if ($uploaded) {
                if (!empty($pdf) && strpos($pdf, 'assets/files/publications/') === 0) {
                    $oldPath = __DIR__ . '/../' . $pdf;
                    if (is_file($oldPath)) @unlink($oldPath);
                }
                $pdf = $uploaded;
            }
        }

        $stmt = $pdo->prepare('UPDATE publications SET title = :title, authors = :authors, journal = :journal, year = :year, summary = :summary, pdf_url = :pdf_url WHERE id = :id');
        $stmt->execute([':title'=>$title, ':authors'=>$authors, ':journal'=>$journal, ':year'=>$year, ':summary'=>$summary, ':pdf_url'=>$pdf, ':id'=>$id]);
    }
    header('Location: publications.php');
    exit;
}

// Handle delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($pdo) {
        // delete associated PDF file if present
        $stmt = $pdo->prepare('SELECT pdf_url FROM publications WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($row['pdf_url']) && strpos($row['pdf_url'], 'assets/files/publications/') === 0) {
            $oldPath = __DIR__ . '/../' . $row['pdf_url'];
            if (is_file($oldPath)) @unlink($oldPath);
        }
        $stmt = $pdo->prepare('DELETE FROM publications WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }
    header('Location: publications.php');
    exit;
}
?>
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold">Publications</h1>
                <p class="text-muted">Manage publication metadata, PDFs, and research outputs.</p>
            </div>
            <a href="#pub-form" class="btn btn-primary d-inline-block d-md-inline-flex">Add Publication</a>
        </div>
            <div class="table-responsive card card-soft p-4">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Journal</th>
                        <th>Year</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($pdo) {
                        $stmt = $pdo->query('SELECT id, title, journal, year FROM publications ORDER BY created_at DESC');
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['journal']); ?></td>
                        <td><?php echo htmlspecialchars($row['year']); ?></td>
                        <td class="text-end">
                            <a href="publications.php?action=edit&id=<?php echo (int)$row['id']; ?>#pub-form" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="publications.php?action=delete&id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this publication?')">Delete</a>
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

<?php // Create or edit form ?>
<?php if (isset($pdo) && $pdo): ?>
    <?php
    $editItem = null;
    if (isset($_GET['action']) && $_GET['action'] === 'edit' && !empty($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM publications WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $editItem = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <section id="pub-form" class="py-4">
        <div class="container">
            <h3><?php echo $editItem ? 'Edit Publication' : 'Add Publication'; ?></h3>
            <form method="post" action="publications.php" class="admin-form" enctype="multipart/form-data">
                <?php if ($editItem): ?>
                    <input type="hidden" name="action" value="edit_publication">
                    <input type="hidden" name="id" value="<?php echo (int)$editItem['id']; ?>">
                <?php else: ?>
                    <input type="hidden" name="action" value="create_publication">
                <?php endif; ?>
                <div class="form-group"><label>Title</label><input name="title" class="form-control" placeholder="Title" required value="<?php echo htmlspecialchars($editItem['title'] ?? ''); ?>"></div>
                <div class="form-group"><label>Authors</label><input name="authors" class="form-control" placeholder="Authors" value="<?php echo htmlspecialchars($editItem['authors'] ?? ''); ?>"></div>
                <div class="form-group"><label>Journal</label><input name="journal" class="form-control" placeholder="Journal" value="<?php echo htmlspecialchars($editItem['journal'] ?? ''); ?>"></div>
                <div class="form-group"><label>Year</label><input name="year" class="form-control" placeholder="Year" value="<?php echo htmlspecialchars($editItem['year'] ?? ''); ?>"></div>
                <div class="form-group"><label>Summary</label><textarea name="summary" class="form-control" placeholder="Summary"><?php echo htmlspecialchars($editItem['summary'] ?? ''); ?></textarea></div>
                <div class="form-group"><label>PDF (optional)</label><input type="file" name="pdf" accept="application/pdf" class="form-control"></div>
                <?php if (!empty($editItem['pdf_url'])): $pdfPath = $editItem['pdf_url']; if (strpos($pdfPath, '/') !== 0 && strpos($pdfPath, 'http') !== 0) { $pdfPath = '../' . ltrim($pdfPath, '/'); } ?>
                    <div class="form-group"><label>Current PDF</label><div><a href="<?php echo htmlspecialchars($pdfPath); ?>" target="_blank" rel="noopener">Download current PDF</a> &nbsp; <label><input type="checkbox" name="remove_pdf" value="1"> Remove PDF</label></div></div>
                <?php endif; ?>
                <div class="form-actions"><button class="btn btn-primary d-grid d-md-inline-block"><?php echo $editItem ? 'Update' : 'Add Publication'; ?></button></div>
            </form>
        </div>
    </section>
<?php endif; ?>
<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
