<?php include 'structure/check_conn.php';
include 'database.php';
global $conn;
global $id_siswa;
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
    <title>EduBridge - Dashboard Siswa</title>
</head>
<body>
    <header>
        <?php include 'structure/navbar.php'; ?>
    </header>
    <main>
        <h1>Dashboard</h1>
        <p>Selamat datang, <?php echo $_SESSION['nama_siswa']?>! </p>
        <p>Untuk mendapatkan rekomendasi jurusan, silahkan mulai dari mengisi nilai rapot berdasarkan semester terbaru, lalu dilanjutkan dengan tes RIASEC untuk mengukur bakat dan minat. Setelah itu, kamu bisa melihat hasil rekomendasi jurusan beserta dengan penjelasannya.</p>
        <button onclick="window.location.href='input_nilai_rapot.php';">Input Nilai Rapot</button><br>
        <button onclick="window.location.href='tes_riasec_info.php';">Tes RIASEC</button><br>
        <button onclick="window.location.href='hasil_rekomendasi.php';">Lihat hasil rekomendasi</button>
        <h2>Progress pengisian</h2>
        <figure>
            <table>
                <thead>
                <tr>
                    <th>Langkah</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Input Nilai Rapot</td>
                    <td>
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.nilai_rapot WHERE id_siswa = '$id_siswa'");
                        if (!$result) {
                            echo "<p>Error: " . mysqli_error($conn) . "</p>";
                        } elseif (mysqli_num_rows($result) == 0) {
                            echo "<p>Belum diisi</p>";
                        } else {
                            echo "<p>Sudah diisi</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tes RIASEC</td>
                    <td>
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.nilai_riasec WHERE id_siswa = '$id_siswa'");
                        if (!$result) {
                            echo "<p>Error: " . mysqli_error($conn) . "</p>";
                        } elseif (mysqli_num_rows($result) == 0) {
                            echo "<p>Belum diisi</p>";
                        } else {
                            echo "<p>Sudah diisi</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Minat</td>
                    <td>
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.nilai_minat WHERE id_siswa = '$id_siswa'");
                        if (!$result) {
                            echo "<p>Error: " . mysqli_error($conn) . "</p>";
                        } elseif (mysqli_num_rows($result) == 0) {
                            echo "<p>Belum diisi</p>";
                        } else {
                            echo "<p>Sudah diisi</p>";
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </figure>
    </main>
<footer><?php include 'structure/footer.php'; ?></footer>
</body>
</html>