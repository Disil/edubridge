<?php
include("../database.php");
global $conn;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_siswa = mysqli_real_escape_string($conn, $_POST["nama_siswa"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST["tanggal_lahir"]);
    $asal_sekolah = mysqli_real_escape_string($conn, $_POST["asal_sekolah"]);
    $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST["jenis_kelamin"]);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO wpcguvfn_edubridge_db.siswa (nama_siswa, email, password, tanggal_lahir, asal_sekolah, kelas, jenis_kelamin) VALUES ('$nama_siswa', '$email', '$hashed_password', '$tanggal_lahir', '$asal_sekolah', '$kelas', '$jenis_kelamin')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        echo "Registration successful. Silahkan login.";
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
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - Register page</title>
</head>
<body>
<h1>Register</h1>
<header>
    <?php include 'structure/header.php'; ?>
</header>
<form action="register.php" method="post">
    <fieldset>
        <label for="nama_siswa">Nama</label>
        <input type="text" name="nama_siswa" id="nama_siswa" required autocomplete="name">
        <label for="email">Alamat Email</label>
        <input type="email" name="email" id="email" required autocomplete="email">
        <label for="password">Sandi</label>
        <input type="password" name="password" id="password" required autocomplete="new-password">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
        <label for="kelas">Kelas</label>
        <select name="kelas" id="kelas" required>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
        <label for="asal_sekolah">Asal Sekolah</label>
        <input type="text" name="asal_sekolah" id="asal_sekolah" required>
        <label for="jenis_kelamin">Jenis Kelamin</label><br>
        <input type="radio" id="pria" name="jenis_kelamin" value="pria">
        <label for="pria">Pria</label><br>
        <input type="radio" id="wanita" name="jenis_kelamin" value="wanita">
        <label for="wanita">Wanita</label><br>
        <button type="submit">Register</button>
    </fieldset>
</form>
</body>
</html>