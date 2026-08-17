<?php
require 'includes/db.php';

try {
    $stmt = $pdo->prepare('UPDATE publications SET featured_image = ? WHERE title = ?');
    $stmt->execute(['assets/images/publications/agripat-vol1-no1-2025.jpg', 'Classification and Distribution Analysis of Crop Types in Mauza Mustafabad Using GIS: Implications for Agricultural Policy and Land Use']);
    echo "Restored! Second publication now has the Journal of Agricultural Policy and Transformation (green) cover.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
