<?php
include "database.php";
global $conn;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);  // don't escape passwords

    // Look up the user in the database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // The user exists and the password is correct, so start a session
        session_start();
        $_SESSION['email'] = $user['email'];
        $_SESSION['id_siswa'] = $user['id_siswa'];

        // Redirect the user to the dashboard or wherever you want them to go after logging in
        header('Location: index.php');
        exit;
    } else {
        // The user doesn't exist or the password is incorrect
        echo "Invalid email or password";
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
        <?php include 'structure/header.php'; ?>
    </header>
    <main>
    <h1>Login</h1>
        <p>Untuk mengakses fitur Edubridge, silahkan login terlebih dahulu.</p>
        <form action="login.php" method="post">
            <fieldset>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <button type="submit">Login</button>
            </fieldset>
        </form>
        <a href="register.php">Register</a>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "Login successful";
            } else {
                echo "Login failed";
            }
        }
        ?>
    </main>
    </body>
    </html>