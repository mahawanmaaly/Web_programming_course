<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki role 'user'
if ($_SESSION['role'] != 'user') {
    header('Location: index.php'); // Jika bukan user, redirect ke halaman login
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>

    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2>Profil Anda</h2>
            </div>
            <div class="card-body">
                <h4 class="card-title">Selamat datang, <?= $_SESSION['name']; ?>!</h4>
                <p class="card-text">Berikut adalah informasi akun Anda:</p>
                
                <ul class="list-group">
                    <li class="list-group-item"><strong>Email:</strong> <?= $_SESSION['email']; ?></li>
                    <li class="list-group-item"><strong>Nama Lengkap:</strong> <?= $_SESSION['name']; ?></li>
                    <li class="list-group-item"><strong>Role:</strong> <?= ucfirst($_SESSION['role']); ?></li>
                </ul>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="edit_profile.php" class="btn btn-warning">Edit Profil</a>
                    <a href="./backend/logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap JS dan dependensinya -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
