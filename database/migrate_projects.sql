-- Migration: Add 19 new projects from Word document
-- This script adds 19 new projects to the database
-- The 3 old hardcoded projects will be removed from projects.php template

INSERT INTO projects (title, slug, summary, objectives, technologies, research_area_id, status, created_at, updated_at) VALUES
INSERT INTO projects (title, slug, summary, objectives, technologies, research_area_id, status, created_at, updated_at) VALUES 

('GREEN AI Project at NASTP / Pakistan Air Force', 'green-ai-nastp-pak-air-force',
'Developed and operationalised the AgriVerse & Green-AI ecosystem using artificial intelligence, multispectral imagery, geospatial sensors and cloud-native processing.',
'Supported precision agriculture through data processing, visualisation and real-time geospatial intelligence.',
'GeoAI, Remote Sensing, ML, Cloud Computing', 1, 'completed', NOW(), NOW()),

('Google GTFS Journey Planner – Punjab Mass Transit Authority', 'google-gtfs-journey-planner-punjab',
'Supported GTFS-based journey-planning services for Lahore, Multan and emerging EV transport networks across Punjab.',
'Worked on transit-data structuring, route and station mapping, validation, quality assurance and technical integration.',
'GTFS, GIS, Transit Data, Web Services', NULL, 'completed', NOW(), NOW()),

('Smog Prediction System – Punjab, Pakistan', 'smog-prediction-system-punjab',
'Contributed to a machine-learning system for forecasting smog conditions across Punjab for seven-day and fourteen-day periods.',
'Used PM2.5 and environmental variables to support proactive public-safety and environmental decisions.',
'ML, Environmental Intelligence, GIS, Forecasting', 2, 'ongoing', NOW(), NOW()),

('HUM-MUQQAM Addressing System – Pakistan', 'hummuqqam-addressing-system-pakistan',
'Supported the development of a national six-digit digital addressing system for improved service delivery and location identification.',
'Worked on grid design, six-by-six labelling logic, addressing-system research and real-time web implementation.',
'GIS, Hierarchical Addressing, Web Technology, Spatial Database', 3, 'completed', NOW(), NOW()),

('BOINC-Based Crop Classification Using Sentinel Data', 'boinc-crop-classification-sentinel',
'Contributed to a PITB–ITU research project using distributed computing for Sentinel-2-based crop classification.',
'Performed image processing, spectral-signature analysis, field surveys, algorithm testing and database support.',
'Remote Sensing, Image Processing, BOINC, GeoAI', 4, 'completed', NOW(), NOW()),

('Sugarcane Land Suitability Assessment – Punjab', 'sugarcane-land-suitability-punjab',
'Assessed land suitability for sugarcane using remote sensing, soil, temperature, rainfall and pH datasets.',
'Conducted crop-requirement research, data preparation and multi-criteria suitability analysis.',
'GIS, Remote Sensing, Suitability Analysis, Agricultural Knowledge', 4, 'completed', NOW(), NOW()),

('Agriculture Extension Services Through Geofencing', 'agriculture-extension-geofencing',
'Supported a geofencing-based system to improve farmer support, transparency and field-officer verification.',
'Contributed to solution research, spatial-algorithm testing and implementation support for extension modules.',
'Geofencing, GIS, Mobile Technology, Agricultural Systems', 4, 'ongoing', NOW(), NOW()),

('Crop Health Monitoring and Yield Estimation', 'crop-health-monitoring-yield-estimation',
'Helped initiate a project using Sentinel-2 imagery and GIS parcel data for crop-health monitoring and yield estimation.',
'Conducted image classification, Khasra-based analysis, field surveys and parcel-level crop extraction.',
'Remote Sensing, Image Classification, GIS, Agricultural Knowledge', 4, 'ongoing', NOW(), NOW()),

('Enhanced Flood Forecasting System – Punjab', 'flood-forecasting-system-punjab',
'Supported a flood-monitoring system using Sentinel-1 SAR and MODIS time-series imagery.',
'Processed satellite data, mapped flood extent and progression, and supported dashboard development.',
'Remote Sensing, SAR, Flood Monitoring, GIS, Dashboarding', 2, 'ongoing', NOW(), NOW()),

