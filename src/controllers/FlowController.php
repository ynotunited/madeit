<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../services/SimulationEngine.php';
require_once __DIR__ . '/../Database.php';

class FlowController {
    private function buildNotificationSummary($idea, array $result) {
        $modules = $result['modules'] ?? [];
        $lines = [];
        $lines[] = "Idea:";
        $lines[] = trim((string) $idea);
        $lines[] = "";
        $lines[] = "Estimated Cost: " . ($result['cost_range'] ?? '-');
        $lines[] = "Estimated Timeline: " . ($result['timeline'] ?? '-');
        $lines[] = "";
        $lines[] = "Detected Modules:";

        if (empty($modules)) {
            $lines[] = "- None detected";
        } else {
            foreach ($modules as $module) {
                $lines[] = '- ' . ($module['name'] ?? 'Module') . ' (~$' . ($module['cost'] ?? '0') . ')';
            }
        }

        return implode("\n", $lines);
    }

    private function resolveTelegramChatId($token) {
        $chatId = trim((string) madeit_env('MADEIT_TELEGRAM_CHAT_ID'));
        if ($chatId !== '') {
            return $chatId;
        }

        $ch = curl_init('https://api.telegram.org/bot' . rawurlencode($token) . '/getUpdates');
        if ($ch === false) {
            return '';
        }

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 6,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        if (!is_string($response) || $response === '') {
            return '';
        }

        $data = json_decode($response, true);
        if (!is_array($data) || empty($data['ok']) || empty($data['result']) || !is_array($data['result'])) {
            return '';
        }

        $lastChatId = '';
        foreach (array_reverse($data['result']) as $update) {
            if (!is_array($update)) {
                continue;
            }
            foreach (['message', 'edited_message', 'channel_post'] as $key) {
                if (!empty($update[$key]['chat']['id'])) {
                    $lastChatId = (string) $update[$key]['chat']['id'];
                    break 2;
                }
            }
        }

        return $lastChatId;
    }

    private function sendEmailNotification($idea, array $result) {
        $to = trim((string) madeit_env('MADEIT_FLOW_NOTIFICATION_EMAIL'));
        if ($to === '') {
            return false;
        }

        $subject = 'MadeIT Flow idea submitted';
        $message = "A new idea was submitted to MadeIT Flow:\n\n" . $this->buildNotificationSummary($idea, $result) . "\n";

        $headers = [
            'From: MadeIT Flow <no-reply@madeitcodes.online>',
            'Reply-To: no-reply@madeitcodes.online',
            'Content-Type: text/plain; charset=UTF-8',
        ];

        return @mail($to, $subject, $message, implode("\r\n", $headers));
    }

    private function sendTelegramNotification($idea, array $result) {
        $token = trim((string) madeit_env('MADEIT_TELEGRAM_BOT_TOKEN'));
        if ($token === '') {
            return false;
        }

        $chatId = $this->resolveTelegramChatId($token);
        if ($chatId === '') {
            return false;
        }

        $text = "New MadeIT Flow idea submitted\n\n" . $this->buildNotificationSummary($idea, $result);

        $payload = json_encode([
            'chat_id' => $chatId,
            'text' => $text,
            'disable_web_page_preview' => true,
        ]);
        if ($payload === false) {
            return false;
        }

        $ch = curl_init('https://api.telegram.org/bot' . rawurlencode($token) . '/sendMessage');
        if ($ch === false) {
            return false;
        }

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 6,
        ]);
        curl_exec($ch);
        curl_close($ch);

        return true;
    }

    private function notifyIdeaFlow($idea, array $result) {
        $webhookUrl = trim((string) madeit_env('MADEIT_IDEA_FLOW_WEBHOOK_URL'));
        if ($webhookUrl === '') {
            return;
        }

        $payload = json_encode([
            'idea' => $idea,
            'cost_range' => $result['cost_range'] ?? '',
            'timeline' => $result['timeline'] ?? '',
            'modules' => $result['modules'] ?? [],
        ]);

        if ($payload === false) {
            return;
        }

        $ch = curl_init($webhookUrl);
        if ($ch === false) {
            return;
        }

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 6,
        ]);
        curl_exec($ch);
        curl_close($ch);
    }

    public function index() {
        $pageTitle = 'MadeIT Flow | Simulate Your Idea';
        $viewFile = __DIR__ . '/../views/flow.php';
        require_once __DIR__ . '/../views/layout.php';
    }

    public function simulate() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $idea = $data['idea'] ?? '';

        $engine = new SimulationEngine();
        $result = $engine->simulate($idea);

        try {
            if (Database::tableExists('simulations')) {
                $db = Database::getConnection();
                $stmt = $db->prepare("INSERT INTO simulations (idea_text, modules_json, cost_range, timeline) VALUES (?, ?, ?, ?)");
                $stmt->execute([
                    $idea,
                    json_encode($result['modules'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                    $result['cost_range'],
                    $result['timeline']
                ]);
            }
        } catch (Throwable $e) {
            // Keep the user-facing flow working even if persistence fails.
        }

        try {
            $this->sendEmailNotification($idea, $result);
            $this->sendTelegramNotification($idea, $result);
            $this->notifyIdeaFlow($idea, $result);
        } catch (Throwable $e) {
            // Notification is optional and should never block the flow response.
        }

        echo json_encode(['success' => true, 'data' => $result]);
    }
}
