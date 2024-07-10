<?php
global $conn;
global $id_siswa;
include 'structure/check_conn.php';
include 'database.php'
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
    <title>EduBridge - Hasil Rekomendasi</title>
</head>
<body>
<header>
    <?php include 'structure/header.php'; ?>
</header>
<main>
    <h1>Hasil Rekomendasi Jurusan Perguruan Tinggi</h1>
    <p>Di halaman ini kamu bisa melihat hasil rekomendasi jurusan perguruan tinggi berdasarkan nilai rapot dan tes minat yang sudah anda kerjakan sebelumnya.</p>
    <h2 style="text-align: center;">Informasi Jurusan</h2>
    <figure>
        <table>
            <thead>
            <tr>
                <th>Keterangan</th>
                <th>Nama Jurusan</th>
            </tr>
            </thead>
            <tbody>
            <?php $result = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.hasil_rekomendasi WHERE id_siswa = '$id_siswa'");
            while ($row = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td>Jurusan I</td>
                    <td><?php echo $row['Jurusan_1'];?></td>
                </tr>
                <tr>
                    <td>Jurusan II</td>
                    <td><?php echo $row['Jurusan_2'];?></td>
                </tr>
                <tr>
                    <td>Jurusan III</td>
                    <td><?php echo $row['Jurusan_3'];?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </figure>
</main>
<footer><?php include 'structure/footer.php'; ?></footer>
</body>
</html>