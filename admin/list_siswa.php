<?php include '../structure/check_conn_admin.php';
include '../database.php';
global $conn;
if ($conn === null) {
    die('Database connection is null');
}
$searchTerm = $_GET['search'] ?? '';

if ($searchTerm) {
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    $list_user = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.siswa WHERE nama LIKE '%$searchTerm%'");
} else {
    $list_user = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.siswa");
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
    <title>EduBridge - Daftar siswa</title>
</head>
<body>
<header>
    <?php include '../structure/navbar.php'; ?>
</header>
<main>
    <h1>List Siswa - for Admin</h1>
    <p>Daftar siswa yang terdaftar di EduBridge</p>
    <form method="get" action="list_siswa.php">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Search...">
        <input type="submit" value="Search">
    </form>
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
        $list_user = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.siswa");
        while ($query = mysqli_fetch_array($list_user)) {
            ?>
            <tr>
                <td><?php echo $query['nama_siswa']; ?></td>
                <td><?php echo $query['email']; ?></td>
                <td><?php echo $query['tanggal_lahir']; ?></td>
                <td><?php echo $query['asal_sekolah']; ?></td>
                <td><?php echo $query['kelas']; ?></td>
                <td><?php echo $query['tgl_buat_akun']; ?></td>
                <td><?php echo $query['jenis_kelamin']; ?></td>
        <?php
        }  ?>
            </tr>
    </table>
    <?php include '../structure/footer.php'; ?>
</main>
</body>
</html>