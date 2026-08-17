<?php
// Simple session-based admin auth guard for local dev.
// This is a minimal implementation and should be replaced by a secure auth system before production.
session_start();

$script = basename($_SERVER['SCRIPT_NAME']);
$allowed = ['login.php', 'logout.php'];

if (in_array($script, $allowed, true)) {
    return;
}

if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to admin login
    header('Location: /admin/login.php');
    exit;
}

?>
