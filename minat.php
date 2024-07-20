<?php include 'structure/check_conn.php';
include 'database.php';
global $conn;
global $id_siswa;

// kueri untuk lihat minat yg sudah dimasukkan
$query = "SELECT * FROM wpcguvfn_edubridge_db.nilai_minat WHERE id_siswa = $id_siswa";
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
    echo '<div id="message" class="message success floating-message">Minat telah diisi</div>';
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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - Lihat Nilai Rapot</title>
</head>
<body>
<?php include "structure/header.php"?>
<main>
    <h1>Lihat Minat</h1>
    <p> Berikut adalah nilai minat yang telah kamu masukkan:</p>
    <table>
        <tr>
            <th>Logika</th>
            <th>Sains</th>
            <th>Sosial Humaniora</th>
            <th>Bisnis</th>
            <th>Kreatif</th>
            <th>Terapan</th>
            <th>Administratif</th>
            <th>Sastra</th>
        </tr>
        <tr>
            <td><?php echo $dataMinat['logika'] ?></td>
            <td><?php echo $dataMinat['sains'] ?></td>
            <td><?php echo $dataMinat['soshum'] ?></td>
            <td><?php echo $dataMinat['bisnis'] ?></td>
            <td><?php echo $dataMinat['kreatif'] ?></td>
            <td><?php echo $dataMinat['terapan'] ?></td>
            <td><?php echo $dataMinat['administratif'] ?></td>
            <td><?php echo $dataMinat['sastra'] ?></td>
        </tr>
    </table>
</main>
<?php include "structure/footer.php"?>
</body>
</html>