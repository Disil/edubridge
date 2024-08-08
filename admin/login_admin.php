<?php
include "../database.php";
global $conn;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Don't escape passwords

    // Look up the user in the database
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && $user['password'] === $password) {
        // The password is correct, so start a session
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['id_admin'] = $user['id_admin'];
        // Redirect the user to the dashboard or wherever you want them to go after logging in
        header('Location: dashboard.php');
        exit;
    } else {
        // The password is incorrect
        echo "Invalid username or password";
} }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <link rel="stylesheet" href="../css/themes.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edubridge - Login Admin</title>
</head>
<body>
<header>
    <?php include '../structure/navbar_no_account.php'; ?>
</header>
<main>
    <h1>Login - Admin</h1>
    <p><b>Khusus Admin.</b></p>
    <p>Untuk mengakses fitur Edubridge, silahkan login terlebih dahulu.</p>
    <form action="login_admin.php" method="post">
        <fieldset>
            <legend>Masuk Akun</legend>
            <label for="username">Nama Pengguna (username)</label>
            <input type="text" name="username" id="username" required autocomplete="username">
            <label for="password">Kata sandi</label>
            <input type="password" name="password" id="password" required autocomplete="current-password">
            <button type="submit">Login</button>
        </fieldset>
    </form>
    <fieldset>
        <legend>Opsi Lainnya</legend>
        <div class="row">
            <div class="col-6">
                <button disabled onclick="window.location.href='forgot_password.php';">🔑 Lupa kata sandi?</button>
            </div>
            <div class="col-6">
                <button onclick="window.location.href='../login.php';">🗝️ Login siswa</button>
            </div>
        </div>
    </fieldset>
    <?php include '../structure/footer.php'; ?>
</main>
</body>
</html>