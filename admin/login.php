<?php
$pageTitle = 'Admin Login';
require __DIR__ . '/../includes/functions.php';
$config = require __DIR__ . '/../includes/config.php';
session_start();

// Handle logout redirect if requested
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if ($email === $config['admin']['email'] && $password === $config['admin']['password']) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/index.php');
        exit;
    }
    $error = 'Invalid credentials';
}

require __DIR__ . '/../includes/header.php';
?>
<section class="admin-login-page py-5">
    <div class="admin-login-container">
        <div class="admin-login-card">
            <h1>Admin Login</h1>
            <p>Secure access to the GDSG content management portal.</p>
            <?php if ($error): ?>
                <div class="admin-alert"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="post" action="" class="admin-login-form">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="admin-login-btn">Sign In</button>
            </form>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
