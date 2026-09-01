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

        <?php
        $teamGalleryFiles = glob(__DIR__ . '/team images/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        $internGalleryFiles = glob(__DIR__ . '/team with interns/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        if (!empty($teamGalleryFiles)) {
            natcasesort($teamGalleryFiles);
        ?>
        <div class="team-gallery-wrapper mt-5">
            <div class="team-gallery-header">
                <h2 class="team-gallery-title team-gallery-main-title">Team Gallery</h2>
            </div>
            <div class="team-gallery-grid team-photo-only-grid">
                <?php foreach ($teamGalleryFiles as $teamImage): ?>
                    <?php $filename = basename($teamImage); $relativeImagePath = 'team images/' . $filename; $fullImageUrl = asset_url($relativeImagePath); ?>
                    <div class="team-photo-only-item">
                        <a href="#team-full-image" aria-label="Open full team photo" class="team-photo-anchor" data-full-image="<?php echo htmlspecialchars($fullImageUrl); ?>">
                            <img src="<?php echo htmlspecialchars($fullImageUrl); ?>" alt="Team member photo" loading="lazy">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <section class="team-interns-section" aria-labelledby="interns-title">
            <h2 id="interns-title" class="team-gallery-title">Interns at GDSG</h2>
            <p class="team-interns-copy">
                Our interns bring curiosity, fresh ideas, and a strong willingness to learn to every project.<br>
                Working with the team gives them practical experience in AI, GIS, remote sensing, and Earth observation.<br>
                They collaborate with researchers, explore real-world challenges, and turn classroom knowledge into meaningful solutions.<br>
                This experience helps them grow with confidence while contributing to the future of geospatial innovation.
            </p>
        </section>
        <?php if (!empty($internGalleryFiles)): ?>
            <?php natcasesort($internGalleryFiles); ?>
            <div class="team-gallery-wrapper team-intern-gallery-wrapper">
                <div class="team-gallery-grid team-photo-only-grid">
                    <?php foreach ($internGalleryFiles as $internImage): ?>
                        <?php $filename = basename($internImage); $relativeImagePath = 'team with interns/' . $filename; $fullImageUrl = asset_url($relativeImagePath); ?>
                        <div class="team-photo-only-item">
                            <a href="#team-full-image" aria-label="Open full intern team photo" class="team-photo-anchor" data-full-image="<?php echo htmlspecialchars($fullImageUrl); ?>">
                                <img src="<?php echo htmlspecialchars($fullImageUrl); ?>" alt="Interns working with the GDSG team" loading="lazy">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php } ?>
    </div>
</section>
<div id="team-full-image-overlay" class="team-full-image-overlay" aria-hidden="true">
    <div class="team-full-image-modal">
        <button type="button" class="team-full-image-close" aria-label="Close image">×</button>
        <img id="team-full-image" src="" alt="Full team member photo">
    </div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const overlay = document.getElementById('team-full-image-overlay');
        const modalImage = document.getElementById('team-full-image');
        const closeButton = document.querySelector('.team-full-image-close');

        document.querySelectorAll('.team-photo-anchor').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const fullImage = link.getAttribute('data-full-image');
                modalImage.src = fullImage;
                overlay.classList.add('active');
                overlay.setAttribute('aria-hidden', 'false');
            });
        });

        const closeImage = function () {
            overlay.classList.remove('active');
            overlay.setAttribute('aria-hidden', 'true');
            modalImage.src = '';
        };

        closeButton.addEventListener('click', closeImage);
        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closeImage();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && overlay.classList.contains('active')) {
                closeImage();
            }
        });
    });
</script>
