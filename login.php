<?php
include "database.php";
global $conn;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Cek siswa apakah ada di database
    $result = mysqli_query($conn, "SELECT * FROM siswa WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Verifikasi password apakah sesuai
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['email'] = $user['email'];
            $_SESSION['id_siswa'] = $user['id_siswa'];
            $_SESSION['nama_siswa'] = $user['nama_siswa'];
            $_SESSION['asal_sekolah'] = $user['asal_sekolah'];

            header('Location: dashboard.php');
            exit;
        } else {
            // Password Salah
            echo '<div class="message error floating-message">Password salah, silahkan coba lagi</div>';
        }
    } else {
        // User tidak ada
        echo '<div class="message error floating-message">Akun tidak ditemukan, silahkan buat akun terlebih dahulu</div>';
    }
}
?>

<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/classless.css">
        <link rel="stylesheet" href="css/tabbox.css">
        <link rel="stylesheet" href="css/themes.css">
        <meta name="viewport"
              content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edubridge - Login Siswa</title>
    </head>
    <body>
    <header>
        <?php include 'structure/navbar_no_account.php'; ?>
    </header>
    <main>
    <h1>Login - Siswa</h1>
    <p>Selamat datang di Edubridge!</p>
        <p>Untuk memulai menggunakan EduBridge, silahkan login akun terlebih dahulu.</p>
        <form action="login.php" method="post">
            <fieldset>
                <legend>Masuk Akun</legend>
                <label for="email">📧 Email (surel)</label>
                <input type="email" name="email" id="email" required autocomplete="email">
                <label for="password">🔐 Kata sandi</label>
                <input type="password" name="password" id="password" required autocomplete="current-password">
                <button type="submit"><img src="/img/icon/icons8-enter-50.svg" alt="login" class="icon">Login</button>
            </fieldset>
        </form>
        <fieldset>
            <legend>Opsi Lainnya</legend>
            <div class="row">
                <div class="col-6">
                    <button onclick="window.location.href='register.php';">🌐 Belum punya akun?</button>
                </div>
                <div class="col-6">
                    <button onclick="window.location.href='admin/login_admin.php';">🗝️ Login khusus admin</button>
                </div>
            </div>
    </fieldset>
    </main>
    </body>
    </html>