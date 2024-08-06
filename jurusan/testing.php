<?php include '../structure/check_conn.php';
include '../database.php'; ?>

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
    <title>EduBridge - Testing</title>
</head>
<body>
<header>
    <?php include '../structure/navbar.php'; ?>
</header>
<main>
    <h1>Khusus testing</h1>
<div class="container mt-5">
    <div class="row">

      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="gambar_jurusan_1.jpg" class="card-img-top" alt="Gambar Jurusan 1">
          <div class="card-body">
            <h5 class="card-title">Teknik Informatika</h5>
            <p class="card-text">Pelajari tentang pengembangan perangkat lunak, pemrograman, dan teknologi informasi.</p>
            <a href="detail_jurusan_1.html" class="btn btn-primary">Selengkapnya</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="gambar_jurusan_2.jpg" class="card-img-top" alt="Gambar Jurusan 2">
          <div class="card-body">
            <h5 class="card-title">Ilmu Komunikasi</h5>
            <p class="card-text">Mempelajari komunikasi efektif, media, jurnalistik, dan hubungan masyarakat.</p>
            <a href="detail_jurusan_2.html" class="btn btn-primary">Selengkapnya</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="gambar_jurusan_3.jpg" class="card-img-top" alt="Gambar Jurusan 3">
          <div class="card-body">
            <h5 class="card-title">Manajemen Bisnis</h5>
            <p class="card-text">Pelajari tentang pengelolaan bisnis, pemasaran, keuangan, dan sumber daya manusia.</p>
            <a href="detail_jurusan_3.html" class="btn btn-primary">Selengkapnya</a>
          </div>
        </div>
      </div>

    </div> </div>
</main>
<footer>
    <?php include '../structure/footer.php'; ?>
</body>
</html>