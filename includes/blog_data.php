<?php

// Shared categories list
$categories = [
    ['name' => 'All Posts', 'count' => 48, 'icon' => 'article', 'slug' => 'all'],
    ['name' => 'IoT & Sensors', 'count' => 12, 'icon' => 'sensors', 'slug' => 'iot-sensors'],
    ['name' => 'Security & Privacy', 'count' => 9, 'icon' => 'lock', 'slug' => 'security-privacy'],
    ['name' => 'Wireless Networks', 'count' => 7, 'icon' => 'wifi', 'slug' => 'wireless-networks'],
    ['name' => 'Embedded Systems', 'count' => 8, 'icon' => 'memory', 'slug' => 'embedded-systems'],
    ['name' => 'Cloud & Edge Computing', 'count' => 6, 'icon' => 'cloud', 'slug' => 'cloud-edge'],
    ['name' => 'Data Analytics', 'count' => 8, 'icon' => 'bar_chart', 'slug' => 'data-analytics'],
    ['name' => 'AI & Machine Learning', 'count' => 8, 'icon' => 'psychology', 'slug' => 'ai-ml'],
    ['name' => 'GIS & Remote Sensing', 'count' => 7, 'icon' => 'public', 'slug' => 'gis-remote-sensing'],
    ['name' => 'Smart Cities', 'count' => 5, 'icon' => 'location_city', 'slug' => 'smart-cities'],
    ['name' => 'Automation & Control', 'count' => 4, 'icon' => 'precision_manufacturing', 'slug' => 'automation-control'],
    ['name' => 'Projects & Case Studies', 'count' => 6, 'icon' => 'cases', 'slug' => 'projects-case-studies'],
    ['name' => 'Events & Workshops', 'count' => 4, 'icon' => 'calendar_month', 'slug' => 'events-workshops'],
    ['name' => 'Tutorials & Guides', 'count' => 3, 'icon' => 'menu_book', 'slug' => 'tutorials-guides'],
];

// Popular tags
$popularTags = [
    'IoT', 'Sensors', 'Security', 'AI', 'LoRaWAN', 'Edge Computing',
    'Raspberry Pi', 'MQTT', 'Python', 'GIS', 'Remote Sensing',
    'Machine Learning', 'Smart City', 'Data Science'
];

