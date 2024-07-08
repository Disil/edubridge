<?php
include "../database.php";
global $conn;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Don't escape passwords

    // Look up the user in the database
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Verify the password using password_verify()
        if (password_verify($password, $user['password'])) {
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
        }
    } else {
        // The user doesn't exist
        echo "Invalid username or password";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <link rel="stylesheet" href="../css/themes.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edubridge - Login Admin</title>
</head>
<body>
<header>
    <?php include '../structure/header.php'; ?>
</header>
<main>
    <h1>Login</h1>
    <p><b>Khusus Admin.</b></p>
    <p>Untuk mengakses fitur Edubridge, silahkan login terlebih dahulu.</p>
    <form action="login.php" method="post">
        <fieldset>
            <label for="username">Nama Pengguna (username)</label>
            <input type="text" name="username" id="username" required autocomplete="username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required autocomplete="current-password">
            <button type="submit">Login</button>
        </fieldset>
    </form>
    <?php include '../structure/footer.php'; ?>
</main>
</body>
</html>