<?php include '../structure/check_conn.php';
include '../database.php'; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <link rel="stylesheet" href="../css/themes.css">
    <title>EduBridge - Daftar Jurusan</title>
</head>
<body>
<header>
    <?php include '../structure/navbar.php'; ?>
</header>
<main>
    <h1>Daftar Jurusan</h1>
    <p>Di sini kamu bisa melihat informasi lebih lanjut terkait dengan jurusan-jurusan yang ada di EduBridge.</p>
    <ul>
        <li><a href="teknik.php">Jurusan Teknik</a></li>
        <li><a href="mipa.php">Jurusan MIPA (IPA Murni)</a></li>
        <li><a href="kedokteran.php">Jurusan Kedokteran dan Keperawatan</a></li>
        <li><a href="ekonomi_manajemen.php">Jurusan Ekonomi, Akuntansi, dan Manajemen</a></li>
        <li><a href="sospol.php">Jurusan Ilmu Sosial dan Politik</a></li>
        <li><a href="farmasi.php">Jurusan Farmasi dan Kesehatan Masyarakat</a></li>
        <li><a href="sekretaris.php">Jurusan Sekretaris dan Kearsipan</a></li>
        <li><a href="psikologi.php">Jurusan Psikologi</a></li>
        <li><a href="bahasa.php">Jurusan Bahasa dan Sastra</a></li>
        <li><a href="kehutanan_pertanian.php">Jurusan Kehutanan dan Pertanian</a></li>
    </ul>
</main>
</body>
<?php include '../structure/footer.php'; ?>
</html>