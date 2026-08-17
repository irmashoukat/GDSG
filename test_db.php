<?php

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=gdsg;charset=utf8mb4',
        'root',
        'root'
    );

    echo "DATABASE CONNECTION OK";
} catch (PDOException $e) {
    echo "DATABASE CONNECTION FAILED: " . $e->getMessage();
}