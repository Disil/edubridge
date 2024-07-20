<?php include 'database.php';
include 'structure/check_conn.php';
global $conn;
global $id_siswa;

//masukkan nilai minat
$stmt = $conn->prepare("INSERT INTO wpcguvfn_edubridge_db.nilai_minat (id_siswa, logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

//amankan data
$stmt->bind_param("iiiiiiiii",
    $id_siswa,
    $_POST['logika'],
    $_POST['sains'],
    $_POST['soshum'],
    $_POST['bisnis'],
    $_POST['kreatif'],
    $_POST['terapan'],
    $_POST['administratif'],
    $_POST['sastra']
);

//eksekusi form
if ($stmt->execute()) {
    header("Location: minat.php?isi_minat_berhasil=true");
} else {
    echo "Error: " . $stmt->error;
}
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
    <title>EduBridge - Input Minat</title>
</head>
<body>
<?php include 'structure/header.php'; ?>
<main>
    <h1>Minat Kamu</h1>
    <p>Silahkan isi formulir dibawah ini dengan sejujur-jujurnya.</p>
    <p>Cara menjawab: jika kamu sangat setuju dengan pernyataan tersebut, maka <i>slider</i> bisa digeser ke nomor 5. Jika kamu tidak setuju, geser <i>slider</i> ke sebelah 0.</p>
    <form action="input_minat.php" method="post">
        <label for="logika">Logika</label>
        <input type="range" id="logika" name="logika" min="0" max="5" value="3">
        <label for="sains">Sains</label>
        <input type="range" id="sains" name="sains" min="0" max="5" value="3">
        <label for="soshum">Sosial Humaniora</label>
        <input type="range" id="soshum" name="soshum" min="0" max="5" value="3">
        <label for="bisnis">bisnis</label>
        <input type="range" id="bisnis" name="bisnis" min="0" max="5" value="3">
        <label for="kreatif">Kreatif</label>
        <input type="range" id="kreatif" name="kreatif" min="0" max="5" value="3">
        <label for="terapan">Terapan</label>
        <input type="range" id="terapan" name="terapan" min="0" max="5" value="3">
        <label for="administratif">Administratif</label>
        <input type="range" id="administratif" name="administratif" min="0" max="5" value="3">
        <label for="sastra">Sastra</label>
        <input type="range" id="sastra" name="sastra" min="0" max="5" value="3">
        <button type="submit">Kirim</button>
    </form>
</main>
</body>
<?php include 'structure/footer.php'; ?>
</html>