<?php
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/components.php';
require __DIR__ . '/../includes/project_model.php';
$projects = get_projects($pdo, 12);
if (empty($projects)) { echo "no projects\n"; exit; }
$proj = $projects[0];
$images = get_project_images($proj['id']);
$firstImage = !empty($images) ? asset_url($images[0]['image_url']) : null;
$slugClass = preg_replace('/[^a-z0-9\-]/', '', strtolower($proj['slug'] ?? 'project'));

echo "Card anchor HTML:\n";
$bgStyle = $firstImage ? ('style="background-image: url(' . htmlspecialchars($firstImage) . '); background-size: cover; background-position: center;"') : '';
echo "<a href=\"project_detail.php?id={$proj['id']}\" class=\"project-card__media project-card__media--{$slugClass}\" {$bgStyle}>...<\/a>\n";

echo "Detail image HTML:\n";
foreach ($images as $img) {
    echo '<img src="' . asset_url($img['image_url']) . '" alt="' . htmlspecialchars($img['caption'] ?? '') . '">\n';
}
