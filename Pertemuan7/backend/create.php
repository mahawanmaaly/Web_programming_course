<?php
require '../config/db.php';

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    // Cek apakah file diupload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Ambil informasi file
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];

        // Tentukan lokasi folder upload
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/'; // Sesuaikan dengan folder upload Anda
        $dest_path = $uploadDirectory . $fileName;

        // Cek apakah file bisa dipindahkan
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            echo 'File berhasil diupload.';
        } else {
            echo 'Gagal mengunggah gambar.';
        }
    } else {
        echo 'Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah file.';
    }

    // Masukkan data produk ke database
    $query = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$fileName')";
    if (mysqli_query($db_connect, $query)) {
        header("Location: ../show.php");
        exit();
    } else {
        echo 'Gagal menyimpan data produk.';
    }
}
?>
