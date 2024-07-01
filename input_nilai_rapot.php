<?php

include('structure/check_conn.php');

include('database.php');

global $id_siswa;

global $conn;


// Prepare and bind

$stmt = $conn->prepare("INSERT INTO edubridge_db.nilai_rapot_asli (id_siswa, nama, matematika, fisika, kimia, biologi, ekonomi, geografi, sosiologi, bahasa_indonesia, bahasa_inggris, pjok, prakarya, sejarah, ppkn, seni_budaya) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


$stmt->bind_param("issiiiiiiiiiiiii", $id_siswa, $nama, $matematika, $fisika, $kimia, $biologi, $ekonomi, $geografi, $sosiologi, $bahasa_indonesia, $bahasa_inggris, $pjok, $prakarya, $sejarah, $ppkn, $seni_budaya);


// Set parameters and execute

$matematika = $_POST['matematika'];

$fisika = $_POST['fisika'];

$kimia = $_POST['kimia'];

$biologi = $_POST['biologi'];

$ekonomi = $_POST['ekonomi'];

$geografi = $_POST['geografi'];

$sosiologi = $_POST['sosiologi'];

$bahasa_indonesia = $_POST['bahasa_indonesia'];

$bahasa_inggris = $_POST['bahasa_inggris'];

$pjok = $_POST['pjok'];

$prakarya = $_POST['prakarya'];

$sejarah = $_POST['sejarah'];

$ppkn = $_POST['ppkn'];

$seni_budaya = $_POST['seni_budaya'];


// Check if all required fields are filled
// !empty($id_siswa) && !empty($nama) && !empty($fisika) && !empty($kimia) && !empty($biologi) && !empty($ekonomi) && !empty($geografi) && !empty($sosiologi)

if (!empty($matematika)  && !empty($bahasa_indonesia) && !empty($bahasa_inggris) && !empty($pjok) && !empty($prakarya) && !empty($sejarah) && !empty($ppkn) && !empty($seni_budaya)) {

    if ($stmt->execute() === TRUE) {
        header("Location: nilai_rapot.php");
        echo "Anda berhasil mengisi nilai rapot siswa.";
    } else {
        echo "Error: " . $stmt->error;
    }

} else {

    echo "Error: Semua data harus diisi.";

} ?>

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
    <title>Input Nilai Rapot</title>
</head>
<body>
    <header><?php include "structure/header.php"?></header>
    <h1>Input Nilai rapor pelajaran</h1>
    <p>Silahkan masukkan nilai rapot semester terbaru.</p>
    <form action="input_nilai_rapot.php" method="post">
        <table>
            <tr>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
            </tr>
            <tr>
                <td><label for="matematika">Matematika:</label></td>
                <td><input type="number" id="matematika" name="matematika"></td>
            </tr>
            <tr>
                <td><label for="fisika">Fisika:</label></td>
                <td><input type="number" id="fisika" name="fisika"></td>
            </tr>
            <tr>
                <td><label for="kimia">Kimia:</label></td>
                <td><input type="number" id="kimia" name="kimia"></td>
            </tr>
            <tr>
                <td><label for="biologi">Biologi:</label></td>
                <td><input type="number" id="biologi" name="biologi"></td>
            </tr>
            <tr>
                <td><label for="ekonomi">Ekonomi:</label></td>
                <td><input type="number" id="ekonomi" name="ekonomi"></td>
            </tr>
            <tr>
                <td><label for="geografi">Geografi:</label></td>
                <td><input type="number" id="geografi" name="geografi"></td>
            </tr>
            <tr>
                <td><label for="sosiologi">Sosiologi:</label></td>
                <td><input type="number" id="sosiologi" name="sosiologi"></td>
            </tr>
            <tr>
                <td><label for="bahasa_indonesia">Bahasa Indonesia:</label></td>
                <td><input type="number" id="bahasa_indonesia" name="bahasa_indonesia"></td>
            </tr>
            <tr>
                <td><label for="bahasa_inggris">Bahasa Inggris:</label></td>
                <td><input type="number" id="bahasa_inggris" name="bahasa_inggris"></td>
            </tr>
            <tr>
                <td><label for="pjok">PJOK:</label></td>
                <td><input type="number" id="pjok" name="pjok"></td>
            </tr>
            <tr>
                <td><label for="prakarya">Prakarya:</label></td>
                <td><input type="number" id="prakarya" name="prakarya"></td>
            </tr>
            <tr>
                <td><label for="sejarah">Sejarah:</label></td>
                <td><input type="number" id="sejarah" name="sejarah"></td>
            </tr>
            <tr>
                <td><label for="ppkn">PPKN:</label></td>
                <td><input type="number" id="ppkn" name="ppkn"></td>
            </tr>
            <tr>
                <td><label for="seni_budaya">Seni Budaya:</label></td>
                <td><input type="number" id="seni_budaya" name="seni_budaya"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
</body>