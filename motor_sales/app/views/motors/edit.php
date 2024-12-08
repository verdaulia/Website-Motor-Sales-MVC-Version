<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Motor</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Edit Motor</h1>
    <form method="POST" action="edit" enctype="multipart/form-data">
        <label for="name">Nama Motor:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($motor['name']) ?>" required>
        <br>
        <label for="price">Harga:</label>
        <input type="text" id="price" name="price" value="<?= htmlspecialchars($motor['price']) ?>" required>
        <br>
        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($motor['description']) ?></textarea>
        <br>
        <label for="image">Gambar:</label>
        <input type="file" id="image" name="image">
        <br>
        <p>Gambar saat ini:</p>
        <!-- <p><?php var_dump($motor['image']); ?></p> -->
        <img src="/motor_sales/public/uploads/<?= urlencode(htmlspecialchars($motor['image'])) ?>" alt="<?= htmlspecialchars($motor['name']) ?>" style="max-width: 400px;">
        <br>
        <button type="submit">Simpan</button>
    </form>
    <p><a href="/motor_sales/motors">Kembali ke daftar motor</a></p>
</body>
</html>