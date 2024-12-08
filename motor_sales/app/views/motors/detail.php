<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Motor</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Detail Motor</h1>
    <p><strong>Nama:</strong> <?= htmlspecialchars($motor['name']) ?></p>
    <p><strong>Harga:</strong> <?= htmlspecialchars($motor['price']) ?></p>
    <p><strong>Deskripsi:</strong> <?= htmlspecialchars($motor['description']) ?></p>
    <p><strong>Gambar:</strong></p>
    <!-- <p><?php var_dump($motor['image']); ?></p> -->
    <img src="/motor_sales/public/uploads/<?= urlencode(htmlspecialchars($motor['image'])) ?>" alt="<?= htmlspecialchars($motor['name']) ?>" style="max-width: 400px;">
    <p><a href="/motor_sales/motors">Kembali ke daftar motor</a></p>
</body>
</html>