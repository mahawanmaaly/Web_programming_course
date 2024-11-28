<?php
require './config/db.php';

// Mendapatkan ID produk dari parameter URL
$id = $_GET['id'];

// Ambil data produk berdasarkan ID
$product = mysqli_query($db_connect, "SELECT * FROM products WHERE id = $id");
$row = mysqli_fetch_assoc($product);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name']; // Mendapatkan nama gambar yang di-upload

    // Jika ada gambar baru yang di-upload
    if ($image != '') {
        // Tentukan folder untuk menyimpan gambar
        $target = "../upload/" . basename($image);

        // Pindahkan file gambar ke folder tujuan
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Update produk dengan gambar baru
            mysqli_query($db_connect, "UPDATE products SET name='$name', price='$price', image='$target' WHERE id=$id");
        } else {
            echo "Gagal mengupload gambar.";
            exit();
        }
    } else {
        // Jika tidak ada gambar baru, hanya update nama dan harga
        mysqli_query($db_connect, "UPDATE products SET name='$name', price='$price' WHERE id=$id");
    }

    // Redirect ke halaman data produk
    header("Location: show.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Lihat Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="show.php">Lihat Data Produk</a>
                    <li class="nav-item">
                        <a class="nav-link" href="backend/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container untuk Konten Halaman -->
    <div class="container">
        <h1 class="mb-4">Edit Produk</h1>

        <!-- Form Edit Produk -->
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk:</label>
                <input type="text" class="form-control" name="name" value="<?= $row['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga:</label>
                <input type="text" class="form-control" name="price" value="<?= $row['price']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar (Kosongkan jika tidak ada perubahan):</label>
                <input type="file" class="form-control" name="image">
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>

        <br>
        <a href="show.php" class="btn btn-secondary">Kembali ke Data Produk</a>
    </div>

    <!-- Link JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
