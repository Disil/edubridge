<?php include 'structure/check_conn.php';
    include 'database.php' ;
    global $conn;
    global $id_siswa;
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
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>Edubridge - Edit Identitas Anda</title>
</head>
<body>
<header>
    <?php include 'structure/navbar.php'; ?>
</header>
<main>
    <h1>Edit Identitas Anda</h1>
    <p>Anda dapat mengubah informasi identitas Anda di sini.</p>
    <form action="identitas.php" method="post">
        <fieldset>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?php echo $user['nama']; ?>" required disabled>
            <button type="button" onclick="document.getElementById('nama').disabled = false;">Edit</button>
            <br><br>

            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required disabled>
            <button type="button" onclick="document.getElementById('email').disabled = false;">Edit</button>
            <br><br>

            <label for="password">Sandi</label>
            <input type="password" name="password" id="password" required disabled>
            <button type="button" onclick="document.getElementById('password').disabled = false;">Edit</button>
            <br><br>

            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $user['tanggal_lahir']; ?>" required disabled>
            <button type="button" onclick="document.getElementById('tanggal_lahir').disabled = false;">Edit</button>
            <br><br>

            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" required disabled>
                <option value="10" <?php if ($user['kelas'] == 10) echo 'selected'; ?>>10</option>
                <option value="11" <?php if ($user['kelas'] == 11) echo 'selected'; ?>>11</option>
                <option value="12" <?php if ($user['kelas'] == 12) echo 'selected'; ?>>12</option>
            </select>
            <button type="button" onclick="document.getElementById('kelas').disabled = false;">Edit</button>
            <br><br>

            <label for="asal_sekolah">Asal Sekolah</label>
            <input type="text" name="asal_sekolah" id="asal_sekolah" value="<?php echo $user['asal_sekolah']; ?>" required disabled>
            <button type="button" onclick="document.getElementById('asal_sekolah').disabled = false;">Edit</button>
            <br><br>

            <label for="gender">Gender:</label><br>
            <input type="radio" id="Pria" name="gender" value="Pria" <?php if ($user['gender'] == 'Pria') echo 'checked'; ?> disabled>
            <label for="Pria">Pria</label><br>
            <input type="radio" id="Wanita" name="gender" value="Wanita" <?php if ($user['gender'] == 'Wanita') echo 'checked'; ?> disabled>
            <label for="Wanita">Wanita</label><br>
            <button type="button" onclick="document.getElementById('Pria').disabled = false; document.getElementById('Wanita').disabled = false;">Edit</button>
            <br><br>

            <button type="submit">Update</button>
        </fieldset>
    </form>

</main>
<footer><?php include 'structure/footer.php'; ?></footer>