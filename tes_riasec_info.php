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
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - Informasi Tes RIASEC</title>
</head>
<body>
    <header><?php include 'structure/header.php'; ?></header>
    <main>
        <h1>Info Tes RIASEC</h1>
        <h2>Apa itu tes RIASEC?</h2>
        <p>Tes RIASEC adalah sebuah tes minat dan bakat berdasarkan tipe kepribadian seseorang. Jika belum pernah mengikuti tes RIASEC, silahkan jawab pertanyaan berikut ini untuk mengetahui nilai anda.</p>
        <p>Tidak ada jawaban salah dan benar, jawablah sesuai keadaan anda.</p>
        <h2>Cara Mengerjakan Tes</h2>
        <ul>
            <li>Tes berjumlah 90 soal. Waktu pengerjaan adalah sekitar 5-10 menit.</li>
            <li>Jawaban berupa pilihan ganda dengan format "Ya" atau "Tidak". Silahkan pilih salah satu, yang paling menggambarkan kondisi Anda saat ini.</li>
            <li>Tidak ada jawaban yang benar/salah.</li>
        </ul>
        <h2>Apa saja yang diukur?</h2>
        <p>ada 6 tipe kepribadian yang diukur dalam tes ini, yaitu:</p>
        <ol>
            <li>Realistic</li>
            <li>Investigative</li>
            <li>Artistic</li>
            <li>Social</li>
            <li>Enterprising</li>
            <li>Conventional</li>
        </ol>
        <button><a href="tes_riasec.php"> Mulai Tes Riasec </a></button>
    </main>
</body>
</html>