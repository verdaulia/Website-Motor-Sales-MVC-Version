<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /motor_sales/login'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Motor</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Daftar Motor</h1>
    <p><a href="/motor_sales/motors/create">Tambah Motor Baru</a></p>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($motors as $index => $motor): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($motor['name']) ?></td>
                <td><?= htmlspecialchars($motor['price']) ?></td>
                <td><img src="public/uploads/<?php echo $motor['image']; ?>" alt="Motor Image" width="100"></td>
                <td><?= htmlspecialchars($motor['description']) ?></td>
                <td>
                    <a href="/motor_sales/motors/<?= $motor['id'] ?>">Detail</a> |
                    <a href="/motor_sales/motors/<?= $motor['id'] ?>/edit">Edit</a> |
                    <a href="/motor_sales/motors/<?= $motor['id']; ?>/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus motor ini?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><a href="/motor_sales/public/logout.php">Logout</a></p>
</body>
</html>
