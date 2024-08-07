<?php include 'structure/check_conn.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edubridge - Tentang</title>
</head>
<body>
<header>
    <?php include 'structure/navbar.php'; ?>
</header>
<main>
    <h1>Tentang EduBridge</h1>
    <p>EduBridge adalah situs web yang akan membantu siswa sekolah menengah atas dalam memilih jurusan kuliah. Dengan memasukkan nilai rapor sekolah menengah dan mengikuti tes RIASEC, siswa dapat menerima rekomendasi yang dipersonalisasi berdasarkan algoritma fuzzy MCDM (Multi-Criteria Decision Making).</p>
    <h2>Fitur utama</h2>
    <p>Didalam situs ini, siswa dapat melakukan hal berikut:</p>
    <ul>
        <li>Penghitungan Nilai Rapot</li>
        <li>Mengambil Tes RIASEC</li>
        <li>Memasukkan minat pribadi</li>
        <li>Mendapatkan rekomendasi jurusan kuliah</li>
        <li>Mendapatkan pengetahuan mengenai kegiatan pembelajaran serta prospek karir pada suatu jurusan kuliah</li>
    </ul>
    <p>Sebagai admin, terdapat fitur untuk memudahkan pengelolaan data siswa dan acuan jurusan kuliah. Fitur ini meliputi:</p>
    <ul>
        <li>Menambahkan, mengubah, dan menghapus data siswa</li>
        <li>Menambahkan, mengubah, dan menghapus data jurusan kuliah</li>
        <li>Melihat data rekomendasi jurusan kuliah</li>
        <li>Melihat data nilai siswa</li>
    </ul>
    <h2>Cara kerja</h2>
    <p>Setelah siswa memasukkan nilai rapor, mengikuti tes RIASEC, dan memasukkan minat pribadi, sistem akan menghitung nilai fuzzy MCDM. Nilai ini akan digunakan untuk memberikan rekomendasi jurusan kuliah yang sesuai dengan minat dan kemampuan siswa.</p>
    <h2>OPSI 2024</h2>
    <p>EduBridge dibuat dalam rangka <a href="https://sma.pusatprestasinasional.kemdikbud.go.id/opsi/">Olimpiade Penelitian Siswa Indonesia (OPSI) 2024</a></p>
    <p>Kami berharap dengan adanya situs ini, siswa dapat memilih jurusan kuliah mereka dengan lebih bijak dan sesuai dengan minat dan bakat mereka. Tentu, banyak faktor lain yang harus dipertimbangkan. Namun kami harap, situs ini dapat membantu meyakinkan diri sendiri jika _galau_ terkait dengan pilihan jurusan.</p>
    <p>EduBridge dikembangkan oleh tim peneliti Edulogy yang berasal dari SMA Negeri 1 Ciruas, kelas XII IPA 6. Tim ini terdiri dari:</p>
    <ul>
        <li>Satria Nugraha (Peneliti 1)</li>
        <li>Muhammad Raja Ghathfaan (Peneliti 2)</li>
    </ul>
    <p>Terima kasih kepada Ibu Nur Asmainah, S.Kom. selaku pembimbing sejak awal hingga saat ini. Tak lupa pula terima kasih kepada orang tua, teman-teman, dan semua pihak yang telah membantu dalam proses pengembangan projek ini.</p>
    <p>Terima kasih juga buat kamu, yang sudah mau mencoba situs ini. Semoga bermanfaat! Doakan agar penelitian kami masuk final ya!</p>
</main>
<footer>
    <?php include 'structure/footer.php'; ?>
</footer>
</body>
</html>