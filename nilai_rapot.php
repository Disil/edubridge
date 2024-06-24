<?php
include('structure/check_conn.php');
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
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>Input Nilai Rapot</title>
</head>
<body>
    <header><?php include "structure/header.php"?></header>
    <h1>Input Nilai rapor pelajaran</h1>
    <form action="nilai_rapot.php" method="post">
        <fieldset>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
            <label for="mapel">Mata Pelajaran</label>
            <input type="text" name="mapel" id="mapel" required>
            <label for="nilai">Nilai</label>
            <input type="text" name="nilai" id="nilai" required>
            <input type="submit" value="Submit">
        </fieldset>

</body>