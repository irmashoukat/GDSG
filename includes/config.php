<?php

// Site configuration
return [
    'site_name' => 'Geospatial Data Science Group',
    'site_description' => 'GDSG is a research institute focused on GIS, GeoAI, remote sensing, spatial analytics, and Earth observation.',
    'site_url' => 'http://localhost',
    'meta_author' => 'Geospatial Data Science Group',
    'admin' => [
        // Local admin placeholder credentials — replace before deploying to production.
        'email' => 'admin@gdsg.org',
        'password' => 'admin123',
    ],
    'base_url' => '/',
    'db' => [
        'host' => 'localhost',
        'name' => 'gdsg',
        'user' => 'root',
        'pass' => 'root',
        'charset' => 'utf8mb4',
    ],
];
