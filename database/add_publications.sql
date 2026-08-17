-- Add new publications from the journal links

INSERT INTO publications (title, authors, journal, year, summary, doi, pdf_url, created_at, updated_at) VALUES 
(
    'Strategic Assessment of Evapotranspiration for Wheat Cultivation in Punjab, Pakistan',
    'Syed Zaheer Hussain, Maria Zubair, Arsam Ahmad Awan',
    'Journal of Public Policy Practitioners, Vol. 4 No. 1',
    2025,
    'The nation\'s main wheat producing area, namely the province of Punjab, is becoming progressively more susceptible to water constraints brought on by climate change, ineffective irrigation techniques, and inadequate management of water for agriculture. The lack of district-level evapotranspiration (ET) surveillance networks, which are necessary for developing an appropriate water policy, exacerbates these difficulties. The absence of geographically and statistically specified ET data for optimal irrigation planning during wheat farming is an important regulatory gap that this investigation covers. For the 2022-2023 season, the study evaluates ET throughout the five major phenological phases of wheat (sowing, tillering, flowering, grain filling, and harvesting), utilizing Sentinel-2 satellite images and Google Earth Engine. A vegetation-index-driven ET computational method is used to produce high-resolution maps and district-level evaluations that represent variations in water demand within and between seasons. The results show notable spatial differences between districts like Faisalabad and Bahawalpur, with ET peaking at the grain filling stage (~4.09mm/day) and falling during sowing (~1.95mm/day). Presenting a data driven framework for proportionate water distribution, regional irrigation zoning laws, and climate-resilient agrarian management, this study offers plenty to the larger legislative conversation. It makes the case that incorporating remote sensing into policies can improve the allocation of resources and productivity, two essential components of sustainable agriculture strategies in the face of increasing environmental stress.',
    'https://doi.org/10.32350/jppp.41.01',
    'https://journals.umt.edu.pk/index.php/jppp/article/view/6684/3151',
    NOW(),
    NOW()
),
(
    'Classification and Distribution Analysis of Crop Types in Mauza Mustafabad Using GIS: Implications for Agricultural Policy and Land Use',
    'Syed Zaheer Hussain, Maria Zubair, Arsam Ahmad Awan',
    'Journal of Agricultural Policy and Transformation, Vol. 1 No. 1',
    2025,
    'The study investigates agricultural patterns in Mauza Mustafabad through detailed crop classifying and analyzing using Geographic Information System (GIS) and sentinel-2 satellite imagery. The study accesses 22 different crop categories across 7433 Khasra employing a supervised classification approach in ArcGIS to generate high-resolution agriculture map, with the primer focus on dominant agricultural landscape of different crops such as wheat, fodder and orchards. The outcome of the present research indicates that 67% of the districts have been allocated to wheat production, which has a potential yield of 258,598 metric tons. Crop density and farm size variability are reflected by the extremely well-defined geographical distribution of crops, which is correlated with the land use pattern. Further, a growing pattern in fish farming has also been addressed, which reflects variations in farming methods that drive financial incentives. The integration of classified satellite imagery with real time Khasra border system provides a reliable spatial framework for assessing land utilization and improving administrative decision making. Overall, this research shows how the integration of GIS based crop mapping and land record system can support evidence based agricultural policy, resource management and food security planning in Pakistan\'s precision agriculture context.',
    'https://doi.org/10.66529/agripat.2025.1.1.1',
    'https://journals.ageconfrontiers.com/index.php/agripat/article/view/1',
    NOW(),
    NOW()
);