// 48 Total Blog Posts (8 Pages x 6 Posts)
$allBlogPosts = [
    // Page 1 (Exact Mockup Posts)
    [
        'id' => 1,
        'slug' => 'smart-soil-monitoring-system',
        'title' => 'Smart Soil Monitoring System using IoT Sensors',
        'summary' => 'A low-cost IoT-based soil monitoring system for precision agriculture using real-time data.',
        'category' => 'IoT & Sensors',
        'badge_class' => 'badge-iot',
        'date' => 'May 15, 2024',
        'image' => '/assets/images/blogs/blog_smart_soil.jpg',
        'tags' => ['IoT', 'Sensors', 'Smart City', 'Data Science']
    ],
    [
        'id' => 2,
        'slug' => 'securing-iot-devices-challenges-best-practices',
        'title' => 'Securing IoT Devices: Challenges and Best Practices',
        'summary' => 'An overview of security threats in IoT ecosystems and strategies to mitigate risks.',
        'category' => 'Security & Privacy',
        'badge_class' => 'badge-security',
        'date' => 'May 10, 2024',
        'image' => '/assets/images/blogs/blog_securing_iot.jpg',
        'tags' => ['Security', 'IoT', 'Edge Computing']
    ],
    [
        'id' => 3,
        'slug' => 'monitoring-urban-expansion-satellite-data',
        'title' => 'Monitoring Urban Expansion using Multi-temporal Satellite Data',
        'summary' => 'A study on urban growth patterns using time-series satellite imagery and advanced classification techniques.',
        'category' => 'GIS & Remote Sensing',
        'badge_class' => 'badge-gis',
        'date' => 'May 05, 2024',
        'image' => '/assets/images/blogs/blog_satellite_urban.jpg',
        'tags' => ['GIS', 'Remote Sensing', 'Data Science']
    ],
    [
        'id' => 4,
        'slug' => 'lorawan-long-range-iot-applications',
        'title' => 'LoRaWAN for Long-Range IoT Applications',
        'summary' => 'Exploring LoRaWAN architecture, deployment, and use cases for smart infrastructure.',
        'category' => 'Wireless Networks',
        'badge_class' => 'badge-wireless',
        'date' => 'Apr 28, 2024',
        'image' => '/assets/images/blogs/blog_lorawan_iot.jpg',
        'tags' => ['LoRaWAN', 'Wireless Networks', 'IoT']
    ],
    [
        'id' => 5,
        'slug' => 'flood-risk-mapping-machine-learning-gis',
        'title' => 'Flood Risk Mapping using Machine Learning and GIS',
        'summary' => 'Combining GIS data and ML models to predict flood-prone areas and support disaster preparedness.',
        'category' => 'AI & Machine Learning',
        'badge_class' => 'badge-ai',
        'date' => 'Apr 22, 2024',
        'image' => '/assets/images/blogs/blog_flood_mapping.jpg',
        'tags' => ['AI', 'Machine Learning', 'GIS', 'Remote Sensing']
    ],
    [
        'id' => 6,
        'slug' => 'getting-started-with-mqtt-and-python',
        'title' => 'Getting Started with MQTT and Python',
        'summary' => 'A step-by-step guide to build an IoT application using MQTT protocol and Python.',
        'category' => 'Tutorials & Guides',
        'badge_class' => 'badge-tutorial',
        'date' => 'Apr 15, 2024',
        'image' => '/assets/images/blogs/blog_mqtt_python.jpg',
        'tags' => ['MQTT', 'Python', 'IoT', 'Raspberry Pi']
    ],

    // Page 2
    [
        'id' => 7,
        'slug' => 'autonomous-uav-multispectral-surveying',
        'title' => 'Autonomous UAV Multispectral Surveying for Precision Orchards',
        'summary' => 'Deploying automated drone flights to calculate normalized difference vegetation indices across citrus orchards.',
        'category' => 'Projects & Case Studies',
        'badge_class' => 'badge-iot',
        'date' => 'Apr 08, 2024',
        'image' => '/Project_images/crop_library_image.jpg',
        'tags' => ['Remote Sensing', 'Data Science', 'Sensors']
    ],
    [
        'id' => 8,
        'slug' => 'edge-ai-wildfire-early-detection',
        'title' => 'Edge AI for Real-Time Wildfire Early Detection in Forest Corridors',
        'summary' => 'Low-latency computer vision deployed at mountain watchtowers to spot smoke plumes within 30 seconds of ignition.',
        'category' => 'Cloud & Edge Computing',
        'badge_class' => 'badge-ai',
        'date' => 'Mar 30, 2024',
        'image' => '/pics%20folder/Forest_fire_Severity_Murree_Kotli_Map.jpg',
        'tags' => ['AI', 'Edge Computing', 'Machine Learning']
    ],
    [
        'id' => 9,
        'slug' => 'hydrodynamic-surface-runoff-modeling',
        'title' => 'Hydrodynamic Surface Water Runoff Modeling with Sentinel-1 SAR',
        'summary' => 'Leveraging synthetic aperture radar penetrates dense cloud cover to model flash flood inundation pathways.',
        'category' => 'Data Analytics',
        'badge_class' => 'badge-gis',
        'date' => 'Mar 24, 2024',
        'image' => '/pics%20folder/Agriculture_area_under_flood_GDSG_map.jpg',
        'tags' => ['GIS', 'Data Science', 'Remote Sensing']
    ],
    [
        'id' => 10,
        'slug' => 'intelligent-traffic-flow-smart-cities',
        'title' => 'Intelligent Traffic Flow Optimization in Smart Urban Corridors',
        'summary' => 'Deep reinforcement learning agents coordinating metropolitan traffic signal networks in real time.',
        'category' => 'Smart Cities',
        'badge_class' => 'badge-wireless',
        'date' => 'Mar 18, 2024',
        'image' => '/Project_images/HumMuqam_image.jpg',
        'tags' => ['Smart City', 'AI', 'IoT']
    ],
    [
        'id' => 11,
        'slug' => 'automated-plant-anomaly-detection-edge-vision',
        'title' => 'Automated Industrial Plant Anomaly Detection with Edge Vision',
        'summary' => 'Supervised classification pipelines detecting structural micro-cracks and thermal anomalies in manufacturing hubs.',
        'category' => 'Automation & Control',
        'badge_class' => 'badge-security',
        'date' => 'Mar 12, 2024',
        'image' => '/satellite_images/satellite_1.jpg',
        'tags' => ['Machine Learning', 'Edge Computing', 'Sensors']
    ],
    [
        'id' => 12,
        'slug' => 'building-low-power-lora-esp32',
        'title' => 'Building Low-Power Embedded LoRa Nodes with ESP32 and MicroPython',
        'summary' => 'Practical hardware circuit designs achieving deep-sleep power consumption under 15 microamps for telemetry.',
        'category' => 'Embedded Systems',
        'badge_class' => 'badge-tutorial',
        'date' => 'Mar 04, 2024',
        'image' => '/assets/images/blogs/blog_mqtt_python.jpg',
        'tags' => ['Raspberry Pi', 'Python', 'IoT', 'LoRaWAN']
    ],

    // Page 3
    [
        'id' => 13,
        'slug' => 'deep-learning-lulc-classification',
        'title' => 'Deep Learning for Automated Land Use Land Cover (LULC) Classification',
        'summary' => 'Transformer-based spatial segmentation architectures applied to 10-meter resolution European Space Agency imagery.',
        'category' => 'AI & Machine Learning',
        'badge_class' => 'badge-ai',
        'date' => 'Feb 26, 2024',
        'image' => '/satellite_images/satellite_2.jpg',
        'tags' => ['AI', 'Machine Learning', 'GIS']
    ],
    [
        'id' => 14,
        'slug' => 'satellite-evapotranspiration-assessment',
        'title' => 'Satellite Remote Sensing for Regional Evapotranspiration Assessment',
        'summary' => 'Evaluating district-level crop water consumption across agricultural basins using multi-band thermal sensors.',
        'category' => 'GIS & Remote Sensing',
        'badge_class' => 'badge-gis',
        'date' => 'Feb 19, 2024',
        'image' => '/assets/images/blogs/blog_satellite_urban.jpg',
        'tags' => ['GIS', 'Remote Sensing', 'Data Science']
    ],
    [
        'id' => 15,
        'slug' => 'cybersecurity-smart-energy-grids',
        'title' => 'Cybersecurity Protocols for Distributed Energy Smart Grids',
        'summary' => 'Zero-trust cryptographic frameworks safeguarding automated electrical grid sub-stations from malicious tampering.',
        'category' => 'Security & Privacy',
        'badge_class' => 'badge-security',
        'date' => 'Feb 12, 2024',
        'image' => '/assets/images/blogs/blog_securing_iot.jpg',
        'tags' => ['Security', 'Smart City', 'Edge Computing']
    ],
    [
        'id' => 16,
        'slug' => 'atmospheric-smog-spatial-interpolation',
        'title' => 'Atmospheric Smog and Particulate Matter (PM2.5) Spatial Interpolation',
        'summary' => 'Fusing ground-based particulate air quality sensors with MODIS optical depth imagery for smog forecasting.',
        'category' => 'Data Analytics',
        'badge_class' => 'badge-iot',
        'date' => 'Feb 05, 2024',
        'image' => '/Project_images/smog_image.jpg',
        'tags' => ['Data Science', 'Sensors', 'GIS']
    ],
    [
        'id' => 17,
        'slug' => '5g-networks-disaster-telemetry',
        'title' => 'Next-Gen 5G Cellular Networks for Massive Disaster Telemetry',
        'summary' => 'Network slicing strategies designed to guarantee ultra-reliable low-latency emergency communications.',
        'category' => 'Wireless Networks',
        'badge_class' => 'badge-wireless',
        'date' => 'Jan 28, 2024',
        'image' => '/assets/images/blogs/blog_lorawan_iot.jpg',
        'tags' => ['Wireless Networks', 'IoT', 'Smart City']
    ],
    [
        'id' => 18,
        'slug' => 'interactive-geotiff-web-maps-leaflet',
        'title' => 'Hands-on: Building Interactive GeoTIFF Web Maps with Leaflet',
        'summary' => 'Rendering client-side raster imagery dynamically in the browser using WebAssembly and GeoRasterLayer.',
        'category' => 'Tutorials & Guides',
        'badge_class' => 'badge-tutorial',
        'date' => 'Jan 20, 2024',
        'image' => '/assets/images/blogs/blog_flood_mapping.jpg',
        'tags' => ['GIS', 'Python', 'Tutorials']
    ],

    // Page 4
    [
        'id' => 19,
        'slug' => 'embedded-firmware-over-the-air-fota',
        'title' => 'Secure Firmware-Over-The-Air (FOTA) for Remote Environmental Probes',
        'summary' => 'Dual-partition flash memory rollback architectures that safeguard distributed weather sensors during upgrades.',
        'category' => 'Embedded Systems',
        'badge_class' => 'badge-security',
        'date' => 'Jan 14, 2024',
        'image' => '/assets/images/blogs/blog_securing_iot.jpg',
        'tags' => ['Embedded Systems', 'Security', 'IoT']
    ],
    [
        'id' => 20,
        'slug' => 'cloud-native-geospatial-pipelines',
        'title' => 'Cloud-Native Geospatial Pipelines with Cloud-Optimized GeoTIFFs (COG)',
        'summary' => 'Streaming massive raster catalogs directly into serverless lambda workers without downloading whole files.',
        'category' => 'Cloud & Edge Computing',
        'badge_class' => 'badge-ai',
        'date' => 'Jan 07, 2024',
        'image' => '/assets/images/blogs/blog_satellite_urban.jpg',
        'tags' => ['Edge Computing', 'GIS', 'Data Science']
    ],
    [
        'id' => 21,
        'slug' => 'high-precision-gnss-kinematic-positioning',
        'title' => 'High-Precision Real-Time Kinematic (RTK) GNSS for Drone Mapping',
        'summary' => 'Centimeter-level positioning workflows that eliminate the requirement for dense ground control points.',
        'category' => 'GIS & Remote Sensing',
        'badge_class' => 'badge-gis',
        'date' => 'Dec 28, 2023',
        'image' => '/satellite_images/satellite_3.jpg',
        'tags' => ['GIS', 'Remote Sensing', 'Sensors']
    ],
    [
        'id' => 22,
        'slug' => 'urban-heat-island-thermal-infrared',
        'title' => 'Mitigating Urban Heat Islands Using Landsat 8/9 Thermal Infrared Sensors',
        'summary' => 'Spatial correlation between green canopy density, rooftop reflectance, and localized summer surface temperatures.',
        'category' => 'Smart Cities',
        'badge_class' => 'badge-wireless',
        'date' => 'Dec 20, 2023',
        'image' => '/Project_images/HumMuqam_image.jpg',
        'tags' => ['Smart City', 'Remote Sensing', 'GIS']
    ],
    [
        'id' => 23,
        'slug' => 'industrial-pid-scada-automation',
        'title' => 'Next-Gen SCADA and PLC Automation in Water Treatment Facilities',
        'summary' => 'Integrating open-source OPC-UA communication standards with cloud analytics for municipal reservoirs.',
        'category' => 'Automation & Control',
        'badge_class' => 'badge-iot',
        'date' => 'Dec 12, 2023',
        'image' => '/assets/images/blogs/blog_smart_soil.jpg',
        'tags' => ['Automation', 'Sensors', 'IoT']
    ],
    [
        'id' => 24,
        'slug' => 'geoai-symposium-2023-highlights',
        'title' => 'Annual GeoAI Research Symposium 2023: Keynote Highlights & Takeaways',
        'summary' => 'A comprehensive review of international breakthroughs in Earth Observation and geospatial foundation models.',
        'category' => 'Events & Workshops',
        'badge_class' => 'badge-tutorial',
        'date' => 'Dec 05, 2023',
        'image' => '/pics%20folder/Earth_day_Founder_Maria_Seminar.jpg',
        'tags' => ['Events', 'AI', 'GIS']
    ],

    // Page 5
    [
        'id' => 25,
        'slug' => 'iot-water-table-salinity-monitoring',
        'title' => 'IoT Water Table and Salinity Monitoring in Irrigated Plains',
        'summary' => 'Subsurface ultrasonic level transducers reporting soil salinization trends to prevent farmland degradation.',
        'category' => 'IoT & Sensors',
        'badge_class' => 'badge-iot',
        'date' => 'Nov 28, 2023',
        'image' => '/pics%20folder/Agriculture_area_under_flood_GDSG_map.jpg',
        'tags' => ['IoT', 'Sensors', 'Data Science']
    ],
    [
        'id' => 26,
        'slug' => 'cryptographic-authenticity-satellite-imagery',
        'title' => 'Cryptographic Provenance for Deepfake-Resistant Satellite Imagery',
        'summary' => 'Embedding hardware-signed metadata into orbital sensor streams to verify authenticity before judicial ingestion.',
        'category' => 'Security & Privacy',
        'badge_class' => 'badge-security',
        'date' => 'Nov 20, 2023',
        'image' => '/assets/images/blogs/blog_securing_iot.jpg',
        'tags' => ['Security', 'Remote Sensing', 'AI']
    ],
    [
        'id' => 27,
        'slug' => 'ble-mesh-underground-tunnel-telemetry',
        'title' => 'Bluetooth Low Energy (BLE) Mesh Networks in Deep Subterranean Tunnels',
        'summary' => 'Multi-hop wireless propagation experiments ensuring unbroken communication for underground utility workers.',
        'category' => 'Wireless Networks',
        'badge_class' => 'badge-wireless',
        'date' => 'Nov 12, 2023',
        'image' => '/assets/images/blogs/blog_lorawan_iot.jpg',
        'tags' => ['Wireless Networks', 'IoT', 'Sensors']
    ],
    [
        'id' => 28,
        'slug' => 'fpga-accelerated-edge-inference',
        'title' => 'FPGA-Accelerated Edge Inference for Autonomous Agricultural Harvesters',
        'summary' => 'Real-time weed and crop segmentation running at 60 FPS using ultra-efficient quantized binary neural networks.',
        'category' => 'Embedded Systems',
        'badge_class' => 'badge-iot',
        'date' => 'Nov 04, 2023',
        'image' => '/Project_images/crop_library_image.jpg',
        'tags' => ['Embedded Systems', 'Machine Learning', 'AI']
    ],
    [
        'id' => 29,
        'slug' => 'serverless-geocoding-spatial-indexes',
        'title' => 'High-Throughput Reverse Geocoding with Uber H3 Spatial Indexes',
        'summary' => 'Partitioning global geospatial geometries into discrete hexagonal hierarchical cells for sub-millisecond querying.',
        'category' => 'Data Analytics',
        'badge_class' => 'badge-gis',
        'date' => 'Oct 28, 2023',
        'image' => '/assets/images/blogs/blog_flood_mapping.jpg',
        'tags' => ['Data Analytics', 'GIS', 'Python']
    ],
    [
        'id' => 30,
        'slug' => 'graph-neural-networks-river-networks',
        'title' => 'Graph Neural Networks for Contaminant Dispersion in River Basins',
        'summary' => 'Modeling non-Euclidean fluvial hydrodynamics to predict industrial effluent migration downstream.',
        'category' => 'AI & Machine Learning',
        'badge_class' => 'badge-ai',
        'date' => 'Oct 20, 2023',
        'image' => '/satellite_images/satellite_1.jpg',
        'tags' => ['AI', 'Data Science', 'Machine Learning']
    ],

    // Page 6
    [
        'id' => 31,
        'slug' => 'radar-interferometry-bridge-deflection',
        'title' => 'Persistent Scatterer Radar Interferometry for Highway Bridge Health',
        'summary' => 'Millimeter-scale structural deformation time-series retrieved from Sentinel-1 radar backscatter.',
        'category' => 'GIS & Remote Sensing',
        'badge_class' => 'badge-gis',
        'date' => 'Oct 12, 2023',
        'image' => '/assets/images/blogs/blog_satellite_urban.jpg',
        'tags' => ['Remote Sensing', 'GIS', 'Smart City']
    ],
    [
        'id' => 32,
        'slug' => 'smart-waste-management-ultrasonic-fill-sensors',
        'title' => 'Dynamic Route Planning for Municipal Waste Fleet via Ultrasonic Sensors',
        'summary' => 'Automated routing algorithms saving 31% fleet fuel by prioritizing bins reaching critical volumetric capacity.',
        'category' => 'Smart Cities',
        'badge_class' => 'badge-wireless',
        'date' => 'Oct 04, 2023',
        'image' => '/Project_images/HumMuqam_image.jpg',
        'tags' => ['Smart City', 'IoT', 'Sensors']
    ],
    [
        'id' => 33,
        'slug' => 'greenhouse-microclimate-pid-actuation',
        'title' => 'Closed-Loop PID Climate Actuation in Hydroponic Greenhouses',
        'summary' => 'Regulating vapor pressure deficits (VPD) through intelligent misting and vent control to boost strawberry yields.',
        'category' => 'Automation & Control',
        'badge_class' => 'badge-iot',
        'date' => 'Sep 26, 2023',
        'image' => '/assets/images/blogs/blog_smart_soil.jpg',
        'tags' => ['Automation', 'IoT', 'Sensors']
    ],
    [
        'id' => 34,
        'slug' => 'pakistan-air-force-flood-rescue-case-study',
        'title' => 'Case Study: Real-Time Flood Rescue Inundation Mapping for Civil Defense',
        'summary' => 'Rapid turnaround optical satellite mapping delivering emergency dry landing zone coordinates to rescue pilots.',
        'category' => 'Projects & Case Studies',
        'badge_class' => 'badge-gis',
        'date' => 'Sep 18, 2023',
        'image' => '/pics%20folder/Agriculture_area_under_flood_GDSG_map.jpg',
        'tags' => ['Projects', 'GIS', 'Remote Sensing']
    ],
    [
        'id' => 35,
        'slug' => 'hands-on-spatial-sql-postgis-tutorial',
        'title' => 'Advanced Spatial Queries with PostGIS and PostgreSQL: A Developer Guide',
        'summary' => 'Mastering ST_DWithin, ST_Intersection, and spatial indexing to optimize geodatabase performance.',
        'category' => 'Tutorials & Guides',
        'badge_class' => 'badge-tutorial',
        'date' => 'Sep 10, 2023',
        'image' => '/assets/images/blogs/blog_mqtt_python.jpg',
        'tags' => ['Tutorials', 'Python', 'GIS']
    ],
    [
        'id' => 36,
        'slug' => 'lidar-point-cloud-forestry-canopy-estimation',
        'title' => 'Airborne LiDAR Point Clouds for Forest Aboveground Biomass Estimation',
        'summary' => 'Extracting individual tree canopy height profiles and stem volumes using voxel-based spatial filtering.',
        'category' => 'GIS & Remote Sensing',
        'badge_class' => 'badge-gis',
        'date' => 'Sep 02, 2023',
        'image' => '/pics%20folder/Forest_fire_Severity_Murree_Kotli_Map.jpg',
        'tags' => ['Remote Sensing', 'Data Science', 'GIS']
    ],

    // Page 7
    [
        'id' => 37,
        'slug' => 'optical-gas-imaging-methane-emission-sensors',
        'title' => 'Methane Plume Detection with Satellite Optical Gas Imaging Sensors',
        'summary' => 'Quantifying fugitive greenhouse gas emissions from fossil fuel infrastructure with PRISMA hyperspectral data.',
        'category' => 'IoT & Sensors',
        'badge_class' => 'badge-iot',
        'date' => 'Aug 25, 2023',
        'image' => '/Project_images/smog_image.jpg',
        'tags' => ['Sensors', 'Remote Sensing', 'Data Science']
    ],
    [
        'id' => 38,
        'slug' => 'quantum-resistant-pki-iot-fleets',
        'title' => 'Lattice-Based Post-Quantum Cryptography for Long-Lived IoT Fleets',
        'summary' => 'Preparing remote field telemetry nodes for post-RSA security using CRYSTALS-Kyber key encapsulation.',
        'category' => 'Security & Privacy',
        'badge_class' => 'badge-security',
        'date' => 'Aug 17, 2023',
        'image' => '/assets/images/blogs/blog_securing_iot.jpg',
        'tags' => ['Security', 'IoT', 'Edge Computing']
    ],
    [
        'id' => 39,
        'slug' => 'satellite-iot-direct-to-orbit-lora',
        'title' => 'Direct-to-Satellite LoRa (LR-FHSS) for Remote Marine Buoys',
        'summary' => 'Long-Range Frequency Hopping Spread Spectrum allowing transceivers to beam telemetry straight to LEO satellites.',
        'category' => 'Wireless Networks',
        'badge_class' => 'badge-wireless',
        'date' => 'Aug 09, 2023',
        'image' => '/assets/images/blogs/blog_lorawan_iot.jpg',
        'tags' => ['LoRaWAN', 'Wireless Networks', 'Remote Sensing']
    ],
    [
        'id' => 40,
        'slug' => 'arm-cortex-m55-tiny-ml-vibration-monitoring',
        'title' => 'TinyML Anomaly Audio & Vibration Classification on ARM Cortex-M55',
        'summary' => 'Running inference in under 8ms with TensorFlow Lite for Microcontrollers on edge machinery.',
        'category' => 'Embedded Systems',
        'badge_class' => 'badge-iot',
        'date' => 'Aug 01, 2023',
        'image' => '/assets/images/blogs/blog_mqtt_python.jpg',
        'tags' => ['Embedded Systems', 'AI', 'Sensors']
    ],
    [
        'id' => 41,
        'slug' => 'geospatial-vector-tiles-mapbox-deckgl',
        'title' => 'Streaming 10 Million Moving Spatial Features with Deck.gl and WebGL',
        'summary' => 'GPU-accelerated vector tile visualization techniques for real-time maritime vessel traffic analysis.',
        'category' => 'Data Analytics',
        'badge_class' => 'badge-gis',
        'date' => 'Jul 24, 2023',
        'image' => '/assets/images/blogs/blog_satellite_urban.jpg',
        'tags' => ['Data Analytics', 'GIS', 'Python']
    ],
    [
        'id' => 42,
        'slug' => 'physics-informed-neural-networks-groundwater',
        'title' => 'Physics-Informed Neural Networks (PINNs) for Aquifer Depletion',
        'summary' => 'Constraining deep learning loss functions with Darcy groundwater flow differential equations.',
        'category' => 'AI & Machine Learning',
        'badge_class' => 'badge-ai',
        'date' => 'Jul 16, 2023',
        'image' => '/assets/images/blogs/blog_flood_mapping.jpg',
        'tags' => ['AI', 'Machine Learning', 'Data Science']
    ],

    // Page 8
    [
        'id' => 43,
        'slug' => 'sentinel-2-crop-health-monitoring',
        'title' => 'District-Level Wheat Crop Health Surveillance Using Sentinel-2 Data',
        'summary' => 'Time-series vegetative indices identifying moisture stress and fertilizer deficiencies before visible wilting.',
        'category' => 'GIS & Remote Sensing',
        'badge_class' => 'badge-gis',
        'date' => 'Jul 08, 2023',
        'image' => '/Project_images/crop_library_image.jpg',
        'tags' => ['GIS', 'Remote Sensing', 'Data Science']
    ],
    [
        'id' => 44,
        'slug' => 'smart-city-ev-charging-infrastructure-planning',
        'title' => 'Spatial Multi-Criteria Evaluation for Metropolitan EV Charging Stations',
        'summary' => 'Analytic Hierarchy Process (AHP) optimizing EV charger geographic placement based on electrical feeder limits.',
        'category' => 'Smart Cities',
        'badge_class' => 'badge-wireless',
        'date' => 'Jun 30, 2023',
        'image' => '/Project_images/HumMuqam_image.jpg',
        'tags' => ['Smart City', 'GIS', 'Data Science']
    ],
    [
        'id' => 45,
        'slug' => 'can-bus-telematics-automated-fleet',
        'title' => 'CAN Bus Reverse Engineering for Heavy Agrarian Fleet Telematics',
        'summary' => 'Reading J1939 tractor diagnostic trouble codes over LoRaWAN to predict hydraulic failures in the field.',
        'category' => 'Automation & Control',
        'badge_class' => 'badge-iot',
        'date' => 'Jun 22, 2023',
        'image' => '/assets/images/blogs/blog_smart_soil.jpg',
        'tags' => ['Automation', 'IoT', 'Sensors']
    ],
    [
        'id' => 46,
        'slug' => 'smog-prediction-pakistan-ai-initiative',
        'title' => 'The National Smog Early Warning Initiative: Lessons from Punjab',
        'summary' => 'Synthesizing satellite aerosol observations and numerical weather models to provide 5-day civic health alerts.',
        'category' => 'Projects & Case Studies',
        'badge_class' => 'badge-gis',
        'date' => 'Jun 14, 2023',
        'image' => '/Project_images/smog_image.jpg',
        'tags' => ['Projects', 'AI', 'Data Science']
    ],
    [
        'id' => 47,
        'slug' => 'geospatial-ai-bootcamp-workshop',
        'title' => 'GDSG Winter Intensive: Hands-On Machine Learning for Earth Observation',
        'summary' => 'A comprehensive 5-day hands-on boot camp guiding researchers from raw raster ingestion to U-Net training.',
        'category' => 'Events & Workshops',
        'badge_class' => 'badge-tutorial',
        'date' => 'Jun 06, 2023',
        'image' => '/pics%20folder/Earth_day_Founder_Maria_Seminar.jpg',
        'tags' => ['Events', 'Workshops', 'AI']
    ],
    [
        'id' => 48,
        'slug' => 'getting-started-with-google-earth-engine-python',
        'title' => 'Mastering Google Earth Engine with the Python API and Geemap',
        'summary' => 'Step-by-step developer guide on cloud computing, asset management, and geospatial visualizations with geemap.',
        'category' => 'Tutorials & Guides',
        'badge_class' => 'badge-tutorial',
        'date' => 'May 28, 2023',
        'image' => '/assets/images/blogs/blog_mqtt_python.jpg',
        'tags' => ['Tutorials', 'Python', 'GIS', 'Remote Sensing']
    ]
];
