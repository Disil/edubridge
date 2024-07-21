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
    <title>EduBridge - Daftar minat</title>
</head>
<body>
<header>
    <?php include '../structure/navbar_admin.php'; ?>
</header>
<main>
    <h1>Daftar Minat Siswa</h1>
    <p>Tabel minat siswa</p>
    <table>
        <thead>
        <tr>
            <th>ID Siswa</th>
            <th>Nama</th>
            <th>Logika</th>
            <th>Sains</th>
            <th>Sosial</th>
            <th>Bisnis</th>
            <th>Kreatif</th>
            <th>Terapan</th>
            <th>Administratif</th>
            <th>Sastra</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT nm.*, s.nama_siswa
            FROM nilai_minat nm 
            JOIN siswa s ON nm.id_siswa = s.id_siswa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_siswa"] . "</td>";
                echo "<td>" . $row["nama_siswa"] . "</td>";
                echo "<td>" . $row["logika"] . "</td>";
                echo "<td>" . $row["sains"] . "</td>";
                echo "<td>" . $row["sosial"] . "</td>";
                echo "<td>" . $row["bisnis"] . "</td>";
                echo "<td>" . $row["kreatif"] . "</td>";
                echo "<td>" . $row["terapan"] . "</td>";
                echo "<td>" . $row["administratif"] . "</td>";
                echo "<td>" . $row["sastra"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        ?>
        </tbody>
    </table>
</main>
</body>
<?php include '../structure/footer.php'; ?>
</html>