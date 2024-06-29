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
    <title>Tes RIASEC</title>
</head>
<body>
    <header><?php include 'structure/header.php'; ?></header>
    <main>
        <h1>Tes RIASEC</h1>
        <h2>Apa itu tes RIASEC?</h2>
        <p>Tes RIASEC adalah sebuah tes minat dan bakat berdasarkan tipe kepribadian seseorang. Jika belum pernah mengikuti tes RIASEC, silahkan jawab pertanyaan berikut ini untuk mengetahui nilai anda.</p>
        <p>Tidak ada jawaban salah dan benar, jawablah sesuai keadaan anda.</p>
        <h2>Cara mengerjakan Tes</h2>
        <ul>
            <li>Tes terbagi menjadi 6 bagian, masing-masing memiliki 15 pernyataan. Waktu pengerjaan adalah sekitar 5-10 menit.</li>
            <li>Centang kotak di pernyataan yang menurutmu paling benar (tidak ada ketentuan maksimal atau minimal centang).</li>
            <li>Setiap kotak yang dicentang bernilai 1 poin.</li>
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
        <button></button>
    <?php phpinfo(); ?>
    </main>
</body>
</html>