<?php include 'database.php';
include 'structure/check_conn.php';
global $conn;
global $id_siswa;
$id_siswa = $_SESSION['id_siswa'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $logika = $_POST['logika'];
    $sains = $_POST['sains'];
    $soshum = $_POST['soshum'];
    $bisnis = $_POST['bisnis'];
    $kreatif = $_POST['kreatif'];
    $terapan = $_POST['terapan'];
    $administratif = $_POST['administratif'];
    $sastra = $_POST['sastra'];

    // Check if data already exists
    $checkStmt = $conn->prepare("SELECT id_siswa FROM wpcguvfn_edubridge_db.nilai_minat WHERE id_siswa = ?");
    $checkStmt->bind_param("i", $id_siswa);
    $checkStmt->execute();
    $checkStmt->store_result();
    $dataExists = $checkStmt->num_rows > 0;
    $checkStmt->close();

    if ($dataExists) {
        // Update existing record
        $stmt = $conn->prepare("UPDATE wpcguvfn_edubridge_db.nilai_minat SET logika = ?, sains = ?, soshum = ?, bisnis = ?, kreatif = ?, terapan = ?, administratif = ?, sastra = ? WHERE id_siswa = ?");
        $stmt->bind_param("iiiiiiiii", $logika, $sains, $soshum, $bisnis, $kreatif, $terapan, $administratif, $sastra, $id_siswa);
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO wpcguvfn_edubridge_db.nilai_minat (id_siswa, logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiiiiii", $id_siswa, $logika, $sains, $soshum, $bisnis, $kreatif, $terapan, $administratif, $sastra);
    }

    if ($stmt->execute()) {
        header("Location: minat.php?isi_minat_berhasil=true");
    } else {
        echo "<p>Terjadi kesalahan saat menyimpan data minat. Silahkan coba lagi.</p>";
    }
    $stmt->close();
}
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
            <label for="logika">Apakah kamu suka bidang yang menuntut kemampuan berpikir analitis dan memecahkan masalah kompleks?</label>
            <div class="options">
                <label><input type="radio" id="logika" name="logika" value="1"> 1</label>
                <label><input type="radio" id="logika" name="logika" value="2"> 2</label>
                <label><input type="radio" id="logika" name="logika" value="3"> 3</label>
                <label><input type="radio" id="logika" name="logika" value="4"> 4</label>
                <label><input type="radio" id="logika" name="logika" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="sains">Apakah kamu suka bidang yang mempelajari tentang alam semesta dan segala isinya melalui observasi dan eksperimen (minat biologi)?</label>
            <div class="options">
                <label><input type="radio" id="sains" name="sains" value="1"> 1</label>
                <label><input type="radio" id="sains" name="sains" value="2"> 2</label>
                <label><input type="radio" id="sains" name="sains" value="3"> 3</label>
                <label><input type="radio" id="sains" name="sains" value="4"> 4</label>
                <label><input type="radio" id="sains" name="sains" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="soshum">Apakah kamu suka bidang yang mempelajari tentang hubungan antar manusia, budaya, dan sejarah?</label>
            <div class="options">
                <label><input type="radio" id="soshum" name="soshum" value="1"> 1</label>
                <label><input type="radio" id="soshum" name="soshum" value="2"> 2</label>
                <label><input type="radio" id="soshum" name="soshum" value="3"> 3</label>
                <label><input type="radio" id="soshum" name="soshum" value="4"> 4</label>
                <label><input type="radio" id="soshum" name="soshum" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="bisnis">Apakah kamu suka bidang yang berhubungan dengan pengelolaan keuangan, pemasaran, dan pengembangan usaha?</label>
            <div class="options">
                <label><input type="radio" id="bisnis" name="bisnis" value="1"> 1</label>
                <label><input type="radio" id="bisnis" name="bisnis" value="2"> 2</label>
                <label><input type="radio" id="bisnis" name="bisnis" value="3"> 3</label>
                <label><input type="radio" id="bisnis" name="bisnis" value="4"> 4</label>
                <label><input type="radio" id="bisnis" name="bisnis" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="kreatif">Apakah kamu suka bidang yang melibatkan imajinasi, seni, dan ekspresi diri?</label>
            <div class="options">
                <label><input type="radio" id="kreatif" name="kreatif" value="1"> 1</label>
                <label><input type="radio" id="kreatif" name="kreatif" value="2"> 2</label>
                <label><input type="radio" id="kreatif" name="kreatif" value="3"> 3</label>
                <label><input type="radio" id="kreatif" name="kreatif" value="4"> 4</label>
                <label><input type="radio" id="kreatif" name="kreatif" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="terapan">Apakah kamu suka bidang yang mengaplikasikan pengetahuan teoritis untuk memecahkan masalah praktis di dunia nyata?</label>
            <div class="options">
                <label><input type="radio" id="terapan" name="terapan" value="1"> 1</label>
                <label><input type="radio" id="terapan" name="terapan" value="2"> 2</label>
                <label><input type="radio" id="terapan" name="terapan" value="3"> 3</label>
                <label><input type="radio" id="terapan" name="terapan" value="4"> 4</label>
                <label><input type="radio" id="terapan" name="terapan" value="5"> 5</label>
            </div>
        </div>
        <div class="question">
            <label for="administratif">Apakah kamu suka bidang yang melibatkan pengelolaan data, pengorganisasian, dan koordinasi kegiatan?</label>
            <div class="options">
                <label><input type="radio" id="administratif" name="administratif" value="1"> 1</label>
                <label><input type="radio" id="administratif" name="administratif" value="2"> 2</label>
                <label><input type="radio" id="administratif" name="administratif" value="3"> 3</label>
                <label><input type="radio" id="administratif" name="administratif" value="4"> 4</label>
                <label><input type="radio" id="administratif" name="administratif" value="5"> 5</label>
            </div>
        </div>

        <div class="question">
            <label for="sastra">Apakah kamu suka bidang yang mempelajari tentang karya tulis seperti puisi, novel, dan drama?</label>
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