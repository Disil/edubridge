<?php include '../structure/check_conn.php';
include '../database.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_jurusan = $_POST['nama_jurusan'];
    $ipa = $_POST['ipa'];
    $ips = $_POST['ips'];
    $bahasa = $_POST['bahasa'];
    $praktek = $_POST['praktek'];
    $politik = $_POST['politik'];
    $seni = $_POST['seni'];
    $R = $_POST['R'];
    $I = $_POST['I'];
    $A = $_POST['A'];
    $S = $_POST['S'];
    $E = $_POST['E'];
    $C = $_POST['C'];

    $query = "INSERT INTO acuan_nilai_jurusan (id_jurusan, nama_jurusan, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C) VALUES (id_jurusan, '$nama_jurusan', '$ipa', '$ips', '$bahasa', '$praktek', '$politik', '$seni', '$R', '$I', '$A', '$S', '$E', '$C')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Data gagal ditambahkan";
    }
}


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
    <title>EduBridge - Kelola Jurusan</title>
</head>
<body>
<header>
    <?php include '../structure/header.php'; ?>
</header>
<main>
    <h1>Kelola data jurusan</h1>
    <h2>Daftar Jurusan</h2>
    <p>Kriteria jurusan terletak dalam tabel <i>acuan_nilai_jurusan</i>. Jika anda ingin menambahkan jurusan beserta dengan kriterianya, anda dipersilahkan untuk menambahnya disini.</p>
    <table>
        <thead>
        <tr>
            <th>Nama Jurusan</th>
            <th>IPA</th>
            <th>IPS</th>
            <th>Bahasa</th>
            <th>Praktek</th>
            <th>Politik</th>
            <th>Seni</th>
            <th>R</th>
            <th>I</th>
            <th>A</th>
            <th>S</th>
            <th>E</th>
            <th>C</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama_jurusan']); ?></td>
                <td><?php echo htmlspecialchars($row['ipa']); ?></td>
                <td><?php echo htmlspecialchars($row['ips']); ?></td>
                <td><?php echo htmlspecialchars($row['bahasa']); ?></td>
                <td><?php echo htmlspecialchars($row['praktek']); ?></td>
                <td><?php echo htmlspecialchars($row['politik']); ?></td>
                <td><?php echo htmlspecialchars($row['seni']); ?></td>
                <td><?php echo htmlspecialchars($row['R']); ?></td>
                <td><?php echo htmlspecialchars($row['I']); ?></td>
                <td><?php echo htmlspecialchars($row['A']); ?></td>
                <td><?php echo htmlspecialchars($row['S']); ?></td>
                <td><?php echo htmlspecialchars($row['E']); ?></td>
                <td><?php echo htmlspecialchars($row['C']); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <form action="edit_jurusan.php" method="post">
        <label for="nama_jurusan">Nama Jurusan:</label>
        <input type="text" name="nama_jurusan" id="nama_jurusan" required>
        <label for="ipa">IPA:</label>
        <input type="number" name="ipa" id="ipa" required>
        <label for="ips">IPS:</label>
        <input type="number" name="ips" id="ips" required>
        <label for="bahasa">Bahasa:</label>
        <input type="number" name="bahasa" id="bahasa" required>
        <label for="praktek">Praktek:</label>
        <input type="number" name="praktek" id="praktek" required>
        <label for="politik">Politik:</label>
        <input type="number" name="politik" id="politik" required>
        <label for="seni">Seni:</label>
        <input type="number" name="seni" id="seni" required>
        <label for="R">R:</label>
        <input type="number" name="R" id="R" required>
        <label for="I">I:</label>
        <input type="number" name="I" id="I" required>
        <label for="A">A:</label>
        <input type="number" name="A" id="A" required>
        <label for="S">S:</label>
        <input type="number" name="S" id="S" required>
        <label for="E">E:</label>
        <input type="number" name="E" id="E" required>
        <label for="C">C:</label>
        <input type="number" name="C" id="C" required>
        <input type="submit" value="Tambahkan">
    </form>