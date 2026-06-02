<?php
// Mock Server Variables
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SERVER_PORT'] = '80';

// We need to capture output to prevent filling the console
function testRoute($uri, $method = 'GET', $body = null) {
    echo "Testing Route: [$method] $uri ... ";
    
    $_SERVER['REQUEST_URI'] = $uri;
    $_SERVER['REQUEST_METHOD'] = $method;
    
    if ($body) {
        // Mock php://input
        // Not easily doable without stream wrappers, so we skip body decoding test
        // and just let it fall back gracefully.
    }

    ob_start();
    try {
        require_once __DIR__ . '/../src/Router.php';
        $router = new Router();
        $router->dispatch($uri, $method);
        $output = ob_get_clean();
        
        // Basic check to see if we got 404
        if (strpos($output, '404 Not Found') !== false || strpos($output, '404 Admin Route Not Found') !== false) {
            echo "FAILED (404 Not Found)\n";
            return false;
        }
        
        // Basic check for fatal errors rendered in output
        if (strpos($output, 'Fatal error') !== false || strpos($output, 'Parse error') !== false) {
            echo "FAILED (PHP Error detected in output)\n";
            return false;
        }

        echo "PASSED (" . strlen($output) . " bytes)\n";
        return true;
    } catch (Throwable $e) {
        ob_end_clean();
        echo "FAILED (Exception: " . $e->getMessage() . ")\n";
        return false;
    }
}

$routes = [
    '/' => 'GET',
    '/flow' => 'GET',
    '/api/flow/simulate' => 'POST',
    '/product/buildledger' => 'GET',
    '/product/invalid-slug' => 'GET', // Expect 404 conceptually but we test if it crashes
    '/projects' => 'GET',
    '/about' => 'GET',
    '/contact' => 'GET',
    '/api/analytics/track' => 'POST',
    '/admin' => 'GET',
    '/admin/products' => 'GET',
    '/admin/simulations' => 'GET',
    '/admin/leads' => 'GET'
];

$allPassed = true;
foreach ($routes as $uri => $method) {
    if (!testRoute($uri, $method)) {
        $allPassed = false;
    }
}

echo "\nIntegration Test " . ($allPassed ? "SUCCESS" : "FAILED") . "\n";
exit($allPassed ? 0 : 1);
