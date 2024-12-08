<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\MotorController;

// ... (rest of the code remains the same)

// Routing
$uri = $_SERVER['REQUEST_URI'];
$basePath = '/motor_sales';

if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

$uri = ltrim($uri, '/');

switch ($uri) {
    case '':
    case 'login':
        (new AuthController())->login();
        break;
    case 'register':
        (new AuthController())->register();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'motors':
        (new MotorController())->index();
        break;
    case 'motors/create':
        (new MotorController())->create();
        break;
    default:
        if (preg_match('/^motors\/(\d+)$/', $uri, $matches)) {
            (new MotorController())->detail($matches[1]);
        } elseif (preg_match('/^motors\/(\d+)\/edit$/', $uri, $matches)) {
            (new MotorController())->edit($matches[1]);
        } elseif (preg_match('/^motors\/(\d+)\/delete$/', $uri, $matches)) {
            (new MotorController())->delete($matches[1]);
        } else {
            http_response_code(404);
            echo 'Page not found';
        }
}