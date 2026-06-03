<?php
require_once __DIR__ . '/../Database.php';

class ContactController {
    private function wantsJson() {
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        return strpos($accept, 'application/json') !== false || !empty($_POST['response_format']) && $_POST['response_format'] === 'json';
    }

    private function respond($success, $message, $status = 200, $redirect = null) {
        if ($this->wantsJson()) {
            http_response_code($status);
            header('Content-Type: application/json');
            echo json_encode(['success' => $success, 'message' => $message]);
            return;
        }

        $_SESSION['contact_flash'] = [
            'type' => $success ? 'success' : 'error',
            'message' => $message,
        ];
        header('Location: ' . ($redirect ?? '/contact'));
        exit;
    }

    public function submit() {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'POST';
        if ($method !== 'POST') {
            $this->respond(false, 'Method not allowed', 405);
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $category = trim($_POST['category'] ?? 'general');
        $message = trim($_POST['message'] ?? '');
        $source = trim($_POST['source'] ?? 'contact_form');

        if ($name === '' || $email === '' || $message === '') {
            $this->respond(false, 'Name, email, and message are required', 422);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->respond(false, 'Invalid email address', 422);
            return;
        }

        $intent = $category;
        if ($intent === 'build') {
            $intent = 'Build a product';
        } elseif ($intent === 'support') {
            $intent = 'SaaS support';
        } elseif ($intent === 'partnership') {
            $intent = 'Partnership';
        } else {
            $intent = 'General inquiry';
        }

        try {
            $db = Database::getConnection();
            if (Database::tableExists('leads')) {
                $stmt = $db->prepare("INSERT INTO leads (name, email, intent, category, message, source) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $email, $intent, $category, $message, $source]);
            }
        } catch (Throwable $e) {
            // Don't fail the user-facing flow if persistence is unavailable.
        }

        $this->respond(true, 'Thanks, we received your message', 200, '/contact?sent=1');
    }
}
