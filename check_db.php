<?php
require __DIR__ . '/includes/db.php';

echo ($pdo ? 'PDO_OK' : 'NO_PDO') . PHP_EOL;
echo file_exists(__DIR__ . '/database/gdsg.sqlite') ? 'SQLITE_EXISTS' . PHP_EOL : 'NO_SQLITE' . PHP_EOL;

// show a couple of rows if possible
if ($pdo) {
    try {
        $stmt = $pdo->query('SELECT id, title FROM publications LIMIT 5');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo 'PUBLICATIONS:' . PHP_EOL;
        var_export($rows);
        echo PHP_EOL;
    } catch (Exception $e) {
        echo 'SELECT_FAILED: ' . $e->getMessage() . PHP_EOL;
    }
}
