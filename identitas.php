<?php include 'structure/check_conn.php';
    include 'database.php' ;
// Execute SQL query
$result = mysqli_query($conn, "SELECT * FROM wpcguvfn_edubridge_db.siswa WHERE id_siswa = $id_siswa");

// Fetch data
$user = mysqli_fetch_assoc($result);
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
    <title>Edubridge - Edit Identitas Anda</title>
</head>
<body>
<header>
    <?php include 'structure/header.php'; ?>
</header>
<main>
    <h1>Edit Identitas Anda</h1>
    <p>Anda dapat mengubah informasi identitas Anda di sini.</p>
    <form action="identitas.php" method="post">
        <fieldset>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?php echo $user['nama']; ?>" required>
            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>
            <label for="password">Sandi</label>
            <input type="password" name="password" id="password" required>
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $user['tanggal_lahir']; ?>" required>
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" required>
                <option value="10" <?php if ($user['kelas'] == 10) echo 'selected'; ?>>10</option>
                <option value="11" <?php if ($user['kelas'] == 11) echo 'selected'; ?>>11</option>
                <option value="12" <?php if ($user['kelas'] == 12) echo 'selected'; ?>>12</option>
            </select>
            <label for="asal_sekolah">Asal Sekolah</label>
            <input type="text" name="asal_sekolah" id="asal_sekolah" value="<?php echo $user['asal_sekolah']; ?>" required>
            <label for="gender">Gender:</label><br>
            <input type="radio" id="male" name="gender" value="male" <?php if ($user['gender'] == 'male') echo 'checked'; ?>>
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female" <?php if ($user['gender'] == 'female') echo 'checked'; ?>>
            <label for="female">Female</label><br>
            <button type="submit">Update</button>
        </fieldset>
    </form>

</main>
<footer><?php include 'structure/footer.php'; ?></footer>