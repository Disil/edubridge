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
    <title>EduBridge - Daftar nilai rapot</title>
</head>
<body>
<header>
    <?php include '../structure/navbar_admin.php'; ?>
</header>
<main>
    <h1>Daftar Nilai Rapot Siswa</h1>
    <p>Tabel nilai rapot asli milik siswa</p>
    <table>
        <thead>
        <tr>
            <th>ID Siswa</th>
            <th>Nama</th>
            <th>Matematika</th>
            <th>Fisika</th>
            <th>Kimia</th>
            <th>Biologi</th>
            <th>Ekonomi</th>
            <th>Geografi</th>
            <th>Sosiologi</th>
            <th>Bahasa Indonesia</th>
            <th>Bahasa Inggris</th>
            <th>PJOK</th>
            <th>Prakarya</th>
            <th>Sejarah</th>
            <th>PPKN</th>
            <th>Seni Budaya</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT nra.*, s.nama_siswa
            FROM nilai_rapot_asli nra 
            JOIN siswa s ON nra.id_siswa = s.id_siswa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_siswa"] . "</td>";
                echo "<td>" . $row["nama_siswa"] . "</td>";
                echo "<td>" . $row["matematika"] . "</td>";
                echo "<td>" . $row["fisika"] . "</td>";
                echo "<td>" . $row["kimia"] . "</td>";
                echo "<td>" . $row["biologi"] . "</td>";
                echo "<td>" . $row["ekonomi"] . "</td>";
                echo "<td>" . $row["geografi"] . "</td>";
                echo "<td>" . $row["sosiologi"] . "</td>";
                echo "<td>" . $row["bahasa_indonesia"] . "</td>";
                echo "<td>" . $row["bahasa_inggris"] . "</td>";
                echo "<td>" . $row["pjok"] . "</td>";
                echo "<td>" . $row["prakarya"] . "</td>";
                echo "<td>" . $row["sejarah"] . "</td>";
                echo "<td>" . $row["ppkn"] . "</td>";
                echo "<td>" . $row["seni_budaya"] . "</td>";
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