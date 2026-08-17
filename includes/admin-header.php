<?php
require __DIR__ . '/auth.php';
$config = require __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($config['site_description']); ?>">
    <meta property="og:title" content="Admin | <?php echo htmlspecialchars($config['site_name']); ?>">
    <meta property="og:description" content="Manage the GDSG website content, research, and publications.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hanken+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaAOMy+6Yk4TeB9vNQxjzvJpYxTBEeyWmL/5A0OVEQr+M7FpKGT3wFQd4NX" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset_url('assets/css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('assets/css/admin-dashboard.css'); ?>">
    <style>
        /* Admin background image (responsive) */
        .admin-layout {
            background-image: url("<?php echo asset_url('assets/images/geo-satellite-clean.jpg'); ?>");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        /* Slightly adjust position on small screens */
        @media (max-width: 767px) {
            .admin-layout { background-position: top center; }
        }
    </style>
    <title><?php echo get_page_title($pageTitle ?? 'Admin'); ?></title>
</head>
<body class="bg-light text-body">
<header class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button id="sidebarToggle" class="btn btn-sm btn-light d-md-none me-2" aria-label="Toggle sidebar">☰</button>
            <a class="navbar-brand fw-bold" href="index.php">GDSG Admin</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
<div class="container-fluid admin-layout">
    <div class="row">
        <nav class="col-md-3 col-xl-2 d-none d-md-block bg-white admin-sidebar py-4">
            <div class="px-3">
                <h6 class="text-uppercase text-muted">Manage</h6>
                <ul class="nav flex-column mt-3">
                    <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="projects.php">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="research.php">Research Areas</a></li>
                    <li class="nav-item"><a class="nav-link" href="publications.php">Publications</a></li>
                    <li class="nav-item"><a class="nav-link" href="team.php">Team</a></li>
                    <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="messages.php">Messages</a></li>
                    <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ms-sm-auto col-xl-10 px-4 py-4">
