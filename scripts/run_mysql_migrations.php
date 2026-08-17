<?php
// Run MySQL schema and seed using includes/config.php DB settings
require __DIR__ . '/../includes/config.php';

$config = require __DIR__ . '/../includes/config.php';
$dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['db']['host'], $config['db']['name'], $config['db']['charset']);
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $options);
    echo "Connected to MySQL successfully.\n";
} catch (PDOException $e) {
    echo "MySQL connection failed: " . $e->getMessage() . PHP_EOL;
    exit(1);
}

$schemaFile = __DIR__ . '/../database/schema.sql';
$seedFile = __DIR__ . '/../database/seed.sql';

if (file_exists($schemaFile)) {
    echo "Applying schema from database/schema.sql...\n";
    $sql = file_get_contents($schemaFile);
    try {
        // Temporarily disable foreign key checks to avoid ordering issues
        $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
        $pdo->exec($sql);
        $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
        echo "Schema applied.\n";
    } catch (PDOException $e) {
        // Attempt to re-enable FK checks in case of failure
        try { $pdo->exec('SET FOREIGN_KEY_CHECKS = 1'); } catch (Exception $_) {}
        echo "Schema execution error: " . $e->getMessage() . PHP_EOL;
    }
} else {
    echo "Schema file not found: $schemaFile\n";
}

if (file_exists($seedFile)) {
    echo "Applying seed from database/seed.sql...\n";
    $seed = file_get_contents($seedFile);
    try {
        $pdo->exec($seed);
        echo "Seed applied.\n";
    } catch (PDOException $e) {
        echo "Seed execution error: " . $e->getMessage() . PHP_EOL;
    }
} else {
    echo "Seed file not found: $seedFile\n";
}

// Insert minimal sample data for admin testing if absent
try {
    $res = $pdo->query('SELECT COUNT(*) AS c FROM publications');
    $count = (int)$res->fetchColumn();
    if ($count === 0) {
        $pdo->exec("INSERT INTO publications (title, authors, journal, year, summary) VALUES ('Sample Publication', 'A. Researcher', 'Geo Journal', 2024, 'Sample summary')");
        echo "Inserted sample publication.\n";
    }
} catch (Exception $e) {
    // ignore
}

try {
    $res = $pdo->query('SELECT COUNT(*) AS c FROM partners');
    $count = (int)$res->fetchColumn();
    if ($count === 0) {
        $pdo->exec("INSERT INTO partners (name, website, description) VALUES ('Academic Partner','https://example.edu','University collaboration for GeoAI research.')");
        echo "Inserted sample partner.\n";
    }
} catch (Exception $e) {
    // ignore
}

echo "Done.\n";
