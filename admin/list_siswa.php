<?php include '../structure/check_conn_admin.php';
include '../database.php';
global $conn;

$searchTerm = $_GET['cari'] ?? '';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <link rel="stylesheet" href="../css/themes.css">
    <title>EduBridge - Daftar siswa</title>
</head>
<body>
<header>
    <?php include '../structure/navbar.php'; ?>
</header>
<main>
    <h1>List Siswa - for Admin</h1>
    <div class="row">
        <div class="col-6">
            <p>Daftar siswa yang terdaftar di EduBridge. Semua data yang ada di sini adalah data yang valid dan telah terverifikasi.</p>
        </div>
        <div class="col">
            <form method="get" action="list_siswa.php">
                <label for="cari">Pencarian Nama Siswa:</label>
                <input type="text" name="cari" id="cari" placeholder="Cari siswa berdasarkan nama..">
                <input type="submit" value="Search">
            </form>
        </div>
    </div>
    <table>
        <tr>
            <th>Nama Siswa</th>
            <th>Email</th>
            <th>Tanggal Lahir</th>
            <th>Asal Sekolah</th>
            <th>Kelas</th>
            <th>Tgl Buat Akun</th>
            <th>Gender</th>
        </tr>
        <?php
        $query = "SELECT * FROM wpcguvfn_db.siswa";
        if ($searchTerm) {
            $query .= " WHERE nama_siswa LIKE '%" . mysqli_real_escape_string($conn, $searchTerm) . "%'";
        }

        $list_user = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($list_user)) {
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['nama_siswa']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['tanggal_lahir']); ?></td>
            <td><?php echo htmlspecialchars($row['asal_sekolah']); ?></td>
            <td><?php echo htmlspecialchars($row['kelas']); ?></td>
            <td><?php echo htmlspecialchars($row['tgl_buat_akun']); ?></td>
            <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php include '../structure/footer.php'; ?>
</main>
</body>
</html>