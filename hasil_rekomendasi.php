<?php
global $conn;
global $id_siswa;
include 'structure/check_conn.php';
include 'database.php';

if (isset($_POST['buat_rekomendasi'])) {
    $query = "CALL buat_rekomendasi_jurusan('$id_siswa')";
    if (mysqli_query($conn, $query)) {
        echo '<div id="message" class="message success floating-message">Berhasil.</div>';
        echo '<script>
        setTimeout(function() {
            document.getElementById("message").style.display = "none";
        }, 1000);
        document.getElementById("form_rekomendasi").style.display = "none";
    </script>';
    } else {
        echo "Gagal membuat rekomendasi jurusan: " . mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - Hasil Rekomendasi</title>
</head>
<body>
<header>
    <?php include 'structure/navbar.php'; ?>
</header>
<main>
    <h1>Hasil Rekomendasi Jurusan Perguruan Tinggi</h1>
    <p>Di halaman ini kamu bisa melihat hasil rekomendasi jurusan perguruan tinggi berdasarkan nilai rapot dan tes minat yang sudah anda kerjakan sebelumnya.</p>
    <p id="form_rekomendasi">Silahkan klik tombol dibawah ini untuk melihat hasil rekomendasi jurusan perguruan tinggi.</p>
    <form id="form_rekomendasi" method="post">
        <button type="submit" name="buat_rekomendasi">Buat Rekomendasi Jurusan</button>
    </form>
    <h2 style="text-align: center;">Informasi Jurusan</h2>
    <figure>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM wpcguvfn_db.hasil_rekomendasi WHERE id_siswa = '$id_siswa'");
        if (!$result) {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        } elseif (mysqli_num_rows($result) == 0) {
            echo "<blockquote class='warn'><p>Silahkan klik tombol diatas terlebih dahulu.</p></blockquote>";
        } else {
            ?>
            <table>
                <thead>
                <tr>
                    <th>Keterangan</th>
                    <th>Nama Jurusan</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) {?>
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
        <?php }?>
    </figure>
</main>
<footer><?php include 'structure/footer.php'; ?></footer>
</body>
</html>