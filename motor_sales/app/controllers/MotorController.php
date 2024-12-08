<?php
namespace App\Controllers;

use App\Models\Motor;

class MotorController
{
    public function index()
    {
        require_once __DIR__ . '/../../config/database.php';  // Memastikan koneksi PDO sudah ada

        $motors = (new Motor($pdo))->all();  // Menggunakan objek PDO yang diteruskan ke konstruktor Motor

        // echo '<pre>';
        // print_r($motors);
        // echo '</pre>';
        // die();

        require_once __DIR__ . '/../views/motors/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            $image = $_FILES['image'];
            $imageName = time() . '_' . $image['name'];
            move_uploaded_file($image['tmp_name'], __DIR__ . '/../../public/uploads/' . $imageName);

            require_once __DIR__ . '/../../config/database.php';  // Memastikan koneksi PDO sudah ada

            $motor = new Motor($pdo);  // Menggunakan objek PDO yang diteruskan ke konstruktor Motor
            if ($motor->create($name, $price, $description, $imageName)) {
                header('Location: /motor_sales/motors');
                exit;
            } else {
                echo "Gagal menambah motor.";
            }
        }


        require_once __DIR__ . '/../views/motors/create.php';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Debugging: menampilkan input form
            var_dump($_POST);
            var_dump($_FILES);
            exit;
        }
    }

    public function detail($id)
    {
        require_once __DIR__ . '/../../config/database.php';  // Memastikan koneksi PDO sudah ada

        $motor = (new Motor($pdo))->find($id);  // Menggunakan objek PDO yang diteruskan ke konstruktor Motor
        if (!$motor) {
            http_response_code(404);
            echo "Motor tidak ditemukan.";
            return;
        }

        require_once __DIR__ . '/../views/motors/detail.php';
    }

    public function edit($id)
    {
        require_once __DIR__ . '/../../config/database.php';  // Memastikan koneksi PDO sudah ada

        $motor = (new Motor($pdo))->find($id);  // Menggunakan objek PDO yang diteruskan ke konstruktor Motor

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            $imageName = $motor['image'];
            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image'];
                $imageName = time() . '_' . $image['name'];
                move_uploaded_file($image['tmp_name'], __DIR__ . '/../../public/uploads/' . $imageName);
            }

            if ((new Motor($pdo))->update($id, $name, $price, $description, $imageName)) {
                header('Location: /motor_sales/motors');
                exit;
            } else {
                echo "Gagal mengedit motor.";
            }
        }

        require_once __DIR__ . '/../views/motors/edit.php';
    }

    public function delete($id)
    {
    require_once __DIR__ . '/../../config/database.php';  // Memastikan koneksi PDO sudah ada

    // Ambil nama gambar motor dari database
    $stmt = $pdo->prepare("SELECT image FROM motors WHERE id = ?");
    $stmt->execute([$id]);
    $motor = $stmt->fetch();

    // Jika motor ditemukan
    // Jika motor ditemukan
    if ($motor) {
        // Hapus gambar dari folder uploads
        $image_path = __DIR__ . '/../../public/uploads/' . $motor['image'];
        if (file_exists($image_path)) {
            if (unlink($image_path)) {
                // Gambar berhasil dihapus
            } else {
                // Jika gagal menghapus gambar
                echo "Gagal menghapus gambar motor.";
                return;
            }
        }

        // Hapus data motor dari database
        $stmt = $pdo->prepare("DELETE FROM motors WHERE id = ?");
        if ($stmt->execute([$id])) {
            // Redirect ke halaman daftar motor setelah penghapusan
            header("Location: /motor_sales/motors");
            exit();
        } else {
            // Jika gagal menghapus data motor
            echo "Gagal menghapus motor dari database.";
        }
        } else {
        // Jika motor tidak ditemukan
        echo "Motor tidak ditemukan.";
        }
    }
}