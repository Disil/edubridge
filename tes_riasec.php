<?php
global $id_siswa;
global $conn;
include 'database.php';
include 'structure/check_conn.php';
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
    <title>EduBridge - Tes RIASEC</title>
    <style>
        .form-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: auto;
        }
        .question {
            margin-bottom: 20px;
            background-color: var(--clight);
            padding: 10px 10px 10px 10px;
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
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .column {
                flex-basis: 100%;
            }
        }
    </style>
</head>
<body>
<header><?php include 'structure/header.php'; ?></header>
<main>
    <h1>Test RIASEC</h1>
    <?php
    if (isset($_SESSION['submission_status'])) {
        if ($_SESSION['submission_status'] == "error") {
            echo '<div class="message error">Terjadi masalah ketika mengirimkan jawaban. Silahkan dicek kembali, semua harus diisi.</div>';
        }
        unset($_SESSION['submission_status']);
    }
    ?>
    <p>Cara pengisian soal:</p>
    <ul>
        <li>Tes berjumlah 90 soal. Tidak ada batas waktu dalam pengerjaan soal.</li>
        <li>Soal memiliki jawaban berupa pilihan "Ya" atau "Tidak". Silahkan pilih salah satu, yang paling menggambarkan kondisi Anda saat ini.</li>
        <li>Tidak ada jawaban yang benar/salah.</li>
    </ul>
    <p>Selamat mengerjakan!</p>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categories = ['R', 'I', 'A', 'S', 'E', 'C'];
        $scores = array_fill_keys($categories, 0);

        foreach ($_POST as $key => $value) {
            if (str_starts_with($key, 'question_') && $value == '1') {
                $category = substr($key, -1);
                $scores[$category]++;
            }
        }

        $stmt = $conn->prepare("INSERT INTO edubridge_db.nilai_riasec (id_siswa, R, I, A, S, E, C) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiiii", $id_siswa, $scores['R'], $scores['I'], $scores['A'], $scores['S'], $scores['E'], $scores['C']);
        $stmt->execute();
        $stmt->close();
        echo "<p>Anda telah mengerjakan tes ini. Silahkan <a href='tes_riasec_hasil.php'>Lihat hasilnya disini.</a></p>";

    } else {
        $sql = "SELECT id_pertanyaan, pertanyaan, kategori FROM edubridge_db.pertanyaan_riasec ORDER BY id_pertanyaan";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="form-container">';
            echo '<div class="column">';
            echo '<form method="POST" action="">';
            while($row = $result->fetch_assoc()) {
                echo '<div class="question">';
                echo '<p>' . $row["pertanyaan"] . '</p>';
                echo '<div class="options">';
                echo '<label><input type="radio" name="question_' . $row["id_pertanyaan"] . '_' . $row["kategori"] . '" value="1"> Iya</label>';
                echo '<label><input type="radio" name="question_' . $row["id_pertanyaan"] . '_' . $row["kategori"] . '" value="0"> Tidak</label>';
                echo '</div>';
                echo '</div>';
            }
            echo '<br><input type="submit" value="Submit">';
            echo '</form>';
            echo '</div>';
            echo '</div>';

        } else {
            echo "0 results";
        }

    } ?>
</main>
<?php include 'structure/footer.php'; ?>
</body>
</html>