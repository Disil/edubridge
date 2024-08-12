<?php
    include 'structure/check_conn.php';
    include('database.php');
    global $conn;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - Informasi Tes RIASEC</title>
</head>
<body>
    <header><?php include 'structure/navbar.php'; ?></header>
    <main>
        <h1>Sekilas Mengenai Tes RIASEC</h1>
        <h2>Apa Itu Tes RIASEC?</h2>
        <p>Tes RIASEC adalah sebuah tes minat dan bakat berdasarkan tipe kepribadian seseorang. Jika belum pernah mengikuti tes RIASEC, silahkan jawab pertanyaan berikut ini untuk mengetahui nilai anda.</p>
        <p>Tidak ada jawaban salah dan benar, jawablah sesuai keadaan anda.</p>
        <h2>Cara Mengerjakan Tes</h2>
        <ul>
            <li>Tes berjumlah 90 soal. Waktu pengerjaan adalah sekitar 5-10 menit.</li>
            <li>Jawaban berupa pilihan ganda dengan format "Ya" atau "Tidak". Silahkan pilih salah satu, yang paling menggambarkan kondisi Anda saat ini.</li>
            <li>Tidak ada jawaban yang benar/salah.</li>
        </ul>
        <h2>Penjelasan Tipe Kepribadian</h2>
        <p>Ada 6 tipe kepribadian dalam tes RIASEC, yaitu:</p>
        <div class="tabs">
            <input type="radio" name="tabs" id="realistic" checked="checked">
            <label for="realistic">Realistic</label>
            <div class="tab">
                <h4>Realistic</h4>
                <p>Orang yang memiliki tipe kepribadian ini cenderung suka bekerja dengan hal-hal yang konkret dan praktis. Mereka biasanya menyukai aktivitas yang melibatkan keterampilan fisik dan mekanik.</p>
            </div>

            <input type="radio" name="tabs" id="investigative">
            <label for="investigative">Investigative</label>
            <div class="tab">
                <h4>Investigatif</h4>
                <p>Orang dengan tipe ini cenderung suka melakukan investigasi dan penelitian. Mereka menyukai kegiatan yang melibatkan pemecahan masalah kompleks dan penemuan ilmiah.</p>
            </div>

            <input type="radio" name="tabs" id="artistic">
            <label for="artistic">Artistic</label>
            <div class="tab">
                <h4>Artistic</h4>
                <p>Tipe ini menggambarkan orang yang memiliki kreativitas tinggi dan seni. Mereka biasanya menikmati kegiatan yang melibatkan ekspresi diri artistik, seperti seni visual atau musik</p>
            </div>

            <input type="radio" name="tabs" id="social">
            <label for="social">Social</label>
            <div class="tab">
                <h4>Sosial</h4>
                <p>Orang dengan tipe ini cenderung suka berinteraksi dengan orang lain dan membantu mereka. Mereka menyukai kegiatan yang melibatkan pelayanan masyarakat atau pekerjaan sosial.</p>
            </div>

            <input type="radio" name="tabs" id="enterprising">
            <label for="enterprising">Enterprising</label>
            <div class="tab">
                <h4>Enterprising</h4>
                <p>Tipe ini menggambarkan orang yang suka mengambil risiko dan berorientasi pada hasil. Mereka biasanya menikmati kegiatan yang melibatkan penjualan, kepemimpinan, atau pengembangan bisnis.</p>
            </div>

            <input type="radio" name="tabs" id="conventional">
            <label for="conventional">Conventional</label>
            <div class="tab">
                <h4>Konvensional</h4>
                <p>Orang dengan tipe ini cenderung suka kerapihan, keteraturan, dan prosedur yang terstruktur. Mereka biasanya menikmati kegiatan yang melibatkan administrasi, manajemen data, atau keuangan.</p>
            </div>
        </div>
        <p>Ayo, tunggu apalagi, mulai tes riasec nya sekarang juga!</p>
        <button><a href="tes_riasec.php"> Mulai Tes Riasec </a></button>
    </main>
</body>
</html>