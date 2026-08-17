<?php
header('Content-Type: application/json');
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/components.php';

try {
    $research_id = (int)($_GET['research_id'] ?? 0);
    
    if ($research_id <= 0) {
        throw new Exception('Invalid research area ID');
    }
    
    // Get projects for this research area
    $projects = get_projects_by_research_area($pdo, $research_id);
    
    $html = '';
    if (!empty($projects)) {
        foreach ($projects as $proj) {
            $techs = array_filter(array_map('trim', explode(',', $proj['technologies'] ?? '')));
            $tech_preview = !empty($techs) ? implode(', ', array_slice($techs, 0, 3)) : 'Multi-disciplinary';
            
            $html .= '<div class="col-lg-6 col-xl-4">
                <article class="research-card h-100">
                    <div class="research-card-header">
                        <span class="research-status">' . htmlspecialchars(ucfirst($proj['status'] ?? 'ongoing')) . '</span>
                        <h3 class="research-card-title">' . htmlspecialchars($proj['title']) . '</h3>
                    </div>
                    <div class="research-card-body">
                        <p class="research-summary">' . htmlspecialchars(mb_substr($proj['summary'] ?? $proj['objectives'] ?? '', 0, 280)) . '</p>
                        <div class="research-technologies">
                            <small class="tech-label">Technologies:</small>
                            <p class="tech-list">' . htmlspecialchars($tech_preview) . '</p>
                        </div>
                    </div>
                    <a href="project_detail.php?id=' . (int)$proj['id'] . '" class="research-view-btn">View Project</a>
                </article>
            </div>';
        }
    } else {
        $html = '<div class="col-12"><p class="text-center text-muted">No projects found for this research area.</p></div>';
    }
    
    echo json_encode([
        'success' => true,
        'html' => $html,
        'count' => count($projects)
    ]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
