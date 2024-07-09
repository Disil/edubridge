<?php
include('structure/check_conn.php');
include('database.php');
global $conn;
global $id_siswa;

// SQL query to fetch the nilai_rapot_asli for the current user
$query = "SELECT * FROM wpcguvfn_edubridge_db.nilai_rapot WHERE id_siswa = $id_siswa";
$result = mysqli_query($conn, $query);
$dataRapot = [];

// Check if the query was successful
if ($result) {
    // Fetch the data
    $data = mysqli_fetch_assoc($result);
    $dataRapot = $data;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - Lihat Nilai Rapot</title>
</head>
<body>
<header><?php include "structure/header.php"?></header>
<main>
    <h1>Lihat nilai rapot</h1>
    <p></p>
    <?php if (!empty($dataRapot)): ?>
        <table class="styled-table">
            <thead>
            <tr>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>IPA</td>
                <td><?php echo htmlspecialchars($dataRapot['ipa']); ?></td>
            </tr>
            <tr>
                <td>IPS</td>
                <td><?php echo htmlspecialchars($dataRapot['ips']); ?></td>
            </tr>
            <tr>
                <td>Bahasa</td>
                <td><?php echo htmlspecialchars($dataRapot['bahasa']); ?></td>
            </tr>
            <tr>
                <td>Praktek</td>
                <td><?php echo htmlspecialchars($dataRapot['praktek']); ?></td>
            </tr>
            <tr>
                <td>Politik</td>
                <td><?php echo htmlspecialchars($dataRapot['politik']); ?></td>
            </tr>
            <tr>
                <td>Seni</td>
                <td><?php echo htmlspecialchars($dataRapot['seni']); ?></td>
            </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>No data found for the student.</p>
    <?php endif; ?>
    <p><a href ="tes_riasec_info.php">Klik disini</a> untuk lanjut ke tahapan tes riasec.</p>
</main>
</body>
</html>