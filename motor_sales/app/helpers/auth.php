<?php

namespace App\Helpers;

class Auth
{
    public static function check()
    {
        return isset($_SESSION['user']);
    }

    // public static function user()
    // {
    //     return $_SESSION['user'] ?? null;
    // }

    public function index()
    {
    if (!Auth::check()) {
        header('Location: /motor_sales/login');
        exit;
    }

    require_once __DIR__ . '/../../config/database.php';
    $motors = (new Motor($pdo))->all();
    require_once __DIR__ . '/../views/motors/index.php';
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }

}