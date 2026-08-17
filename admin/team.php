<?php
$pageTitle = 'Admin Team';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/admin-header.php';

$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

$uploadDir = __DIR__ . '/../assets/images/team/';
if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0755, true);
}

function save_team_image($file, $uploadDir) {
    if (empty($file) || empty($file['tmp_name'])) return null;
    if ($file['error'] !== UPLOAD_ERR_OK) return null;
    $allowed = ['jpg','jpeg','png','gif','webp'];
    $maxSize = 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) return null;
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return null;
    $basename = bin2hex(random_bytes(8)) . '_' . time();
    $filename = $basename . '.' . $ext;
    $dest = rtrim($uploadDir, '/') . '/' . $filename;
    if (!move_uploaded_file($file['tmp_name'], $dest)) return null;
    return 'assets/images/team/' . $filename;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $biography = trim($_POST['biography'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $linkedin = trim($_POST['linkedin'] ?? '');

    if ($action === 'add') {
        if ($pdo) {
            $photo = null;
            if (!empty($_FILES['photo']) && $_FILES['photo']['tmp_name']) {
                $uploaded = save_team_image($_FILES['photo'], $uploadDir);
                if ($uploaded) $photo = $uploaded;
            }
            $stmt = $pdo->prepare('INSERT INTO team_members (name, position, biography, photo_url, email, linkedin) VALUES (:name, :position, :biography, :photo_url, :email, :linkedin)');
            $stmt->execute([':name'=>$name, ':position'=>$position, ':biography'=>$biography, ':photo_url'=>$photo, ':email'=>$email, ':linkedin'=>$linkedin]);
            $message = 'Team member added.';
            $action = 'list';
        }
    } elseif ($action === 'edit') {
        $id = (int)($_POST['id'] ?? 0);
        if ($pdo && $id) {
            $stmt = $pdo->prepare('SELECT photo_url FROM team_members WHERE id = :id');
            $stmt->execute([':id'=>$id]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);
            $photo = $existing['photo_url'] ?? null;
            if (!empty($_FILES['photo']) && $_FILES['photo']['tmp_name']) {
                $uploaded = save_team_image($_FILES['photo'], $uploadDir);
                if ($uploaded) {
                    if (!empty($photo) && strpos($photo, 'assets/images/team/') === 0) {
                        $oldPath = __DIR__ . '/../' . $photo;
                        if (is_file($oldPath)) @unlink($oldPath);
                    }
                    $photo = $uploaded;
                }
            }
            $stmt = $pdo->prepare('UPDATE team_members SET name=:name, position=:position, biography=:biography, photo_url=:photo_url, email=:email, linkedin=:linkedin WHERE id=:id');
            $stmt->execute([':name'=>$name, ':position'=>$position, ':biography'=>$biography, ':photo_url'=>$photo, ':email'=>$email, ':linkedin'=>$linkedin, ':id'=>$id]);
            $message = 'Team member updated.';
            $action = 'list';
        }
    }
}

if ($action === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($pdo && $id) {
        $stmt = $pdo->prepare('SELECT photo_url FROM team_members WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($row['photo_url']) && strpos($row['photo_url'], 'assets/images/team/') === 0) {
            $oldPath = __DIR__ . '/../' . $row['photo_url'];
            if (is_file($oldPath)) @unlink($oldPath);
        }
        $stmt = $pdo->prepare('DELETE FROM team_members WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $message = 'Team member deleted.';
        $action = 'list';
    }
}

$current = null;
if (($action === 'edit' || $action === 'delete') && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($pdo) {
        $stmt = $pdo->prepare('SELECT * FROM team_members WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        $current = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$team_members = [];
if ($pdo) {
    $stmt = $pdo->query('SELECT id, name, position, email, photo_url, created_at FROM team_members ORDER BY created_at DESC');
    $team_members = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold">Team Members</h1>
                <p class="text-muted">Manage researcher profiles and expertise details.</p>
            </div>
            <a href="team.php?action=add" class="btn btn-add">Add Member</a>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($action === 'add'): ?>
            <form method="post" class="admin-form" enctype="multipart/form-data">
                <div class="form-group"><label>Name</label><input name="name" class="form-control" required></div>
                <div class="form-group"><label>Position</label><input name="position" class="form-control"></div>
                <div class="form-group"><label>Photo</label><input type="file" name="photo" accept="image/*" class="form-control"></div>
                <div class="form-group"><label>Email</label><input name="email" class="form-control" type="email"></div>
                <div class="form-group"><label>LinkedIn</label><input name="linkedin" class="form-control"></div>
                <div class="form-group"><label>Biography</label><textarea name="biography" class="form-control" rows="5"></textarea></div>
                <div class="form-actions"><button class="btn btn-add" type="submit">Add Member</button><a class="btn btn-secondary" href="team.php">Cancel</a></div>
            </form>

        <?php elseif ($action === 'edit' && $current): ?>
            <form method="post" class="admin-form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo (int)$current['id']; ?>">
                <div class="form-group"><label>Name</label><input name="name" class="form-control" value="<?php echo htmlspecialchars($current['name']); ?>" required></div>
                <div class="form-group"><label>Position</label><input name="position" class="form-control" value="<?php echo htmlspecialchars($current['position']); ?>"></div>
                <?php if (!empty($current['photo_url'])): ?>
                    <?php $imgPath = $current['photo_url']; if (strpos($imgPath, '/') !== 0 && strpos($imgPath, 'http') !== 0) { $imgPath = '../' . ltrim($imgPath, '/'); } ?>
                    <div class="form-group"><label>Current Photo</label><div><img src="<?php echo htmlspecialchars($imgPath); ?>" alt="current" style="max-width:150px;border-radius:6px"></div></div>
                <?php endif; ?>
                <div class="form-group"><label>Change Photo</label><input type="file" name="photo" accept="image/*" class="form-control"></div>
                <div class="form-group"><label>Email</label><input name="email" class="form-control" type="email" value="<?php echo htmlspecialchars($current['email']); ?>"></div>
                <div class="form-group"><label>LinkedIn</label><input name="linkedin" class="form-control" value="<?php echo htmlspecialchars($current['linkedin']); ?>"></div>
                <div class="form-group"><label>Biography</label><textarea name="biography" class="form-control" rows="5"><?php echo htmlspecialchars($current['biography']); ?></textarea></div>
                <div class="form-actions"><button class="btn btn-edit" type="submit">Update Member</button><a class="btn btn-secondary" href="team.php">Cancel</a></div>
            </form>

        <?php else: ?>
            <div class="table-responsive card card-soft p-4">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($team_members)): ?>
                            <?php foreach ($team_members as $m): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($m['name']); ?></td>
                                    <td><?php echo htmlspecialchars($m['position']); ?></td>
                                    <td><?php echo htmlspecialchars($m['email']); ?></td>
                                    <td class="text-end">
                                        <a href="team.php?action=edit&id=<?php echo (int)$m['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="team.php?action=delete&id=<?php echo (int)$m['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this member?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">No team members yet</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
