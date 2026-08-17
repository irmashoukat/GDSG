<?php
require 'includes/db.php';

try {
    $stmt = $pdo->prepare('DELETE FROM publications WHERE title = ?');
    $stmt->execute(['Sample Publication']);
    echo "Sample publication removed successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
