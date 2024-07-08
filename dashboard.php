<?php include 'structure/check_conn.php'; ?>
<?php include 'database.php'; ?>
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
    <title>EduBridge - Dashboard</title>
</head>
<body>
    <header>
        <?php include 'structure/header.php'; ?>
    </header>
    <main>
        <h1>Dashboard</h1>
        <p>Selamat datang, <?php echo $_SESSION['nama_siswa']?>! Anda berasal dari <?php echo $_SESSION['asal_sekolah']?></p>
        <p>EduBridge adalah sistem pendukung keputusan yang membantu siswa sekolah menengah memilih jurusan kuliah mereka. Dengan memasukkan nilai rapor sekolah menengah dan mengikuti tes RIASEC, siswa dapat menerima rekomendasi yang dipersonalisasi berdasarkan algoritma fuzzy MCDM (Multi-Criteria Decision Making).</p>
        <p>Untuk mendapatkan rekomendasi jurusan, silahkan mulai dari mengisi nilai rapot berdasarkan semester terbaru, lalu dilanjutkan dengan tes RIASEC untuk mengukur bakat dan minat. Setelah itu, anda bisa melihat hasil rekomendasi jurusan beserta dengan penjelasannya.</p>
        <ul>
            <li><a href="nilai_rapot.php">Input Nilai Rapot</a></li>
            <li><a href="tes_riasec_info.php">Tes RIASEC</a></li>
            <li><a href="hasil_rekomendasi.php">Lihat hasil rekomendasi</a></li>
        </ul>
    </main>
<footer><?php include 'structure/footer.php'; ?></footer>
</body>
</html>