<?php

namespace App\Models;

require_once __DIR__ . '/../../config/database.php';

class User
{
    private $pdo;

    // Konstruktor menerima objek PDO yang telah dibuat
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);  // Menggunakan \PDO karena ini adalah kelas global PHP
    }

    public function create($username, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $password]);
    }
}
