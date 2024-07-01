<?php
include('structure/check_conn.php');
include('database.php');
/** @var int $id_siswa */
/** @var mysqli $conn */
// SQL query to fetch the nilai_rapot_asli for the current user
$query = "SELECT * FROM edubridge_db.nilai_rapot_asli WHERE id_siswa = $id_siswa";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch the data
    $data = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($conn);
}
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
    <title>Input Nilai Rapot</title>
</head>
<body>
<header><?php include "structure/header.php"?></header>
<main>
<h1>Tabel nilai rapot siswa</h1>

</main>
</body>
</html>
