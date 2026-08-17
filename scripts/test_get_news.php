<?php
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/components.php';
$items = get_news_items($pdo, 5);
foreach ($items as $it) {
    echo ($it['id']??'') . ' | ' . ($it['title']??'') . ' | ' . ($it['featured_image']??'NULL') . "\n";
}
