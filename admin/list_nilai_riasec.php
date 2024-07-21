<?php include '../structure/check_conn_admin.php';
include '../database.php';
global $conn;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <link rel="stylesheet" href="../css/themes.css">
    <title>EduBridge - Daftar hasil Tes RIASEC</title>
</head>
<body>
<header>
    <?php include '../structure/navbar_admin.php'; ?>
</header>
<main>
    <h1>Hasil Tes RIASEC Siswa</h1>
    <p>Tabel hasil tes RIASEC siswa</p>
    <table>
        <thead>
        <tr>
            <th>ID Siswa</th>
            <th>Nama</th>
            <th>Realistic</th>
            <th>Investigative</th>
            <th>Artistic</th>
            <th>Social</th>
            <th>Enterprising</th>
            <th>Conventional</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT nra.*, s.nama_siswa
            FROM nilai_riasec nra 
            JOIN siswa s ON nra.id_siswa = s.id_siswa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_siswa"] . "</td>";
                echo "<td>" . $row["nama_siswa"] . "</td>";
                echo "<td>" . $row["R"] . "</td>";
                echo "<td>" . $row["I"] . "</td>";
                echo "<td>" . $row["A"] . "</td>";
                echo "<td>" . $row["S"] . "</td>";
                echo "<td>" . $row["E"] . "</td>";
                echo "<td>" . $row["C"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
        }
        ?>
        </tbody>
</main>
</body>
<?php include '../structure/footer.php'; ?>
</html>