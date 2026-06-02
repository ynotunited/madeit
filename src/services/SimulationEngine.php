<?php
require_once __DIR__ . '/../Database.php';

class SimulationEngine {
    // Fallback rules used only when the database table is unavailable or empty.
    private $fallbackRules = [
        'payment' => ['module' => 'Stripe Payments', 'cost' => 500, 'timeline' => 3],
        'auth' => ['module' => 'User Authentication', 'cost' => 200, 'timeline' => 1],
        'login' => ['module' => 'User Authentication', 'cost' => 200, 'timeline' => 1],
        'ai' => ['module' => 'AI Integration', 'cost' => 1500, 'timeline' => 7],
        'chat' => ['module' => 'Real-time Chat', 'cost' => 800, 'timeline' => 5],
        'dashboard' => ['module' => 'Admin Dashboard', 'cost' => 600, 'timeline' => 4],
        'api' => ['module' => 'REST API', 'cost' => 400, 'timeline' => 2]
    ];

    private function loadRules() {
        try {
            if (!Database::tableExists('product_rules')) {
                return $this->fallbackRules;
            }

            $db = Database::getConnection();
            $stmt = $db->query("SELECT keyword, module, cost_weight, complexity_weight FROM product_rules ORDER BY id ASC");
            $rows = $stmt->fetchAll();

            if (empty($rows)) {
                return $this->fallbackRules;
            }

            $rules = [];
            foreach ($rows as $row) {
                $keyword = strtolower(trim((string) $row['keyword']));
                if ($keyword === '') {
                    continue;
                }

                $rules[$keyword] = [
                    'module' => (string) $row['module'],
                    'cost' => (int) ($row['cost_weight'] ?: 0),
                    'timeline' => max(1, (int) ($row['complexity_weight'] ?: 1)),
                ];
            }

            return !empty($rules) ? $rules : $this->fallbackRules;
        } catch (Throwable $e) {
            return $this->fallbackRules;
        }
    }

    public function simulate($ideaText) {
        $ideaText = strtolower($ideaText);
        $detectedModules = [];
        $totalCost = 0;
        $totalTimeline = 0;
        $rules = $this->loadRules();

        foreach ($rules as $keyword => $data) {
            if (strpos($ideaText, $keyword) !== false) {
                // Ensure unique modules
                $exists = false;
                foreach ($detectedModules as $m) {
                    if ($m['name'] === $data['module']) $exists = true;
                }
                if (!$exists) {
                    $detectedModules[] = [
                        'name' => $data['module'],
                        'cost' => $data['cost'],
                        'timeline_days' => $data['timeline']
                    ];
                    $totalCost += $data['cost'];
                    $totalTimeline += $data['timeline'];
                }
            }
        }

        // Base cost and timeline if nothing detected
        if (empty($detectedModules)) {
            $detectedModules[] = ['name' => 'Core Architecture', 'cost' => 1000, 'timeline_days' => 5];
            $totalCost += 1000;
            $totalTimeline += 5;
        }

        $costRange = "$" . number_format($totalCost) . " - $" . number_format($totalCost * 1.5);
        $timelineStr = $totalTimeline . " - " . ($totalTimeline + 3) . " days";

        return [
            'modules' => $detectedModules,
            'cost_range' => $costRange,
            'timeline' => $timelineStr
        ];
    }
}
