<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Motor</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Tambah Motor</h1>
    <form method="POST" action="/motor_sales/motors/create" enctype="multipart/form-data">
        <label for="name">Nama Motor:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="price">Harga:</label>
        <input type="text" id="price" name="price" required>
        <br>
        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="image">Gambar:</label>
        <input type="file" id="image" name="image" required>
        <br>
        <button type="submit">Simpan</button>
    </form>
    <p><a href="/motor_sales/motors">Kembali ke daftar motor</a></p>
</body>
</html>
