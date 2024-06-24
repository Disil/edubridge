<?php include 'structure/check_conn.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - Dashboard for Admin</title>
</head>
<body>
    <header>
        <?php include 'structure/header.php'; ?>
    </header>
    <main>
        <h1>Dashboard - for Admin</h1>
        <p>Selamat datang, <?php echo $_SESSION['email']?></p>
        <p>EduBridge adalah website untuk memilih jurusan. Silahkan pergi ke halaman yang tersedia untuk mengisi informasi yang diperlukan.</p>
    </main>
<footer><?php include 'structure/footer.php'; ?></footer>
</body>
</html>