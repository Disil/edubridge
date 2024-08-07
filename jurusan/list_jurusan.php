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
    <script rel="script" src="../js/cekwarnadominan.js"></script>
    <style>
        img, svg {
            max-width: 70%;
            height: auto;
            margin: auto;
            display: inherit;
        }
        card {
            filter: blur(10px);
        }
    </style>
    <title>EduBridge - Daftar Jurusan</title>
</head>
<body>
<header>
    <?php include '../structure/navbar.php'; ?>
</header>
<main>
    <h1>Daftar Jurusan</h1>
    <p>Di sini kamu bisa melihat informasi lebih lanjut terkait dengan jurusan-jurusan yang ada di EduBridge.</p>
    <p>Catatan: Jurusan yang ada di sini adalah jurusan yang ada di EduBridge. Jika kamu ingin melihat jurusan yang ada di universitas lain, silakan kunjungi website resmi universitas tersebut.</p>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Teknik</b></p>
                <img src="../img/ilustrasi_jurusan/cubes-robotics-mechanics-engineering-and-automation.svg" alt="Ilustrasi Jurusan Teknik">
                <p>Jurusan Teknik adalah jurusan yang mempelajari tentang ilmu teknik, mulai dari teknik sipil, teknik mesin, teknik elektro, dan lain-lain.</p>
                <button onclick="window.location.href='teknik.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan MIPA (IPA Murni)</b></p>
                <img src="../img/ilustrasi_jurusan/bloom-biotech-lab-equipment-and-supplies.svg" alt="Ilustrasi Jurusan MIPA">
                <p>Jurusan MIPA adalah jurusan yang mempelajari tentang ilmu-ilmu dasar, mulai dari matematika, fisika, kimia, dan biologi.</p>
                <button onclick="window.location.href='mipa.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Kedokteran dan Keperawatan</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-hospital-bed-in-ward.svg" alt="Ilustrasi Jurusan Kedokteran dan Keperawatan">
                <p>Jurusan Kedokteran dan Keperawatan adalah jurusan yang mempelajari tentang ilmu kesehatan, mulai dari kedokteran, keperawatan, hingga farmasi.</p>
                <button onclick="window.location.href='kedokteran.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Ekonomi, Akuntansi, dan Manajemen</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-financial-analytics-on-stock-market.svg" alt="Ilustrasi Jurusan Ekonomi, Akuntansi, dan Manajemen">
                <p>Jurusan Ekonomi, Akuntansi, dan Manajemen adalah jurusan yang mempelajari tentang ilmu ekonomi, akuntansi, dan manajemen.</p>
                <button onclick="window.location.href='ekonomi_manajemen.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Ilmu Sosial dan Politik</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-financial-analytics-on-stock-market.svg" alt="Ilustrasi Jurusan Ilmu Sosial dan Politik">
                <p>Jurusan Ilmu Sosial dan Politik adalah jurusan yang mempelajari tentang ilmu sosial, mulai dari ilmu politik, sosiologi, hingga antropologi.</p>
                <button onclick="window.location.href='sospol.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Farmasi dan Kesehatan Masyarakat</b></p>
                <img src="../img/ilustrasi_jurusan/folks-doctor-with-pill-and-tablet-prescribing-medicine.svg" alt="Ilustrasi Jurusan Farmasi dan Kesehatan Masyarakat">
                <p>Jurusan Farmasi dan Kesehatan Masyarakat adalah jurusan yang mempelajari tentang ilmu farmasi dan kesehatan masyarakat.</p>
                <button onclick="window.location.href='farmasi.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Sekretaris dan Kearsipan</b></p>
                <img src="" alt="Ilustrasi Jurusan Sekretaris dan Kearsipan">
                <p>Jurusan Sekretaris dan Kearsipan adalah jurusan yang mempelajari tentang ilmu sekretaris dan kearsipan.</p>
                <button onclick="window.location.href='sekretaris.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Psikologi</b></p>
                <img src="" alt="Ilustrasi Jurusan Psikologi">
                <p>Jurusan Psikologi adalah jurusan yang mempelajari tentang ilmu psikologi.</p>
                <button onclick="window.location.href='psikologi.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Bahasa dan Sastra</b></p>
                <img src="" alt="Ilustrasi Jurusan Bahasa dan Sastra">
                <p>Jurusan Bahasa dan Sastra adalah jurusan yang mempelajari tentang ilmu bahasa dan sastra.</p>
                <button onclick="window.location.href='bahasa.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Kehutanan dan Pertanian</b></p>
                <img src="" alt="Ilustrasi Jurusan Kehutanan dan Pertanian">
                <p>Jurusan Kehutanan dan Pertanian adalah jurusan yang mempelajari tentang ilmu kehutanan dan pertanian.</p>
                <button onclick="window.location.href='kehutanan_pertanian.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
</main>
</body>
<?php include '../structure/footer.php'; ?>
</html>