<?php
require 'includes/db.php';

try {
    // Update first publication with journal cover
    $stmt1 = $pdo->prepare('UPDATE publications SET featured_image = ? WHERE title = ?');
    $stmt1->execute(['assets/images/publications/jppp-vol4-no1-2025.jpg', 'Strategic Assessment of Evapotranspiration for Wheat Cultivation in Punjab, Pakistan']);
    echo 'Updated: Journal of Public Policy Practitioners cover' . PHP_EOL;
    
    // Update second publication with journal cover
    $stmt2 = $pdo->prepare('UPDATE publications SET featured_image = ? WHERE title = ?');
    $stmt2->execute(['assets/images/publications/agripat-vol1-no1-2025.jpg', 'Classification and Distribution Analysis of Crop Types in Mauza Mustafabad Using GIS: Implications for Agricultural Policy and Land Use']);
    echo 'Updated: Journal of Agricultural Policy and Transformation cover' . PHP_EOL;
    
    echo 'Success! Images added to publications.' . PHP_EOL;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
?>
