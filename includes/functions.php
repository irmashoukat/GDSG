<?php

function get_page_title($title = '')
{
    return $title ? $title . ' | Geospatial Data Science Group' : 'Geospatial Data Science Group';
}

function get_meta_description($description = '')
{
    return $description ?: 'GDSG is a research institute focused on GIS, GeoAI, remote sensing, spatial analytics, and Earth observation.';
}

function render_section_title($title, $subtitle = '')
{
    ob_start();
    ?>
    <div class="section-title">
        <h2 class="display-6"><?php echo htmlspecialchars($title); ?></h2>
        <?php if ($subtitle): ?>
            <p class="text-muted mb-0"><?php echo htmlspecialchars($subtitle); ?></p>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}

function asset_url($path)
{
    $config = require __DIR__ . '/config.php';
    $normalizedPath = ltrim($path, '/');

    if (!empty($config['base_url'])) {
        return rtrim($config['base_url'], '/') . '/' . $normalizedPath;
    }

    if (!empty($config['site_url'])) {
        return rtrim($config['site_url'], '/') . '/' . $normalizedPath;
    }

    return '/' . $normalizedPath;
}

function get_technology_description($tech_name)
{
    $descriptions = [
        'Spatial databases' => 'Organize and manage large geographic datasets with efficient spatial indexing and querying capabilities.',
        'Web scraping' => 'Automatically extract and collect agricultural data from online sources and repositories.',
        'Knowledge graphs' => 'Structure crop varieties, growing conditions, risks, and recommendations into interconnected knowledge networks.',
        'GIS operations' => 'Perform advanced geographic information system operations for spatial analysis and visualization.',
        'GIS' => 'Geographic Information System for mapping, analyzing, and visualizing geospatial data.',
        'CNN' => 'Convolutional Neural Networks learn spatial patterns in pollution and environmental data for accurate forecasting.',
        'LSTM' => 'Long Short-Term Memory networks capture temporal dependencies in air quality time series data.',
        'LSTM-CNN' => 'Combines LSTM sequence learning with CNN spatial feature extraction for enhanced AQI prediction.',
        'Remote Sensing' => 'Collect and analyze satellite and aerial imagery for monitoring environmental conditions.',
        'PostGIS' => 'PostgreSQL extension providing advanced spatial database capabilities for large-scale geographic data.',
        'PostgreSQL' => 'Robust relational database system managing structured project data and spatial relationships.',
        'Spatial Analysis' => 'Perform statistical and computational analysis on geographic data to uncover patterns and insights.',
        'Spatial joins' => 'Connect addresses and coordinates to administrative boundaries and hierarchical grid levels.',
        'D-Code' => 'Unique digital location identifier assigned to addresses within the hierarchical geospatial grid.',
        'APIs' => 'Application Programming Interfaces delivering processed data and model outputs to the frontend.',
        'Remote sensing' => 'Satellite-based monitoring of environmental and urban conditions for analysis and forecasting.',
        'GeoAI' => 'Combine artificial intelligence with geospatial analysis for intelligent spatial decision-making.',
        'ML' => 'Machine Learning algorithms that learn patterns from data to make predictions and automate decisions.',
        'Cloud Computing' => 'Scalable cloud infrastructure for processing large geospatial datasets and running intensive AI/ML models.',
        'GTFS' => 'General Transit Feed Specification format for standardizing and sharing public transportation data.',
        'Transit Data' => 'Structured information about transportation routes, schedules, and stations for journey planning systems.',
        'Web Services' => 'RESTful and web-based APIs providing accessible geospatial and service data to applications.',
        'Environmental Intelligence' => 'Integration of environmental data, monitoring systems, and analytics for informed decision-making.',
        'Forecasting' => 'Predictive modeling techniques for anticipating environmental, agricultural, or urban conditions.',
        'Hierarchical Addressing' => 'Multi-level digital addressing system organizing locations from continental to household level.',
        'Web Technology' => 'Frontend and backend web frameworks enabling interactive mapping and data visualization.',
        'Spatial Database' => 'Database systems optimized for storing and querying geographic and spatial information.',
        'Image Processing' => 'Computational techniques for enhancing, analyzing, and extracting features from satellite and aerial imagery.',
        'BOINC' => 'Berkeley Open Infrastructure for Network Computing enabling distributed processing across multiple computers.',
        'Suitability Analysis' => 'Multi-criteria evaluation to identify optimal locations for agricultural, environmental, or development activities.',
        'Agricultural Knowledge' => 'Structured information on crops, farming practices, climate requirements, and agricultural best practices.',
        'Geofencing' => 'Location-based technology triggering actions when users or assets enter or exit defined geographic areas.',
        'Mobile Technology' => 'Applications and services deployed on mobile devices for field operations and real-time data collection.',
        'Agricultural Systems' => 'Comprehensive technology platforms supporting farming operations, extension services, and field management.',
        'Image Classification' => 'Machine learning techniques for categorizing pixels in satellite imagery into predefined land cover or crop types.',
        'SAR' => 'Synthetic Aperture Radar technology for imaging Earth surface through clouds and darkness for flood and weather monitoring.',
        'Flood Monitoring' => 'Real-time systems detecting and tracking flood extent using satellite data and hydrological models.',
        'Dashboarding' => 'Interactive visual interfaces presenting key metrics, maps, and analytics for decision-makers.',
        'Change Detection' => 'Analyzing multi-temporal satellite imagery to identify and map environmental changes over time.',
        'Public Health' => 'Geospatial analytics supporting vaccination, disease surveillance, health facility mapping, and emergency response.',
        'Decision Support' => 'Integrated systems combining data, analytics, and visualizations to support policy and operational decisions.',
        'Spatial Data' => 'Geographic information organized in formats enabling spatial queries, analysis, and visualization.',
        'Vaccination Planning' => 'Geographic tools optimizing vaccination campaign planning and target population identification.',
        'Hotspot Analysis' => 'Statistical and spatial methods identifying clusters of high-risk or high-priority areas.',
        'Dashboard' => 'Real-time monitoring interface displaying key performance indicators and spatial analytics.',
        'Mobile Application' => 'Software application for smartphones and tablets enabling field teams to collect and access spatial data.',
        'Location Services' => 'Services utilizing GPS, mapping, and geofencing to provide location-based functionality and navigation.',
        'Administrative Boundaries' => 'Digital geographic layers representing political and administrative divisions for government and planning operations.',
        'Social Programs' => 'Geospatial targeting and monitoring of social development, welfare, and assistance programs.',
        'Research Methods' => 'Rigorous scientific approaches including surveys, fieldwork, and statistical analysis for validating results.',
        'Web GIS' => 'Browser-based geographic information systems providing interactive mapping and spatial analysis capabilities.',
        'Property Mapping' => 'Digitizing and spatially representing property parcels, boundaries, and related cadastral information.',
        'Carto' => 'Cloud-based platform for creating interactive web maps and geospatial data visualization.',
        'Map Servers' => 'Software infrastructure serving map tiles, layers, and geographic data to web and mobile applications.',
        'MBTiles' => 'Compact tile-based format for efficiently storing and serving pre-rendered map tiles offline or online.',
        'Land Management' => 'Systems for monitoring, planning, and administering land resources and usage across regions.'
    ];

    $trimmed_name = trim($tech_name);
    return $descriptions[$trimmed_name] ?? '';
}
