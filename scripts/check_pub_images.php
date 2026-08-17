<?php
require 'includes/db.php';

echo "Checking all publications in database:\n";
$stmt = $pdo->query('SELECT id, title, featured_image FROM publications');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {
    echo "ID: " . $row['id'] . "\n";
    echo "Title: " . substr($row['title'], 0, 60) . "...\n";
    echo "Featured Image: " . ($row['featured_image'] ?: 'EMPTY') . "\n";
    echo "---\n";
}
?>
