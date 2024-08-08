<?php include '../structure/check_conn.php';
include '../database.php'; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <style>
        img, svg {
            max-width: 50%;
            margin: auto;
            display: inherit;
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
                <img src="../img/ilustrasi_jurusan/isometric-disposal-of-archives-in-paper-shredder.svg" alt="Ilustrasi Jurusan Sekretaris dan Kearsipan">
                <p>Jurusan Sekretaris dan Kearsipan adalah jurusan yang mempelajari tentang ilmu sekretaris dan kearsipan.</p>
                <button onclick="window.location.href='sekretaris.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Psikologi</b></p>
                <img src="../img/ilustrasi_jurusan/bloom-42.svg" alt="Ilustrasi Jurusan Psikologi">
                <p>Jurusan Psikologi adalah jurusan yang mempelajari tentang ilmu psikologi.</p>
                <button onclick="window.location.href='psikologi.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Bahasa dan Sastra</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-language-learning-app-on-smartphone-screen.svg" alt="Ilustrasi Jurusan Bahasa dan Sastra">
                <p>Jurusan Bahasa dan Sastra adalah jurusan yang mempelajari tentang ilmu bahasa dan sastra.</p>
                <button onclick="window.location.href='bahasa.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Kehutanan dan Pertanian</b></p>
                <img src="../img/ilustrasi_jurusan/stripy-lumberjack-with-an-ax-in-the-forest.svg" alt="Ilustrasi Jurusan Kehutanan dan Pertanian">
                <p>Jurusan Kehutanan dan Pertanian adalah jurusan yang mempelajari tentang ilmu kehutanan dan pertanian.</p>
                <button onclick="window.location.href='kehutanan_pertanian.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Peternakan dan Perikanan</b></p>
                <img src="../img/ilustrasi_jurusan/pablo-cow-grazing-in-a-pasture.svg" alt="Ilustrasi Peternakan dan Perikanan">
                <p>Jurusan Peternakan dan Perikanan adalah jurusan yang mempelajari tentang ilmu peternakan dan perikanan.</p>
                <button onclick="window.location.href='peternakan_perikanan.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Desain dan Seni</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-computer-and-drawing-tablet-for-a-digital-artist.svg" alt="Ilustrasi Jurusan Desain dan Seni">
                <p>Jurusan Desain dan Seni adalah jurusan yang mempelajari tentang ilmu desain dan seni.</p>
                <button onclick="window.location.href='seni.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Filsafat</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-man-watching-tv-at-home.svg" alt="Ilustrasi Filsafat">
                <p>Jurusan Filsafat adalah jurusan yang mempelajari tentang ilmu filsafat.</p>
                <button onclick="window.location.href='filsafat.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Kependidikan</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-backpack-and-stationery-for-going-back-to-school.svg" alt="Ilustrasi Jurusan Kependidikan">
                <p>Jurusan Kependidikan adalah jurusan yang mempelajari tentang ilmu kependidikan.</p>
                <button onclick="window.location.href='kependidikan.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Pariwisata dan Perhotelan</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-travel-plans-including-hotel-booking-plane-tickets-and-suitcase.svg" alt="Ilustrasi Jurusan Pariwisata dan Perhotelan">
                <p>Jurusan Pariwisata dan Perhotelan adalah jurusan yang mempelajari tentang ilmu pariwisata dan perhotelan.</p>
                <button onclick="window.location.href='pariwisata.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Meteorologi dan Geologi</b></p>
                <img src="../img/ilustrasi_jurusan/lounge-searching-and-star-gazing.svg" alt="Ilustrasi Jurusan Meteorologi dan Geologi">
                <p>Jurusan Meteorologi dan Geologi adalah jurusan yang mempelajari tentang ilmu meteorologi dan geologi.</p>
                <button onclick="window.location.href='meteorologi.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Astronomi</b></p>
                <img src="../img/ilustrasi_jurusan/lounge-searching-and-star-gazing.svg" alt="Ilustrasi Jurusan Astronomi">
                <p>Jurusan Astronomi adalah jurusan yang mempelajari tentang ilmu astronomi.</p>
                <button onclick="window.location.href='astronomi.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Antropologi dan Sejarah</b></p>
                <img src="../img/ilustrasi_jurusan/tiny-woman-and-a-man-studying-history.svg" alt="Ilustrasi Jurusan Antropologi dan Sejarah">
                <p>Jurusan Antropologi dan Sejarah adalah jurusan yang mempelajari tentang ilmu antropologi dan sejarah.</p>
                <button onclick="window.location.href='antropologi.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Komunikasi</b></p>
                <img src="../img/ilustrasi_jurusan/isometric-people-talking-on-online-dating-platform.svg" alt="Ilustrasi Jurusan Komunikasi">
                <p>Jurusan Komunikasi adalah jurusan yang mempelajari tentang ilmu komunikasi.</p>
                <button onclick="window.location.href='komunikasi.php';">Info Selengkapnya</button>
            </div>
        </div>
        <div class="col-6">
            <div class="card info">
                <p><b>Jurusan Lingkungan Hidup</b></p>
                <img src="../img/ilustrasi_jurusan/urban-line-eco-planet.svg" alt="Ilustrasi Jurusan Lingkungan Hidup">
                <p>Jurusan Lingkungan Hidup adalah jurusan yang mempelajari tentang ilmu lingkungan hidup.</p>
                <button onclick="window.location.href='lingkungan.php';">Info Selengkapnya</button>
            </div>
        </div>
    </div>
</main>
</body>
<?php include '../structure/footer.php'; ?>
</html>