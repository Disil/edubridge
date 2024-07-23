<?php
include('structure/check_conn.php');
include('database.php');
global $conn;
global $id_siswa;

// SQL query to fetch the nilai_rapot_asli for the current user
$query = "SELECT * FROM wpcguvfn_edubridge_db.nilai_rapot WHERE id_siswa = $id_siswa";
$result = mysqli_query($conn, $query);
$dataRapot = [];

// Check if the query was successful
if ($result) {
    // Fetch the data
    $data = mysqli_fetch_assoc($result);
    $dataRapot = $data;
} else {
    echo "Error: " . mysqli_error($conn);
}

//notif dari input nilai rapot
if (isset($_GET['isi_nilai_berhasil'])) {
    echo '<div id="message" class="message success floating-message">Nilai telah dimasukkan</div>';
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
<header><?php include "structure/navbar.php" ?></header>
<main>
    <h1>Lihat Nilai Rapot</h1>
    <div class="row">
        <div class="col">
            <br>
            <p>Nilai yang ditampilkan di tabel adalah hasil perhitungan rata-rata nilai rapot asli yang telah dimasukkan. Adapun skemanya seperti ini:</p>
            <ul>
                <li>IPA: Matematika + Fisika + Kimia + Biologi</li>
                <li>IPS: Matematika + Ekonomi + Geografi + Sosiologi</li>
                <li>Bahasa: Bahasa Indonesia + Bahasa Inggris</li>
                <li>Praktek: PJOK + Prakarya</li>
                <li>Politik: Sejarah + PPKN</li>
                <li>Seni: Seni Budaya</li>
            </ul>

        </div>
        <div class="col-4">
            <?php if (!empty($dataRapot)): ?>
                <table class="styled-table">
                    <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>IPA</td>
                        <td><?php echo htmlspecialchars($dataRapot['ipa']); ?></td>
                    </tr>
                    <tr>
                        <td>IPS</td>
                        <td><?php echo htmlspecialchars($dataRapot['ips']); ?></td>
                    </tr>
                    <tr>
                        <td>Bahasa</td>
                        <td><?php echo htmlspecialchars($dataRapot['bahasa']); ?></td>
                    </tr>
                    <tr>
                        <td>Praktek</td>
                        <td><?php echo htmlspecialchars($dataRapot['praktek']); ?></td>
                    </tr>
                    <tr>
                        <td>Politik</td>
                        <td><?php echo htmlspecialchars($dataRapot['politik']); ?></td>
                    </tr>
                    <tr>
                        <td>Seni</td>
                        <td><?php echo htmlspecialchars($dataRapot['seni']); ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Kamu <b>belum mengisi</b> data rapot. Silahkan isi terlebih dahulu.</p>
            <?php endif; ?>
        </div>

    </div>
    <p>Untuk melanjutkan ke tahapan Tes RIASEC, klik tombol dibawah</p>
    <button onclick="window.location.href='tes_riasec_info.php';">Kerjakan Tes RIASEC</button>
</main>
<footer><?php include "structure/footer.php"?></footer>
</body>
</html>