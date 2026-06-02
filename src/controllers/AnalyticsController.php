<?php

require_once __DIR__ . '/../Database.php';

class AnalyticsController {
    public function track() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        
        $event = $data['event'] ?? 'unknown';
        $properties = $data['properties'] ?? [];

        try {
            if (Database::tableExists('analytics')) {
                $db = Database::getConnection();
                $stmt = $db->prepare("INSERT INTO analytics (event, properties) VALUES (?, ?)");
                $stmt->execute([$event, json_encode($properties, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)]);
            }
        } catch (Throwable $e) {
            // Analytics should never break the page.
        }

        echo json_encode(['success' => true, 'tracked' => $event]);
    }
}
