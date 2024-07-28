<?php include 'database.php';
include 'structure/check_conn.php';
global $conn;
global $id_siswa;
$id_siswa = $_SESSION['id_siswa'];

$requiredFields =['logika', 'sains', 'soshum', 'bisnis', 'kreatif', 'terapan', 'administratif', 'sastra'];
$error = false;
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $error = true;
    }
}

if ($error) {
    echo '<div id="message" class="message success floating-message">Isi data minat terlebih dahulu.</div>';
    echo '<script>
    setTimeout(function() {
        document.getElementById("message").style.display = "none";
    }, 2000);
</script>';
} else {
    $stmt = $conn->prepare("INSERT INTO wpcguvfn_edubridge_db.nilai_minat (id_siswa, logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

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

    // Execute the query
    if ($stmt->execute()) {
        header("Location: minat.php?isi_minat_berhasil=true");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
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
    <style>
        .question {
            margin-bottom: 20px;
            background-color: var(--clight);
            padding: 10px 10px 10px 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .options {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .options label {
            margin: 0 10px;
        }
        input[type="submit"] {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #a35403;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php include 'structure/navbar.php'; ?>
<main>
    <h1>Minat Kamu</h1>
    <p>Silahkan isi formulir dibawah ini dengan sejujur-jujurnya.</p>
    <p>Cara menjawab: jika kamu sangat setuju dengan pernyataan tersebut, maka pilih nomor 5. Jika kamu sangat tidak setuju, pilih nomor 1.</p>
    <form action="input_minat.php" method="post">
        <div class="question">
            <label for="logika">Logika</label>
            <div class="options">
                <label><input type="radio" id="logika" name="logika" value="1"> 1</label>
                <label><input type="radio" id="logika" name="logika" value="2"> 2</label>
                <label><input type="radio" id="logika" name="logika" value="3"> 3</label>
                <label><input type="radio" id="logika" name="logika" value="4"> 4</label>
                <label><input type="radio" id="logika" name="logika" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="sains">Sains</label>
            <div class="options">
                <label><input type="radio" id="sains" name="sains" value="1"> 1</label>
                <label><input type="radio" id="sains" name="sains" value="2"> 2</label>
                <label><input type="radio" id="sains" name="sains" value="3"> 3</label>
                <label><input type="radio" id="sains" name="sains" value="4"> 4</label>
                <label><input type="radio" id="sains" name="sains" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="soshum">Sosial Humaniora</label>
            <div class="options">
                <label><input type="radio" id="soshum" name="soshum" value="1"> 1</label>
                <label><input type="radio" id="soshum" name="soshum" value="2"> 2</label>
                <label><input type="radio" id="soshum" name="soshum" value="3"> 3</label>
                <label><input type="radio" id="soshum" name="soshum" value="4"> 4</label>
                <label><input type="radio" id="soshum" name="soshum" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="bisnis">Bisnis</label>
            <div class="options">
                <label><input type="radio" id="bisnis" name="bisnis" value="1"> 1</label>
                <label><input type="radio" id="bisnis" name="bisnis" value="2"> 2</label>
                <label><input type="radio" id="bisnis" name="bisnis" value="3"> 3</label>
                <label><input type="radio" id="bisnis" name="bisnis" value="4"> 4</label>
                <label><input type="radio" id="bisnis" name="bisnis" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="kreatif">Kreatif</label>
            <div class="options">
                <label><input type="radio" id="kreatif" name="kreatif" value="1"> 1</label>
                <label><input type="radio" id="kreatif" name="kreatif" value="2"> 2</label>
                <label><input type="radio" id="kreatif" name="kreatif" value="3"> 3</label>
                <label><input type="radio" id="kreatif" name="kreatif" value="4"> 4</label>
                <label><input type="radio" id="kreatif" name="kreatif" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="terapan">terapan</label>
            <div class="options">
                <label><input type="radio" id="terapan" name="terapan" value="1"> 1</label>
                <label><input type="radio" id="terapan" name="terapan" value="2"> 2</label>
                <label><input type="radio" id="terapan" name="terapan" value="3"> 3</label>
                <label><input type="radio" id="terapan" name="terapan" value="4"> 4</label>
                <label><input type="radio" id="terapan" name="terapan" value="5"> 5</label>
            </div>
        </div>
        <div class="question">
            <label for="administratif">administratif</label>
            <div class="options">
                <label><input type="radio" id="administratif" name="administratif" value="1"> 1</label>
                <label><input type="radio" id="administratif" name="administratif" value="2"> 2</label>
                <label><input type="radio" id="administratif" name="administratif" value="3"> 3</label>
                <label><input type="radio" id="administratif" name="administratif" value="4"> 4</label>
                <label><input type="radio" id="administratif" name="administratif" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="sastra">sastra</label>
            <div class="options">
                <label><input type="radio" id="sastra" name="sastra" value="1"> 1</label>
                <label><input type="radio" id="sastra" name="sastra" value="2"> 2</label>
                <label><input type="radio" id="sastra" name="sastra" value="3"> 3</label>
                <label><input type="radio" id="sastra" name="sastra" value="4"> 4</label>
                <label><input type="radio" id="sastra" name="sastra" value="5"> 5</label>
            </div>
        </div>
        <input type="submit" value="Submit">
    </form>
</main>
</body>
<?php include 'structure/footer.php'; ?>
</html>