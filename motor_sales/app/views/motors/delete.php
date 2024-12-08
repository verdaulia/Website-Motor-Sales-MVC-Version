<?php
require_once __DIR__ . '/../../config/database.php';  // Pastikan koneksi PDO sudah ada

// Ambil ID motor dari URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Ambil nama gambar motor dari database
    $stmt = $pdo->prepare("SELECT image FROM motors WHERE id = ?");
    $stmt->execute([$id]);
    $motor = $stmt->fetch();

    if ($motor) {
        // Path gambar motor
        $image_path = __DIR__ . '/../../public/uploads/' . $motor['image'];

        // Cek jika gambar ada dan dapat dihapus
        if (file_exists($image_path)) {
            if (unlink($image_path)) {
                echo "Gambar motor berhasil dihapus.<br>";
            } else {
                echo "Gagal menghapus gambar motor.<br>";
            }
        } else {
            echo "Gambar tidak ditemukan.<br>";
        }

        // Hapus data motor dari database
        $stmt = $pdo->prepare("DELETE FROM motors WHERE id = ?");
        if ($stmt->execute([$id])) {
            echo "Motor berhasil dihapus.<br>";
            // Redirect ke halaman daftar motor setelah penghapusan
            header("Location: /motor_sales/motors");
            exit();
        } else {
            echo "Gagal menghapus motor dari database.<br>";
        }
    } else {
        echo "Motor tidak ditemukan.<br>";
    }
} else {
    echo "ID motor tidak ditemukan.<br>";
}
?>
