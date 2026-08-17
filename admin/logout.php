<?php
// Log out the admin user and redirect to login
session_start();
session_unset();
session_destroy();
header('Location: /admin/login.php');
exit;
