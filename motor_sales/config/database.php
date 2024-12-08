<?php
// config/database.php

$host = 'localhost';
$db = 'motor_gallery'; // Ganti dengan nama database Anda
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda

// Menangani koneksi PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode ke exception
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
