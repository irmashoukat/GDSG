<?php

$config = require 'includes/config.php';

echo "Testing database connection...\n";
echo "Host: " . $config['db']['host'] . "\n";
echo "Database: " . $config['db']['name'] . "\n";
echo "User: " . $config['db']['user'] . "\n";

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', 
        $config['db']['host'], 
        $config['db']['name'], 
        $config['db']['charset']
    );
    echo "DSN: $dsn\n";
    
    $pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass']);
    echo "✓ MySQL connection SUCCESS!\n";
    
    // Test a query
    $result = $pdo->query("SELECT COUNT(*) as count FROM projects");
    $row = $result->fetch();
    echo "Projects table has " . $row['count'] . " rows\n";
    
} catch (PDOException $e) {
    echo "✗ MySQL connection FAILED:\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
}
