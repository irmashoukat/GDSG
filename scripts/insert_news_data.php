<?php
require __DIR__ . '/../includes/db.php';

try {
    // Check if data already exists
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM news WHERE id IN (1, 2)');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        echo "News data already exists. Skipping insertion.\n";
        exit;
    }
    
    // Insert news data
    $sql = "INSERT INTO news (id, title, category, summary, content, featured_image, published_at, created_at) VALUES
    (1, 'New GeoAI collaboration announced', 'News', 'GDSG partners with academic institutions to accelerate climate analytics research.', 'We are excited to announce a groundbreaking collaboration between the Geospatial Data Science Group (GDSG) and leading academic institutions worldwide. This partnership focuses on advancing GeoAI technologies for climate analytics and environmental monitoring.\n\nKey highlights of this collaboration:\n\n• Joint Research Initiatives: Combined expertise in geospatial analysis, AI, and climate science\n• Open Data Sharing: Access to satellite imagery and environmental datasets\n• Student Exchange Programs: Opportunities for graduate students and researchers\n• Conference Partnerships: Co-hosting international conferences on GeoAI and Earth observation\n• Funding Opportunities: Joint grants for collaborative research projects\n\nThis collaboration marks a significant milestone in our commitment to addressing global climate challenges through innovative geospatial technology and artificial intelligence.', 'assets/images/World_environment_day_GDSG_Post.jpg', '2024-01-15', NOW()),
    (2, 'Workshop on Earth Observation analytics', 'Event', 'A hands-on workshop covering remote sensing, data fusion, and spatial modeling.', 'Join us for an intensive workshop on Earth Observation Analytics! This comprehensive training program is designed for geospatial professionals, researchers, and students who want to master advanced remote sensing and spatial analysis techniques.\n\nWorkshop Details:\nDate: February 20-22, 2024\nLocation: GDSG Research Center\nDuration: 3 days (8 hours per day)\nParticipants: Maximum 50\n\nCourse Curriculum:\nDay 1: Fundamentals of Remote Sensing and Satellite Imagery\n• Introduction to satellite platforms and sensors\n• Understanding spectral bands and their applications\n• Hands-on: Image preprocessing and radiometric corrections\n\nDay 2: Advanced Data Fusion and Image Classification\n• Multi-sensor data integration techniques\n• Machine learning for image classification\n• Change detection methods\n\nDay 3: Practical Applications and Spatial Modeling\n• Real-world case studies\n• Building spatial models for environmental monitoring\n• Interactive projects with participants\n\nInstructor: Dr. Maria Silva, Lead Remote Sensing Scientist\nRegistration: Early bird discount available until January 31, 2024\nCost: $299 for professionals, $149 for students', 'assets/images/Earth_day_Founder_Maria_Seminar.jpg', '2024-01-10', NOW())";
    
    $pdo->exec($sql);
    echo "✅ News data inserted successfully!\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
