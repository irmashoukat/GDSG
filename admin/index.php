<?php
$pageTitle = 'Admin Dashboard';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/admin-header.php';
?>
<section class="py-5 admin-dashboard-section">
    <div class="container">
        <div class="col-12">
            <h1 class="fw-bold">Admin Dashboard</h1>
            <p class="dashboard-intro">Manage projects, research areas, publications, team members, and news from one central location.</p>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <span class="dashboard-card-icon">📁</span>
                    <h5>Projects</h5>
                </div>
                <p>Create and update research project records.</p>
                <div class="btn-group-dashboard" role="group">
                    <a href="projects.php?action=add" class="btn btn-add btn-sm" title="Add new project"><i class="icon-add">+</i> Add</a>
                    <a href="projects.php" class="btn btn-edit btn-sm" title="Edit existing project"><i class="icon-edit">✎</i> Edit</a>
                    <a href="projects.php?action=delete" class="btn btn-delete btn-sm" title="Delete project"><i class="icon-delete">✕</i> Delete</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <span class="dashboard-card-icon">🔬</span>
                    <h5>Research Areas</h5>
                </div>
                <p>Organize the research domains and their summaries.</p>
                <div class="btn-group-dashboard" role="group">
                    <a href="research.php?action=add" class="btn btn-add btn-sm" title="Add new research area"><i class="icon-add">+</i> Add</a>
                    <a href="research.php" class="btn btn-edit btn-sm" title="Edit existing research area"><i class="icon-edit">✎</i> Edit</a>
                    <a href="research.php?action=delete" class="btn btn-delete btn-sm" title="Delete research area"><i class="icon-delete">✕</i> Delete</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <span class="dashboard-card-icon">📚</span>
                    <h5>Publications</h5>
                </div>
                <p>Maintain the publication library and related metadata.</p>
                <div class="btn-group-dashboard" role="group">
                    <a href="publications.php?action=add" class="btn btn-add btn-sm" title="Add new publication"><i class="icon-add">+</i> Add</a>
                    <a href="publications.php" class="btn btn-edit btn-sm" title="Edit existing publication"><i class="icon-edit">✎</i> Edit</a>
                    <a href="publications.php?action=delete" class="btn btn-delete btn-sm" title="Delete publication"><i class="icon-delete">✕</i> Delete</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <span class="dashboard-card-icon">👥</span>
                    <h5>Team Members</h5>
                </div>
                <p>Add or update researcher profiles and biographies.</p>
                <div class="btn-group-dashboard" role="group">
                    <a href="team.php?action=add" class="btn btn-add btn-sm" title="Add new team member"><i class="icon-add">+</i> Add</a>
                    <a href="team.php" class="btn btn-edit btn-sm" title="Edit existing team member"><i class="icon-edit">✎</i> Edit</a>
                    <a href="team.php?action=delete" class="btn btn-delete btn-sm" title="Delete team member"><i class="icon-delete">✕</i> Delete</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <span class="dashboard-card-icon">📰</span>
                    <h5>News</h5>
                </div>
                <p>Publish news, events, and announcements.</p>
                <div class="btn-group-dashboard" role="group">
                    <a href="news.php?action=add" class="btn btn-add btn-sm" title="Add new news"><i class="icon-add">+</i> Add</a>
                    <a href="news.php" class="btn btn-edit btn-sm" title="Edit existing news"><i class="icon-edit">✎</i> Edit</a>
                    <a href="news.php?action=delete" class="btn btn-delete btn-sm" title="Delete news"><i class="icon-delete">✕</i> Delete</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <span class="dashboard-card-icon">📧</span>
                    <h5>Messages</h5>
                </div>
                <p>Review contact form submissions and messages.</p>
                <div class="btn-group-dashboard" role="group">
                    <a href="messages.php" class="btn btn-edit btn-sm" title="View messages"><i class="icon-edit">📧</i> View</a>
                    <a href="messages.php?action=archive" class="btn btn-archive btn-sm" title="Archive messages"><i class="icon-archive">📁</i> Archive</a>
                    <a href="messages.php?action=delete" class="btn btn-delete btn-sm" title="Delete messages"><i class="icon-delete">✕</i> Delete</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/admin-footer.php'; ?>