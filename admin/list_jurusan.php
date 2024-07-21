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
    <title>EduBridge - Tabel Kriteria Jurusan</title>
</head>
<body>
<header>
    <?php include '../structure/navbar_admin.php'; ?>
</header>
<main>
    <h1>Daftar Kriteria Jurusan</h1>
    <p>Tabel kriteria jurusan</p>
    <table>
        <thead>
        <tr>
            <th>ID Jurusan</th>
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
            <th>Logika</th>
            <th>Sains</th>
            <th>Soshum</th>
            <th>Bisnis</th>
            <th>Kreatif</th>
            <th>Terapan</th>
            <th>Administratif</th>
            <th>Sastra</th>
        </tr>
        </thead>
        <tbody>
        <?php $sql = "SELECT * FROM acuan_nilai_jurusan";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_jurusan']; ?></td>
                    <td><?php echo $row['nama_jurusan']; ?></td>
                    <td><?php echo $row['ipa']; ?></td>
                    <td><?php echo $row['ips']; ?></td>
                    <td><?php echo $row['bahasa']; ?></td>
                    <td><?php echo $row['praktek']; ?></td>
                    <td><?php echo $row['politik']; ?></td>
                    <td><?php echo $row['seni']; ?></td>
                    <td><?php echo $row['R']; ?></td>
                    <td><?php echo $row['I']; ?></td>
                    <td><?php echo $row['A']; ?></td>
                    <td><?php echo $row['S']; ?></td>
                    <td><?php echo $row['E']; ?></td>
                    <td><?php echo $row['C']; ?></td>
                    <td><?php echo $row['logika']; ?></td>
                    <td><?php echo $row['sains']; ?></td>
                    <td><?php echo $row['soshum']; ?></td>
                    <td><?php echo $row['bisnis']; ?></td>
                    <td><?php echo $row['kreatif']; ?></td>
                    <td><?php echo $row['terapan']; ?></td>
                    <td><?php echo $row['administratif']; ?></td>
                    <td><?php echo $row['sastra']; ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
</main>
</body>
<?php include '../structure/footer.php'; ?>
</html>