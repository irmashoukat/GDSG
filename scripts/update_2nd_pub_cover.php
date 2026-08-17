<?php
require 'includes/db.php';

try {
    $stmt = $pdo->prepare('UPDATE publications SET featured_image = ? WHERE title = ?');
    $stmt->execute(['assets/images/publications/jppp-vol4-no1-2025.jpg', 'Classification and Distribution Analysis of Crop Types in Mauza Mustafabad Using GIS: Implications for Agricultural Policy and Land Use']);
    echo "Updated! Second publication now uses the Journal of Public Policy Practitioners cover.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
