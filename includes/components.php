<?php
/**
 * Reusable content helpers for main site pages.
 */

function get_news_items($pdo, $limit = 6) {
    if (!$pdo) return [];
    try {
        // include featured_image so public pages can render uploaded images
        $stmt = $pdo->prepare('SELECT id, title, summary, category, featured_image, published_at, created_at FROM news ORDER BY COALESCE(published_at, created_at) DESC LIMIT :limit');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function format_news_date($row) {
    $dt = $row['published_at'] ?: $row['created_at'] ?? null;
    if (!$dt) return '';
    return date('Y-m-d', strtotime($dt));
}

function get_team_members($pdo, $limit = 12) {
    if (!$pdo) return [];
    try {
        $stmt = $pdo->prepare('SELECT id, name, position, biography, photo_url, email, linkedin, created_at FROM team_members ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function normalize_image_for_public($path) {
    if (empty($path)) return null;
    if (strpos($path, 'http') === 0) return $path;
    // ensure leading slash
    if (strpos($path, '/') !== 0) return '/' . ltrim($path, '/');
    return $path;
}

function create_thumbnail($srcFullPath, $destFullPath, $maxWidth = 400) {
    if (!is_file($srcFullPath)) return false;
    // Check if GD image functions are available
    if (!function_exists('imagecreatetruecolor') || !function_exists('getimagesize')) {
        // GD not available; skip thumbnail creation
        return false;
    }
    $info = getimagesize($srcFullPath);
    if ($info === false) return false;
    list($width, $height, $type) = $info;
    if ($width <= $maxWidth) {
        // simply copy if smaller
        return copy($srcFullPath, $destFullPath);
    }
    $ratio = $height / $width;
    $newWidth = $maxWidth;
    $newHeight = (int)($newWidth * $ratio);

    switch ($type) {
        case IMAGETYPE_JPEG:
            if (!function_exists('imagecreatefromjpeg')) return false;
            $srcImg = imagecreatefromjpeg($srcFullPath);
            break;
        case IMAGETYPE_PNG:
            if (!function_exists('imagecreatefrompng')) return false;
            $srcImg = imagecreatefrompng($srcFullPath);
            break;
        case IMAGETYPE_GIF:
            if (!function_exists('imagecreatefromgif')) return false;
            $srcImg = imagecreatefromgif($srcFullPath);
            break;
        case IMAGETYPE_WEBP:
            if (!function_exists('imagecreatefromwebp')) return false;
            $srcImg = imagecreatefromwebp($srcFullPath);
            break;
        default:
            return false;
    }

    if (!$srcImg) return false;
    $dstImg = imagecreatetruecolor($newWidth, $newHeight);
    // preserve PNG transparency
    if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
        imagecolortransparent($dstImg, imagecolorallocatealpha($dstImg, 0, 0, 0, 127));
        imagealphablending($dstImg, false);
        imagesavealpha($dstImg, true);
    }
    imagecopyresampled($dstImg, $srcImg, 0,0,0,0, $newWidth, $newHeight, $width, $height);

    $saved = false;
    $ext = strtolower(pathinfo($destFullPath, PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg'])) {
        $saved = imagejpeg($dstImg, $destFullPath, 85);
    } elseif ($ext === 'png') {
        $saved = imagepng($dstImg, $destFullPath, 6);
    } elseif ($ext === 'gif') {
        $saved = imagegif($dstImg, $destFullPath);
    } elseif ($ext === 'webp' && function_exists('imagewebp')) {
        $saved = imagewebp($dstImg, $destFullPath, 80);
    }

    imagedestroy($srcImg);
    imagedestroy($dstImg);
    return $saved;
}

function get_news_item($pdo, $id) {
    if (!$pdo) return null;
    $id = (int)$id;
    try {
        $stmt = $pdo->prepare('SELECT * FROM news WHERE id = :id LIMIT 1');
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } catch (Exception $e) {
        return null;
    }
}

function get_publications($pdo, $limit = 12) {
    if (!$pdo) return [];
    try {
        $stmt = $pdo->prepare('SELECT id, title, authors, journal, year, summary, created_at FROM publications ORDER BY COALESCE(year, created_at) DESC LIMIT :limit');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function get_publication($pdo, $id) {
    if (!$pdo) return null;
    try {
        $stmt = $pdo->prepare('SELECT * FROM publications WHERE id = :id LIMIT 1');
        $stmt->execute([':id'=>(int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Get publications with optional text search and year filter
 * @param PDO $pdo
 * @param int $limit
 * @param string|null $q
 * @param int|null $year
 * @return array
 */
function get_publications_filtered($pdo, $limit = 12, $q = null, $year = null) {
    if (!$pdo) return [];
    try {
        $sql = 'SELECT id, title, authors, journal, year, summary, pdf_url, featured_image, created_at FROM publications WHERE 1=1';
        $params = [];
        if (!empty($q)) {
            $sql .= ' AND (title LIKE :q OR authors LIKE :q OR journal LIKE :q OR summary LIKE :q)';
            $params[':q'] = '%' . $q . '%';
        }
        if (!empty($year)) {
            $sql .= ' AND year = :year';
            $params[':year'] = (int)$year;
        }
        $sql .= ' ORDER BY COALESCE(year, created_at) DESC LIMIT :limit';
        $stmt = $pdo->prepare($sql);
        foreach ($params as $k => $v) {
            if ($k === ':year') $stmt->bindValue($k, (int)$v, PDO::PARAM_INT);
            else $stmt->bindValue($k, $v, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function get_research_areas($pdo, $limit = 12) {
    if (!$pdo) return [];
    try {
        $stmt = $pdo->prepare('SELECT id, title, slug, summary, content, created_at FROM research_areas ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function get_research_area($pdo, $id) {
    if (!$pdo) return null;
    try {
        $stmt = $pdo->prepare('SELECT * FROM research_areas WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => (int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } catch (Exception $e) {
        return null;
    }
}

function get_research_areas_with_projects($pdo, $limit = 12) {
    if (!$pdo) return [];
    try {
        $stmt = $pdo->prepare('
            SELECT 
                ra.id, 
                ra.title, 
                ra.slug, 
                ra.summary, 
                ra.content, 
                ra.created_at,
                COUNT(p.id) as project_count
            FROM research_areas ra
            LEFT JOIN projects p ON p.research_area_id = ra.id
            GROUP BY ra.id
            ORDER BY ra.created_at DESC 
            LIMIT :limit
        ');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function get_projects($pdo, $limit = 12) {
    if (!$pdo) return [];
    try {
        $stmt = $pdo->prepare('SELECT id, title, slug, summary, objectives, technologies, research_area_id, status, created_at FROM projects ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function get_project($pdo, $id) {
    if (!$pdo) return null;
    try {
        $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = :id LIMIT 1');
        $stmt->execute([':id'=>(int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } catch (Exception $e) {
        return null;
    }
}

function get_projects_by_research_area($pdo, $research_area_id, $limit = 99) {
    if (!$pdo) return [];
    try {
        $stmt = $pdo->prepare('SELECT id, title, slug, summary, objectives, technologies, research_area_id, status, created_at FROM projects WHERE research_area_id = :research_area_id ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':research_area_id', (int)$research_area_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

?>