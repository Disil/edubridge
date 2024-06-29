<?php
include('structure/check_conn.php');
include('database.php');
/** @var int $id_siswa */
/** @var mysqli $conn */

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
<h1>Tabel nilai rapot siswa</h1>
<?php
// Execute SQL query
$result = mysqli_query($conn, "SELECT * FROM edubridge_mysql.nilai_rapot_asli WHERE id_siswa = $id_siswa");

// Start table
echo "<table>";
echo "<tr>";
echo "<th>Subject</th>";
echo "<th>Grade</th>";
echo "</tr>";

// Fetch and display each row of data
while ($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $subject => $grade) {
        if ($subject != 'id_siswa') {
            echo "<tr>";
            echo "<td>" . str_replace('_', ' ', ucfirst($subject)) . "</td>";
            echo "<td>" . $grade . "</td>";
            echo "</tr>";
        }
    }
}

// End table
echo "</table>";
?>
</body>
</html>