('Forest Cover Mapping – Bago Region, Myanmar', 'forest-cover-mapping-bago-myanmar',
'Prepared a World Bank case study on forest-cover change and current forest mapping in Myanmar.',
'Used Landsat and Sentinel-2 imagery for time-series analysis, change detection and forest-cover mapping.',
'Remote Sensing, Change Detection, Environmental Intelligence, GIS', 2, 'completed', NOW(), NOW()),

('EVACCS Project – Punjab and Khyber Pakhtunkhwa', 'evaccs-project-punjab-kpk',
'Contributed GIS datasets for a World Bank-funded vaccination-support and decision-making project.',
'Prepared administrative boundaries, mapped health facilities and supported spatial-data development.',
'GIS, Public Health, Decision Support, Spatial Data', NULL, 'completed', NOW(), NOW()),

('Polio Mapping – Punjab and Balochistan', 'polio-mapping-punjab-balochistan',
'Supported a World Bank-funded initiative to strengthen vaccination planning and operations.',
'Updated district and tehsil boundaries, prepared facility maps and developed relevant GIS datasets.',
'GIS, Public Health, Spatial Data, Vaccination Planning', NULL, 'completed', NOW(), NOW()),

('CORONA / COVID-19 BOT and Tracker – Punjab', 'covid-19-bot-tracker-punjab',
'Supported the Punjab Government's COVID-19 response through GIS analysis and dashboard-ready datasets.',
'Prepared facility and service-coverage maps and conducted hotspot analysis for high-risk areas.',
'GIS, Hotspot Analysis, Dashboard, Public Health', 2, 'completed', NOW(), NOW()),

('PASBAN Application and e-Ticketing – National Highways & Motorway Police', 'pasban-eticket-nhmp',
'Supported GIS-enabled mobile applications for challan automation and location-based operational assistance.',
'Developed road, buffer and beat datasets, and helped structure zones, sectors and dashboard information.',
'GIS, Mobile Application, Location Services, Geofencing', NULL, 'completed', NOW(), NOW()),

('Waseela-e-Taleem – Benazir Income Support Programme', 'waseela-taleem-bisp',
'Provided GIS support for district- and tehsil-level statistical mapping to improve programme transparency.',
'Prepared administrative boundaries and coded the geographic hierarchy according to departmental records.',
'GIS, Administrative Boundaries, Hierarchical Addressing, Social Programs', 3, 'completed', NOW(), NOW()),

('RCT-Based Survey Project – ITU Pakistan and Liberia', 'rct-survey-itu-liberia',
'Contributed to research using RGB and multispectral imagery to extract housing information for surveys.',
'Tested imagery sources, explored feature-extraction methods and supported vector-data preparation.',
'Remote Sensing, Image Processing, Research Methods, GIS', 1, 'completed', NOW(), NOW()),

('Property Digitisation Using GIS – Chaklala Scheme, Rawalpindi', 'property-digitisation-chaklala',
'Supported a cantonment tax-collection pilot using high-resolution imagery, parcel mapping and field surveys.',
'Integrated property data into a customised application and made results accessible through Carto.',
'GIS, Remote Sensing, Web GIS, Property Mapping, Carto', NULL, 'completed', NOW(), NOW()),

('Pakistan Air Force Land-Management Project', 'pak-airforce-land-management',
'Contributed to a local land-information management system with server-based mapping services.',
'Researched airborne and land-based systems, MBTiles, map servers and GTFS-server options.',
'GIS, Map Servers, MBTiles, Land Management, Web Services', NULL, 'ongoing', NOW(), NOW()),

('Pakistan Air Force Flood Mapping for Rescue Operations', 'pak-airforce-flood-mapping',
'Supported real-time flood reporting for rescue operations using Sentinel-1 radar and inundation datasets.',
'Developed and tested Google Earth Engine change-detection workflows and supported implementation.',
'Remote Sensing, Google Earth Engine, SAR, Flood Mapping, Rescue Operations', 2, 'ongoing', NOW(), NOW());
