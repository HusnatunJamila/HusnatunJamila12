<?php
// Aktifkan session
session_start();

// Panggil koneksi database
include 'koneksi.php';

$username = mysqli_escape_string($koneksi, $_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Cek apakah form login telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Query untuk mendapatkan data user berdasarkan username
    $login = mysqli_query($koneksi, "SELECT * FROM t_user WHERE username = '$username' AND status = 'aktif'");
    $data = mysqli_fetch_array($login);

    // Uji apakah username ditemukan
    if ($data) {
        // Verifikasi password
        if (password_verify($password, $data['password'])) {
            // Password cocok, login berhasil
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama_pengguna'] = $data['nama_pengguna'];

            // Arahkan ke halaman admin
            header('Location: admin.php');
            exit;
        } else {
            echo "<script>
                    alert('Password salah. Silakan coba lagi.');
                    document.location='index.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Username tidak ditemukan atau status tidak aktif.');
                document.location='index.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="login-container">
    <img alt="Logo of Lombok Timur" height="120" src="img/logo.png" width="100"/>
    <h2>Selamat Datang</h2>
    <p>Silahkan Login</p>
    <form class="user" action="cek_login.php" method="POST">
        <div class="form-group">
            <input type="text" name="username" class="form-control form-control-user" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
        </div>
        <button type="submit">Login</button>
    </form>

    <!-- Tambahkan link untuk registrasi pengguna baru -->
    <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
</div>
</body>
</html>
