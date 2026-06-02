<?php
require_once __DIR__ . '/../Database.php';

class NewsletterController {
    private function wantsJson() {
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        return strpos($accept, 'application/json') !== false || !empty($_POST['response_format']) && $_POST['response_format'] === 'json';
    }

    private function respond($success, $message, $status = 200) {
        if ($this->wantsJson()) {
            http_response_code($status);
            header('Content-Type: application/json');
            echo json_encode(['success' => $success, 'message' => $message]);
            return;
        }

        $_SESSION['newsletter_flash'] = [
            'type' => $success ? 'success' : 'error',
            'message' => $message,
        ];
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
        exit;
    }

    public function subscribe() {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'POST';
        if ($method !== 'POST') {
            $this->respond(false, 'Method not allowed', 405);
            return;
        }

        $email = trim($_POST['email'] ?? '');
        $source = trim($_POST['source'] ?? 'footer_newsletter');

        if ($email === '') {
            $this->respond(false, 'Email is required', 422);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->respond(false, 'Please enter a valid email address', 422);
            return;
        }

        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO leads (name, email, intent, category, message, source) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                'Newsletter Subscriber',
                $email,
                'Newsletter subscription',
                'newsletter',
                'Footer newsletter subscription',
                $source,
            ]);
        } catch (Throwable $e) {
            $this->respond(false, 'We could not save your subscription right now', 500);
            return;
        }

        $this->respond(true, 'You are subscribed. Thanks for staying in touch!', 200);
    }
}
