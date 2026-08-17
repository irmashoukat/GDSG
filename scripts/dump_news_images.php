<?php
require __DIR__ . '/../includes/db.php';
if (!$pdo) {
    echo "NO_PDO\n";
    exit(1);
}
try {
    $stmt = $pdo->query('SELECT id, title, featured_image FROM news');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) {
        echo "NO_ROWS\n";
    }
    foreach ($rows as $r) {
        echo ($r['id'] ?? '') . " | " . ($r['title'] ?? '') . " | " . ($r['featured_image'] ?? 'NULL') . "\n";
    }
} catch (Exception $e) {
    echo 'ERR: ' . $e->getMessage() . "\n";
}
