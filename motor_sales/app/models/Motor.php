<?php

namespace App\Models;

require_once __DIR__ . '/../../config/database.php';  // Pastikan file database.php sudah terhubung

class Motor
{
    private $pdo;

    // Konstruktor menerima objek PDO yang telah dibuat di database.php
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM motors");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Menggunakan \PDO karena ini adalah kelas global PHP
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM motors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);  // Menggunakan \PDO karena ini adalah kelas global PHP
    }

    public function create($name, $price, $description, $image)
    {
        $stmt = $this->pdo->prepare("INSERT INTO motors (name, price, description, image) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $price, $description, $image]);
    }

    public function update($id, $name, $price, $description, $image)
    {
        $stmt = $this->pdo->prepare("UPDATE motors SET name = ?, price = ?, description = ?, image = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $description, $image, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM motors WHERE id = ?");
        return $stmt->execute([$id]);
    }
}