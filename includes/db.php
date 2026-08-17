<?php

$config = require __DIR__ . '/config.php';

function db_connect()
{
    global $config;
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Try MySQL first (configured in includes/config.php)
    try {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['db']['host'], $config['db']['name'], $config['db']['charset']);
        return new PDO($dsn, $config['db']['user'], $config['db']['pass'], $options);
    } catch (PDOException $e) {
        // Log and fall back to SQLite for local development convenience
        error_log('MySQL connect failed, falling back to SQLite: ' . $e->getMessage());
    }

    // SQLite fallback — create a local file-based DB and initialize schema if needed
    try {
        $sqliteFile = __DIR__ . '/../database/gdsg.sqlite';
        $sqliteDir = dirname($sqliteFile);
        if (!is_dir($sqliteDir)) {
            @mkdir($sqliteDir, 0755, true);
        }

        $sqliteDsn = 'sqlite:' . $sqliteFile;
        $pdo = new PDO($sqliteDsn, null, null, $options);

        // If DB is newly created (file size small), attempt to run schema and seed
        if (!file_exists($sqliteFile) || filesize($sqliteFile) < 100) {
            $schemaFile = __DIR__ . '/../database/schema.sql';
            if (file_exists($schemaFile)) {
                $sql = file_get_contents($schemaFile);
                if ($sql !== false) {
                    try {
                        $pdo->exec($sql);
                    } catch (PDOException $e) {
                        // The provided schema is MySQL-specific and may fail on SQLite.
                        // Create minimal SQLite-compatible tables needed for admin testing.
                        error_log('Applying fallback SQLite schema for core tables: ' . $e->getMessage());
                        $fallback = [];
                        $fallback[] = "CREATE TABLE IF NOT EXISTS publications (
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            title TEXT NOT NULL,
                            authors TEXT,
                            journal TEXT,
                            year INTEGER,
                            summary TEXT,
                            doi TEXT,
                            pdf_url TEXT,
                            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
                        );";

                        $fallback[] = "CREATE TABLE IF NOT EXISTS partners (
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            name TEXT NOT NULL,
                            website TEXT,
                            logo_url TEXT,
                            description TEXT,
                            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                        );";

                        foreach ($fallback as $fsql) {
                            try {
                                $pdo->exec($fsql);
                            } catch (PDOException $inner) {
                                error_log('Failed to apply fallback table: ' . $inner->getMessage());
                            }
                        }
                        // Also ensure project_images exists in fallback
                        try {
                            $pdo->exec("CREATE TABLE IF NOT EXISTS project_images (
                                id INTEGER PRIMARY KEY AUTOINCREMENT,
                                project_id INTEGER NOT NULL,
                                image_url TEXT NOT NULL,
                                caption TEXT,
                                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                            )");
                        } catch (PDOException $inner) {
                            error_log('Failed to create fallback project_images table: ' . $inner->getMessage());
                        }
                    }
                }
            }

            // Seed minimal sample rows for testing admin UI
            try {
                $pdo->exec("INSERT INTO publications (title, authors, journal, year, summary) VALUES ('Sample Publication', 'A. Researcher', 'Geo Journal', 2024, 'Sample summary')");
            } catch (Exception $e) {
                // ignore duplicate inserts or other seed issues
            }
            try {
                $pdo->exec("INSERT INTO partners (name, website, description) VALUES ('Academic Partner','https://example.edu','University collaboration for GeoAI research.')");
            } catch (Exception $e) {
                // ignore
            }

            // Ensure a minimal projects table exists for admin/testing when using SQLite fallback
            try {
                $pdo->exec("CREATE TABLE IF NOT EXISTS projects (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    title TEXT,
                    slug TEXT UNIQUE,
                    summary TEXT,
                    objectives TEXT,
                    technologies TEXT,
                    content TEXT,
                    research_area_id INTEGER,
                    status TEXT,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");
            } catch (Exception $e) {
                // ignore if creation fails
            }
        }

        return $pdo;
    } catch (PDOException $e) {
        error_log('SQLite fallback failed: ' . $e->getMessage());
        return null;
    }
}

$pdo = db_connect();

// Add detailed error logging
if ($pdo === null) {
    error_log('FATAL: db_connect() returned null - both MySQL and SQLite connections failed');
    throw new Exception('Database connection failed - both MySQL and SQLite are unavailable');
}

// Attempt lightweight migrations: ensure `projects` has additional detailed columns
try {
    $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    if ($driver === 'sqlite') {
        $cols = [];
        $res = $pdo->query("PRAGMA table_info(projects)");
        foreach ($res->fetchAll(PDO::FETCH_ASSOC) as $r) { $cols[] = $r['name']; }
        
        $newCols = ['featured_image', 'tags', 'approach', 'outcomes', 'impact', 'key_highlights', 'funding_info', 'timeline', 'deliverables'];
        foreach ($newCols as $col) {
            if (!in_array($col, $cols)) {
                $pdo->exec("ALTER TABLE projects ADD COLUMN $col TEXT");
            }
        }
    } else {
        // MySQL-compatible: use information_schema to check
        $stmt = $pdo->prepare("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = :schema AND TABLE_NAME = 'projects'");
        $stmt->execute([':schema' => $config['db']['name']]);
        $cols = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $newCols = [
            'featured_image' => 'VARCHAR(255)',
            'tags' => 'VARCHAR(255)',
            'approach' => 'TEXT',
            'outcomes' => 'TEXT',
            'impact' => 'TEXT',
            'key_highlights' => 'TEXT',
            'funding_info' => 'VARCHAR(255)',
            'timeline' => 'VARCHAR(255)',
            'deliverables' => 'TEXT'
        ];
        
        foreach ($newCols as $col => $type) {
            if (!in_array($col, $cols)) {
                $pdo->exec("ALTER TABLE projects ADD COLUMN $col $type NULL");
            }
        }
    }
} catch (Exception $e) {
    // ignore migration failures — not critical for runtime
}
