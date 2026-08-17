-- Seed research areas with proper content
INSERT INTO research_areas (title, slug, summary, content, created_at, updated_at) VALUES 
('GeoAI, Spatial Data & Decision Support', 'geoai-spatial-data', 'Combine PostgreSQL/PostGIS, spatial joins, APIs, coordinate transformations, data engineering, visualization, automation, machine learning, and environmental or agricultural datasets into usable decision-support platforms.', 'GeoAI research combines geospatial intelligence with artificial intelligence to create powerful decision-support systems. We leverage PostGIS for spatial databases, perform advanced spatial joins and transformations, and integrate machine learning models with environmental and agricultural datasets.', NOW(), NOW()),
('Environmental Intelligence & Air Quality', 'environmental-intelligence', 'Monitor smog and pollution across Punjab through district-level AQI maps, source-contribution analysis, historical comparisons, and CNN/LSTM-CNN forecasts for 7-day, 14-day, and 21-day horizons.', 'We monitor air quality through advanced remote sensing and ground-based measurements. Our CNN/LSTM models provide accurate forecasts for pollution episodes, helping government agencies and communities make informed decisions about air quality management.', NOW(), NOW()),
('Hierarchical Geospatial Addressing', 'hierarchical-geospatial', 'Build precise digital location infrastructure through HumMuqaam\'s L0-to-L6 hierarchy, administrative boundaries, spatial grids, point-in-polygon analysis, and unique D-Code assignment.', 'Hierarchical geospatial addressing creates a unified framework for location identification. The HumMuqaam system provides multiple levels of geographic hierarchy from continental to household level, enabling precise targeting and spatial analysis.', NOW(), NOW()),
('Agricultural Knowledge Systems', 'agricultural-knowledge', 'Develop structured crop intelligence covering varieties, seasons, soil, climate, irrigation, fertilizer, diseases, pests, treatments, growth stages, and yield information for data-driven agriculture.', 'Our agricultural knowledge systems integrate diverse datasets including climate, soil properties, crop varieties, and pest/disease information. This structured knowledge enables precision agriculture recommendations and helps farmers optimize yields.', NOW(), NOW());

INSERT INTO projects (title, slug, summary, objectives, technologies, research_area_id, status, created_at, updated_at) VALUES (
    'Urban Heat Island Mitigation Modeling',
    'urban-heat-island-mitigation',
    'Applying spatiotemporal deep learning to urban cooling strategies',
    'Model urban temperature dynamics; Identify vulnerable zones; Recommend interventions',
    'Remote sensing, GeoAI, ML',
    1,
    'ongoing',
    NOW(), NOW()
);
