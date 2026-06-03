<?php
require_once __DIR__ . '/../Database.php';

class ContactController {
    private function smtpConfig() {
        return [
            'host' => trim((string) madeit_env('MADEIT_SMTP_HOST')),
            'port' => (int) madeit_env('MADEIT_SMTP_PORT', '465'),
            'username' => trim((string) madeit_env('MADEIT_SMTP_USERNAME')),
            'password' => trim((string) madeit_env('MADEIT_SMTP_PASSWORD')),
            'encryption' => strtolower(trim((string) madeit_env('MADEIT_SMTP_ENCRYPTION', 'ssl'))),
        ];
    }

    private function smtpRead($socket) {
        $data = '';
        while (!feof($socket)) {
            $line = fgets($socket, 515);
            if ($line === false) {
                break;
            }
            $data .= $line;
            if (preg_match('/^\d{3}\s/', $line)) {
                break;
            }
        }

        return $data;
    }

    private function smtpWrite($socket, $command, array $expectedCodes = []) {
        fwrite($socket, $command . "\r\n");
        $response = $this->smtpRead($socket);
        if (empty($expectedCodes)) {
            return $response;
        }

        $code = (int) substr(trim($response), 0, 3);
        if (!in_array($code, $expectedCodes, true)) {
            throw new RuntimeException('SMTP error: ' . trim($response));
        }

        return $response;
    }

    private function sendSmtpMail($to, $subject, $html, $text = '') {
        $config = $this->smtpConfig();
        if ($config['host'] === '' || $config['username'] === '' || $config['password'] === '') {
            return false;
        }

        $host = $config['host'];
        $port = $config['port'] > 0 ? $config['port'] : 465;
        $useStartTls = in_array($config['encryption'], ['tls', 'starttls'], true);
        $useSsl = in_array($config['encryption'], ['ssl'], true) || (!$useStartTls && $port === 465);
        $transportHost = ($useSsl ? 'ssl://' : '') . $host;
        $socket = @stream_socket_client($transportHost . ':' . $port, $errno, $errstr, 15, STREAM_CLIENT_CONNECT);
        if (!$socket) {
            return false;
        }

        try {
            stream_set_timeout($socket, 15);
            $this->smtpRead($socket);
            $this->smtpWrite($socket, 'EHLO madeitcodes.online', [250]);

            if ($useStartTls) {
                $this->smtpWrite($socket, 'STARTTLS', [220]);
                stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
                $this->smtpWrite($socket, 'EHLO madeitcodes.online', [250]);
            }

            $this->smtpWrite($socket, 'AUTH LOGIN', [334]);
            $this->smtpWrite($socket, base64_encode($config['username']), [334]);
            $this->smtpWrite($socket, base64_encode($config['password']), [235]);

            $from = $config['username'];
            $this->smtpWrite($socket, 'MAIL FROM:<' . $from . '>', [250]);
            $this->smtpWrite($socket, 'RCPT TO:<' . $to . '>', [250, 251]);
            $this->smtpWrite($socket, 'DATA', [354]);

            $boundary = 'madeit-' . bin2hex(random_bytes(8));
            $headers = [
                'From: MadeIT Codes <' . $from . '>',
                'Reply-To: MadeIT Codes <' . $from . '>',
                'MIME-Version: 1.0',
                'Content-Type: multipart/alternative; boundary="' . $boundary . '"',
            ];

            $body = [];
            $body[] = '--' . $boundary;
            $body[] = 'Content-Type: text/plain; charset=UTF-8';
            $body[] = '';
            $body[] = trim($text !== '' ? $text : strip_tags($html));
            $body[] = '';
            $body[] = '--' . $boundary;
            $body[] = 'Content-Type: text/html; charset=UTF-8';
            $body[] = '';
            $body[] = $html;
            $body[] = '';
            $body[] = '--' . $boundary . '--';
            $body[] = '';

            $message = 'Subject: ' . $subject . "\r\n" . implode("\r\n", $headers) . "\r\n\r\n" . implode("\r\n", $body);
            $message = preg_replace("/\r?\n/", "\r\n", $message);
            fwrite($socket, $message . "\r\n.\r\n");
            $dataResponse = $this->smtpRead($socket);
            $dataCode = (int) substr(trim($dataResponse), 0, 3);
            if (!in_array($dataCode, [250], true)) {
                throw new RuntimeException('SMTP error: ' . trim($dataResponse));
            }

            $this->smtpWrite($socket, 'QUIT', [221]);
            fclose($socket);
            return true;
        } catch (Throwable $e) {
            fclose($socket);
            return false;
        }
    }

    private function buildUserConfirmationMessage($name, $email, $intent, $message) {
        $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $safeIntent = htmlspecialchars($intent, ENT_QUOTES, 'UTF-8');
        $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

        return <<<HTML
<div style="font-family: Arial, Helvetica, sans-serif; color: #0D1117; line-height: 1.7; max-width: 680px;">
    <h2 style="margin: 0 0 16px; color: #4A8FE8;">Thanks, {$safeName}!</h2>
    <p style="margin: 0 0 16px;">We’ve received your message and our team at <strong>MadeIT Codes</strong> will review it shortly.</p>
    <p style="margin: 0 0 16px;">We help founders and businesses build practical software products, launch faster, and simplify operations.</p>
    <div style="padding: 16px; border-radius: 12px; background: #F8FAFC; border: 1px solid #E5E7EB; margin: 20px 0;">
        <p style="margin: 0 0 8px;"><strong>Request type:</strong> {$safeIntent}</p>
        <p style="margin: 0;"><strong>Your message:</strong></p>
        <div style="margin-top: 8px;">{$safeMessage}</div>
    </div>
    <p style="margin: 0 0 12px;">What happens next:</p>
    <ul style="margin: 0 0 16px 20px; padding: 0;">
        <li>We’ll review your message</li>
        <li>We’ll get back to you as soon as possible</li>
        <li>If needed, we’ll suggest the best product or next step</li>
    </ul>
    <p style="margin: 0;">You can also explore our products at <a href="https://madeitcodes.online/products" style="color: #4A8FE8;">madeitcodes.online/products</a>.</p>
</div>
HTML;
    }

    private function sendUserConfirmationEmail($name, $email, $intent, $message) {
        $to = trim((string) $email);
        if ($to === '' || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $subject = 'We received your message - MadeIT Codes';
        $html = $this->buildUserConfirmationMessage($name, $email, $intent, $message);
        $text = "Thanks, {$name}!\n\nWe’ve received your message and our team at MadeIT Codes will review it shortly.\n\nRequest type: {$intent}\n\nYour message:\n{$message}\n\nWhat happens next:\n- We’ll review your message\n- We’ll get back to you as soon as possible\n- If needed, we’ll suggest the best product or next step\n\nExplore our products: https://madeitcodes.online/products\n";
        return $this->sendSmtpMail($to, $subject, $html, $text);
    }

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

        try {
            $this->sendUserConfirmationEmail($name, $email, $intent, $message);
        } catch (Throwable $e) {
            // Confirmation email should never block the form submission response.
        }

        $this->respond(true, 'Thanks, we received your message', 200, '/contact?sent=1');
    }
}
