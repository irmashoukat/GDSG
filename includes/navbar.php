<?php
$currentPath = basename($_SERVER['SCRIPT_NAME']);
?>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent container-fluid py-3">
        <a class="navbar-brand" href="index.php" aria-label="Go to GDSG homepage" title="GDSG homepage">
            <img src="<?php echo asset_url('logo.jpeg'); ?>" alt="GDSG logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNavbar" aria-controls="siteNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="siteNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link<?php echo $currentPath === 'index.php' ? ' active' : ''; ?>" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link<?php echo $currentPath === 'about.php' ? ' active' : ''; ?>" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link<?php echo $currentPath === 'research.php' ? ' active' : ''; ?>" href="research.php">Research</a></li>
                <li class="nav-item"><a class="nav-link<?php echo $currentPath === 'projects.php' ? ' active' : ''; ?>" href="projects.php">Projects</a></li>
                <li class="nav-item"><a class="nav-link<?php echo $currentPath === 'publications.php' ? ' active' : ''; ?>" href="publications.php">Publications</a></li>
                <li class="nav-item"><a class="nav-link<?php echo $currentPath === 'team.php' ? ' active' : ''; ?>" href="team.php">Team</a></li>
                <li class="nav-item"><a class="nav-link<?php echo $currentPath === 'news.php' ? ' active' : ''; ?>" href="news.php">News</a></li>
            </ul>
            <a class="btn navbar-contact d-none d-lg-inline-flex" href="contact.php">Contact</a>
        </div>
    </nav>
</header>
