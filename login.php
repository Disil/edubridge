<?php
include "database.php";
global $conn;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Don't escape passwords

    // Look up the user in the database
    $result = mysqli_query($conn, "SELECT * FROM siswa WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Verify the password using password_verify()
        if (password_verify($password, $user['password'])) {
            // The password is correct, so start a session
            session_start();
            $_SESSION['email'] = $user['email'];
            $_SESSION['id_siswa'] = $user['id_siswa'];
            $_SESSION['nama_siswa'] = $user['nama_siswa'];
            $_SESSION['asal_sekolah'] = $user['asal_sekolah'];

            // Redirect the user to the dashboard or wherever you want them to go after logging in
            header('Location: dashboard.php');
            exit;
        } else {
            // The password is incorrect
            echo '<div class="message error floating-message">Password salah, silahkan coba lagi</div>';
        }
    } else {
        // The user doesn't exist
        echo '<div class="message error floating-message">User tidak ditemukan</div>';
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
        <p>Untuk mengakses fitur Edubridge, silahkan login terlebih dahulu.</p>
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
                <div class="col-4">
                    <button disabled onclick="window.location.href='forgot_password.php';">🔑 Lupa kata sandi?</button>
                </div>
                <div class="col-4">
                    <button onclick="window.location.href='register.php';">🌐 Belum punya akun?</button>
                </div>
                <div class="col-4">
                    <button onclick="window.location.href='admin/login_admin.php';">🗝️ Login khusus admin</button>
                </div>
            </div>
    </fieldset>
    </main>
    </body>
    </html>