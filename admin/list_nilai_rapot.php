<?php include '../structure/check_conn_admin.php';
include '../database.php';
global $conn;

$searchTerm = $_GET['search'];
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
    <div class="row">
        <div class="col-6">
            <p>Tabel nilai rapot asli milik siswa</p>
        </div>
        <div class="col-6">
            <form action="list_nilai_rapot.php" method="get">
                <label for="search">Cari nilai rapot siswa berdasarkan nama</label>
                <input type="text" name="search" id="search" placeholder="Masukkan nama siswa">
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
    <?php if ($searchTerm) {
        echo "<b>Hasil pencarian: " . htmlspecialchars($searchTerm) . "</b>";
    } ?>
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

        if ($searchTerm) {
            $sql .= " WHERE s.nama_siswa LIKE '%$searchTerm%'";
        }
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id_siswa"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nama_siswa"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["matematika"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["fisika"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["kimia"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["biologi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["ekonomi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["geografi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["sosiologi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["bahasa_indonesia"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["bahasa_inggris"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["pjok"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["prakarya"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["sejarah"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["ppkn"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["seni_budaya"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Belum ada nilai rapot yang dimasukkan.";
        }
        ?>
        </tbody>
    </table>
</main>
</body>
<?php include '../structure/footer.php'; ?>
</html>