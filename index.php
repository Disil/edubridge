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
    <title>EduBridge - Dashboard</title>
</head>
<body>
    <header>
        <?php include 'structure/header.php'; ?>
    </header>
    <main>
        <h1>Dashboard</h1>
        <p>Selamat datang, <?php echo $_SESSION['nama']?>! Anda berasal dari <?php echo $_SESSION['asal_sekolah']?></p>
        <p>EduBridge adalah sistem pendukung keputusan yang membantu siswa sekolah menengah memilih jurusan kuliah mereka. Dengan memasukkan nilai rapor sekolah menengah dan mengikuti tes RIASEC, siswa dapat menerima rekomendasi yang dipersonalisasi berdasarkan algoritma fuzzy MCDM (Multi-Criteria Decision Making).</p>
        <h2> Latar Belakang dan Tujuan </h2>
        <p>EduBridge lahir dari keresahan peneliti terhadap kondisi perkuliahan di Indonesia saat ini. Faktanya, banyak mahasiswa yang merasa tidak cocok dengan jurusan yang mereka pilih. Hal ini disebabkan oleh berbagai faktor, seperti kurangnya informasi, tekanan dari orang tua, atau kurangnya pemahaman tentang minat dan bakat mereka sendiri.</p>

        <p>Oleh karena itu, kami tergerak untuk membuat situs EduBridge. Situs ini bertujuan untuk menyederhanakan proses ini dengan memberikan rekomendasi jurusan berdasarkan hasil analisis kinerja akademis siswa (dalam bentuk nilai rapot), menggabungkannya dengan hasil tes RIASEC (Realistic, Investigative, Artistic, Social, Enterprising, Conventional).</p>

    <h2>OPSI 2024</h2>
        <p>EduBridge dibuat dalam rangka <a href="https://sma.pusatprestasinasional.kemdikbud.go.id/opsi/">Olimpiade Penelitian Siswa Indonesia (OPSI) 2024</a>. Kami berharap dengan adanya situs ini, siswa dapat memilih jurusan kuliah mereka dengan lebih bijak dan sesuai dengan minat dan bakat mereka. Tentu, banyak faktor lain yang harus dipertimbangkan. Namun kami harap, situs ini dapat membantu meyakinkan diri sendiri jika <i>galau</i> terkait dengan pilihan jurusan.</p>
    </main>
<footer><?php include 'structure/footer.php'; ?></footer>
</body>
</html>