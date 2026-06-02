<?php
/**
 * Core Routing Engine for MadeIT Codes
 */
require_once __DIR__ . '/../src/bootstrap.php';
madeit_load_env_file(__DIR__ . '/../.env');
require_once __DIR__ . '/../src/Router.php';

$cookieParams = session_get_cookie_params();
session_set_cookie_params([
    'lifetime' => $cookieParams['lifetime'],
    'path' => $cookieParams['path'],
    'domain' => $cookieParams['domain'],
    'secure' => !empty($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Lax',
]);
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router();
$router->dispatch($requestUri, $method);
