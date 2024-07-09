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
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edubridge - Login file</title>
    </head>
    <body>
    <header>
        <?php include 'structure/header_no_account.php'; ?>
    </header>
    <main>
    <h1>Login</h1>
        <p>Untuk mengakses fitur Edubridge, silahkan login terlebih dahulu.</p>
        <form action="login.php" method="post">
            <fieldset>
                <label for="email">📧 Email</label>
                <input type="email" name="email" id="email" required autocomplete="email">
                <label for="password">🔐 Password</label>
                <input type="password" name="password" id="password" required autocomplete="current-password">
                <button type="submit"><img src="/img/icon/icons8-enter-50.svg" alt="login" class="icon">Login</button>
            </fieldset>
        </form>
        <a href="register.php">Register</a>
    </main>
    </body>
    </html>