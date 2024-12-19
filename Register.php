<?php
// Sertakan file konfigurasi untuk koneksi database
include 'koneksi.php';

// Inisiasi variabel error untuk pesan kesalahan
$error = '';

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $nama_pengguna = $_POST['nama_pengguna'] ?? '';
    $email = $_POST['email'] ?? '';
    $nomor_telepon = $_POST['nomor_telepon'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    // Cek apakah semua field telah diisi
    if (empty($username) || empty($password) || empty($nama_pengguna) || empty($email) || empty($nomor_telepon) || empty($alamat)) {
        $error = "Semua field harus diisi.";
    } else {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah username sudah ada di tabel t_user
        $sql_cek = "SELECT * FROM t_user WHERE username = ?";
        $stmt_cek = $koneksi->prepare($sql_cek);

        if (!$stmt_cek) {
            die("Error preparing statement: " . $koneksi->error);
        }

        $stmt_cek->bind_param("s", $username);
        $stmt_cek->execute();
        $result_cek = $stmt_cek->get_result();

        if ($result_cek->num_rows > 0) {
            $error = "Username sudah terdaftar. Silakan gunakan username lain.";
        } else {
            // Insert data ke tabel t_user
            $sql_user = "INSERT INTO t_user (username, password, nama_pengguna, status) VALUES (?, ?, ?, 'aktif')";
            $stmt_user = $koneksi->prepare($sql_user);

            if ($stmt_user) {
                $stmt_user->bind_param("sss", $username, $hashed_password, $nama_pengguna);

                if ($stmt_user->execute()) {
                    // Dapatkan ID pengguna yang baru ditambahkan
                    $id_user = $koneksi->insert_id;

                    // Insert data ke tabel t_register
                    $sql_register = "INSERT INTO t_register (id_user, email, nomor_telepon, alamat) VALUES (?, ?, ?, ?)";
                    $stmt_register = $koneksi->prepare($sql_register);

                    if ($stmt_register) {
                        $stmt_register->bind_param("isss", $id_user, $email, $nomor_telepon, $alamat);

                        if ($stmt_register->execute()) {
                            // Tampilkan popup menggunakan JavaScript
                            echo "<script>alert('Registrasi berhasil!'); window.location.href='login.php';</script>";
                        } else {
                            $error = "Error: " . $stmt_register->error;
                        }
                    } else {
                        $error = "Error preparing statement: " . $koneksi->error;
                    }
                } else {
                    $error = "Error: " . $stmt_user->error;
                }
            } else {
                $error = "Error preparing statement: " . $koneksi->error;
            }
        }

        // Tutup statement
        if (isset($stmt_cek)) $stmt_cek->close();
        if (isset($stmt_user)) $stmt_user->close();
        if (isset($stmt_register)) $stmt_register->close();

        // Arahkan ke halaman admin
            header('Location: cek_login.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <style>
        /* CSS Styling */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #1e8e8e, #a8e063);
            font-family: 'Roboto', sans-serif;
        }
        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .login-container h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 500;
            color: #333;
        }
        .login-container p {
            font-size: 16px;
            color: #666;
            margin: 10px 0;
        }
        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container input[type="email"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background: #1e8e8e;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container button:hover {
            background: #166666;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Form Register</h2>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="nama_pengguna" placeholder="Nama Pengguna" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="nomor_telepon" placeholder="Nomor Telepon" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <button type="submit"> <a href="cek_login.php"></a>Daftar</button>
            
        </form>
    </div>
</body>
</html>
