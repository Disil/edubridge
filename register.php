<?php
include("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST["tanggal_lahir"]);
    $asal_sekolah = mysqli_real_escape_string($conn, $_POST["asal_sekolah"]);
    $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);

    $sql = "INSERT INTO edubridge_mysql.biodata_user (nama, email, password, tanggal_lahir, asal_sekolah, kelas) VALUES ('$nama', '$email', '$password', '$tanggal_lahir', '$asal_sekolah', '$kelas')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EduBridge - Register page</title>
</head>
<body>
<h1>Register</h1>
<form action="register.php" method="post">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" required>
    <label for="email">Alamat Email</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Sandi</label>
    <input type="password" name="password" id="password" required>
    <label for="tanggal_lahir">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
    <label for="asal_sekolah">Asal Sekolah</label>
    <input type="text" name="asal_sekolah" id="asal_sekolah" required>
    <label for="kelas">Kelas</label>
    <input type="text" name="kelas" id="kelas" required>
    <button type="submit">Register</button>
</form>
</body>
</html>