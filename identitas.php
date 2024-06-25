<?php include 'structure/check_conn.php'; ?>
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
    <title>Edubridge - Edit Identitas Anda</title>
</head>
<body>
<header>
    <?php include 'structure/header.php'; ?>
</header>
<main>
    <h1>Edit Identitas Anda</h1>
    <p>Anda dapat mengubah informasi identitas Anda di sini.</p>
    <form action="identitas.php" method="post">
        <fieldset>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Sandi</label>
            <input type="password" name="password" id="password" required>
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
            <label for="gender">Gender:</label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>
            <button type="submit">Register</button>
        </fieldset>
    </form>

</main>
<footer><?php include 'structure/footer.php'; ?></footer>