<?php
$pageTitle = 'Team';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';
?>
<section class="py-5 team-section" style="background-image: linear-gradient(rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0.15)), url('/assets/images/geo-satellite-clean.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold" style="color: #3366e0;">Research Team</h1>
                <p class="lead" style="color: #FFFFFF !important; font-weight: 900; font-size: 1.3rem; text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.9); letter-spacing: 0.5px; line-height: 1.6;">A multidisciplinary collective of scientists and engineers pioneering the intersection of AI, GIS, and Earth observation.</p>
            </div>
        </div>
        <div class="row g-3 mt-4">
            <?php
            $members = get_team_members($pdo, 12);
            if (!empty($members)) {
                foreach ($members as $m) {
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="team-member-text">
                            <h3 class="team-member-name"><?php echo htmlspecialchars($m['name']); ?></h3>
                            <p class="team-member-position"><?php echo htmlspecialchars($m['position']); ?></p>
                            <?php if (!empty($m['expertise'])): ?>
                                <p class="team-member-expertise"><?php echo htmlspecialchars($m['expertise']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($m['biography'])): ?>
                                <p class="team-member-bio"><?php echo htmlspecialchars($m['biography']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
