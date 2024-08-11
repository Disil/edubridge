<?php include 'structure/check_conn.php';
include 'database.php';
global $conn;
global $id_siswa;

// kueri untuk lihat minat yg sudah dimasukkan
$query = "SELECT * FROM wpcguvfn_db.nilai_minat WHERE id_siswa = $id_siswa";
$result = mysqli_query($conn, $query);
$dataMinat = [];

// cek apakah kueri berhasil
if ($result) {
    // ambil data
    $data = mysqli_fetch_assoc($result);
    $dataMinat = $data;
} else {
    echo "Error: " . mysqli_error($conn);
}

// notif dari input nilai minat
if (isset($_GET['isi_minat_berhasil'])) {
    echo '<div id="message" class="message success floating-message">Pengisian data berhasil!</div>';
    echo '<script>
    setTimeout(function() {
        document.getElementById("message").style.display = "none";
    }, 3000) </script>';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - Lihat Nilai Rapot</title>
</head>
<body>
<?php include "structure/navbar.php" ?>
<main>
    <h1>Lihat Minat</h1>
    <p> Berikut adalah nilai minat yang telah kamu masukkan:</p>
    <figure>
        <table>
        <thead>
        <tr>
            <th>Minat</th>
            <th>Poin</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($dataMinat != null): ?>
            <tr>
                <td>Logika & Matematika</td>
                <td><?php echo $dataMinat['logika'] ?></td>
            </tr>
            <tr>
                <td>Sains</td>
                <td><?php echo $dataMinat['sains'] ?></td>
            </tr>
            <tr>
                <td>Sosial & Humaniora</td>
                <td><?php echo $dataMinat['soshum'] ?></td>
            </tr>
            <tr>
                <td>Bisnis & Manajemen</td>
                <td><?php echo $dataMinat['bisnis'] ?></td>
            </tr>
            <tr>
                <td>Kreativitas</td>
                <td><?php echo $dataMinat['kreatif'] ?></td>
            </tr>
            <tr>
                <td>Terapan & Praktek</td>
                <td><?php echo $dataMinat['terapan'] ?></td>
            </tr>
            <tr>
                <td>Administrasi</td>
                <td><?php echo $dataMinat['administratif'] ?></td>
            </tr>
            <tr>
                <td>Sastra dan Bahasa</td>
                <td><?php echo $dataMinat['sastra'] ?></td>
            </tr>
        <?php else: ?>
        <tr>
            <td colspan="2">Belum ada data minat yang dimasukkan.<br> Silahkan masukkan minat terlebih dahulu<br> <a href="input_minat.php">di link ini</a>.</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
    </figure>
    <p>Untuk melihat hasil rekomendasi, silahkan klik tombol dibawah berikut</p>
    <button onclick="window.location.href='hasil_rekomendasi.php'">Lihat Hasil Rekomendasi</button>
</main>
<?php include "structure/footer.php"?>
</body>
</html>