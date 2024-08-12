<?php include '../structure/check_conn_admin.php';
include '../database.php';
global $conn;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <link rel="stylesheet" href="../css/themes.css">
    <title>EduBridge - Daftar hasil rekomendasi jurusan</title>
</head>
<body>
<header>
    <?php include '../structure/navbar_admin.php'; ?>
</header>
<main>
    <h1>Hasil Rekomendasi Jurusan PT Siswa</h1>
    <p>Tabel hasil rekomendasi jurusan PT siswa</p>
    <table>
        <thead>
        <tr>
            <th>ID Siswa</th>
            <th>Nama</th>
            <th>Rekomendasi Jurusan</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT hr.*, s.nama_siswa
            FROM hasil_rekomendasi hr 
            JOIN siswa s ON hr.id_siswa = s.id_siswa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_siswa"] . "</td>";
                echo "<td>" . $row["nama_siswa"] . "</td>";
                echo "<td>" . $row["Jurusan_1"] . "</td>";
                echo "<td>" . $row["Jurusan_2"] . "</td>";
                echo "<td>" . $row["Jurusan_3"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
        }
        ?>
        </tbody>
    </table>
</main>
<footer>
    <?php include '../structure/footer.php'; ?>
</footer>
</body>
</html>