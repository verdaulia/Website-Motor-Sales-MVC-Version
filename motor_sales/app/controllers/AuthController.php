<?php
namespace App\Controllers;
session_start();

use App\Models\User;

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Menyertakan koneksi PDO dari config/database.php
            require_once __DIR__ . '/../../config/database.php';  // Pastikan koneksi PDO sudah tersedia
            

            // Membuat objek User dan terusan objek PDO
            $user = new User($pdo);  // Menggunakan objek PDO yang sudah tersedia

            $user = $user->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: /motor_sales/motors');
                exit;
            } else {
                echo "Login gagal. Coba lagi.";
            }
            
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // Menyertakan koneksi PDO dari config/database.php
            require_once __DIR__ . '/../../config/database.php';  // Pastikan koneksi PDO sudah tersedia

            // Membuat objek User dan terusan objek PDO
            $user = new User($pdo);

            if ($user->create($username, $password)) {
                header('Location: login');
                exit;
            } else {
                echo "Registrasi gagal.";
            }
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: login');
        exit;
    }
}
