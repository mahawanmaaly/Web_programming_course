<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login atau Register</title>
    <!-- Link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
        .btn-choice {
            margin: 10px 0;
        }
        .form-container {
            display: none;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1 class="mb-4">Login atau Register</h1>
        <p>Apakah Anda sudah memiliki akun?</p>
        
        <!-- Tombol Pilihan -->
        <div>
            <button id="loginBtn" class="btn btn-primary btn-choice">Login</button>
            <button id="registerBtn" class="btn btn-secondary btn-choice">Register</button>
        </div>

        <!-- Form Login -->
        <div id="loginForm" class="form-container">
            <h2>Login</h2>
            <form action="./backend/login.php" method="post">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
            </form>
        </div>

        <!-- Form Register -->
        <div id="registerForm" class="form-container">
            <h2>Register</h2>
            <form action="./backend/register.php" method="post">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi password" required>
                </div>
                <button type="submit" class="btn btn-success w-100" name="submit">Register</button>
            </form>
        </div>
    </div>

    <!-- Link JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menyembunyikan semua form saat halaman pertama kali dimuat
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'none';

        // Menampilkan form login jika tombol Login ditekan
        document.getElementById('loginBtn').onclick = function() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('registerForm').style.display = 'none';
        }

        // Menampilkan form register jika tombol Register ditekan
        document.getElementById('registerBtn').onclick = function() {
            document.getElementById('registerForm').style.display = 'block';
            document.getElementById('loginForm').style.display = 'none';
        }
    </script>
</body>
</html>
