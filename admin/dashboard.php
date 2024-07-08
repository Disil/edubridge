<?php include '../structure/check_conn.php'; ?>
<?php include '../database.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <link rel="stylesheet" href="../css/themes.css">
    <title>EduBridge - Dashboard Admin</title>
</head>
<body>
<header>
    <?php include '../structure/header.php'; ?>
</header>
<main>
    <h1>Dashboard</h1>
    <p>Selamat datang, <?php echo $_SESSION['nama_siswa']?></p>
    <p>Untuk melihat daftar siswa, silahkan klik tombol dibawah ini.</p>
    <ul>
        <li><a href="list_siswa.php">Lihat Daftar Siswa</a></li>
    </ul>
</main>
<footer><?php include '../structure/footer.php'; ?></footer>
</body>
</html>