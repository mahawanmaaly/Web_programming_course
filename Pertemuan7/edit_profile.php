<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki role 'user'
if ($_SESSION['role'] != 'user') {
    header('Location: index.php'); // Jika bukan user, redirect ke halaman login
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "pemweb"; // Ganti dengan nama database yang sesuai

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data user dari session
$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang diubah dari form
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Update query jika ada perubahan
    if ($new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Enkripsi password
        $sql = "UPDATE users SET name='$new_name', email='$new_email', password='$hashed_password' WHERE id='$user_id'";
    } else {
        $sql = "UPDATE users SET name='$new_name', email='$new_email' WHERE id='$user_id'";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['name'] = $new_name; // Update session dengan data baru
        $_SESSION['email'] = $new_email;
        header('Location: profile.php'); // Redirect ke halaman profil setelah update
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Ambil data profil pengguna saat ini
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2>Edit Profil Anda</h2>
            </div>
            <div class="card-body">
                <form action="edit_profile.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="profile.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
