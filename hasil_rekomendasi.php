<?php
global $conn;
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
    <title>Hasil Rekomendasi Jurusan</title>
</head>
<body>
<header>
    <?php include 'structure/header.php'; ?>
</header>
<main>
    <h1>Hasil Rekomendasi Jurusan</h1>
    <p>Di halaman ini anda bisa melihat hasil rekomendasi jurusan berdasarkan nilai rapot dan tes minat yang sudah anda kerjakan sebelumnya.</p>
    <h2>Informasi Jurusan</h2>
    <table>
        <thead>
        <tr>
            <th>Jurusan</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        <?php $result = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.hasil_rekomendasi");
        while ($row = mysqli_fetch_assoc($result)) {?>
            <tr>
                <td>Jurusan 1</td>
                <td><?php echo $row['Jurusan_1'];?></td>
            </tr>
            <tr>
                <td>Jurusan 2</td>
                <td><?php echo $row['Jurusan_2'];?></td>
            </tr>
            <tr>
                <td>Jurusan 3</td>
                <td><?php echo $row['Jurusan_3'];?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</main>
<footer><?php include 'structure/footer.php'; ?></footer>
</body>
</html>