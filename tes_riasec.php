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
<header><?php include 'structure/navbar.php'; ?></header>
<main>
    <h1>Tes RIASEC</h1>
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
        // cek data sudah ada atau belum
        $checkStmt = $conn->prepare("SELECT id_siswa FROM wpcguvfn_edubridge_db.nilai_riasec WHERE id_siswa = ?");
        $checkStmt->bind_param("i", $id_siswa);
        $checkStmt->execute();
        $checkStmt->store_result();
        $dataExists = $checkStmt->num_rows > 0;
        $checkStmt->close();

        // fungsi untuk menghitung hasil rekomendasi jurusan
        $buat_rekomendasi_jurusan = "CALL buat_rekomendasi_jurusan();";

        if ($dataExists) {
            // Update existing record
            $stmt = $conn->prepare("UPDATE wpcguvfn_edubridge_db.nilai_riasec SET R = ?, I = ?, A = ?, S = ?, E = ?, C = ? WHERE id_siswa = ?");
            $stmt->bind_param("iiiiiii", $scores['R'], $scores['I'], $scores['A'], $scores['S'], $scores['E'], $scores['C'], $id_siswa);
        } else {
            // Insert new record
            $stmt = $conn->prepare("INSERT INTO wpcguvfn_edubridge_db.nilai_riasec (id_siswa, R, I, A, S, E, C) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiiiii", $id_siswa, $scores['R'], $scores['I'], $scores['A'], $scores['S'], $scores['E'], $scores['C']);
        }

        if ($stmt->execute()) {
            header("Location: tes_riasec_hasil.php?isi_riasec_berhasil=true");
        } else {
            echo "<p>Terjadi kesalahan saat menyimpan jawaban. Silahkan coba lagi.</p>";
        }
        $stmt->close();

        $stmt = $conn->prepare($buat_rekomendasi_jurusan);
        if ($stmt->execute()) {
            header("Location: tes_riasec_hasil.php?isi_riasec_berhasil=true");
            exit;
        } else {
            echo "<p>Terjadi kesalahan saat membuat rekomendasi jurusan. Silahkan coba lagi.</p>";
        }

    } else {
        $sql = "SELECT * FROM wpcguvfn_edubridge_db.soal_riasec ORDER BY id_soal";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<form method="POST" action="">';
            while($row = $result->fetch_assoc()) {
                echo '<div class="question">';
                echo '<p>' . $row["soal"] . '</p>';
                echo '<div class="options">';
                echo '<label><input type="radio" name="question_' . $row["id_soal"] . '_' . $row["kategori"] . '" value="1"> Iya</label>';
                echo '<label><input type="radio" name="question_' . $row["id_soal"] . '_' . $row["kategori"] . '" value="0"> Tidak</label>';
                echo '</div>';
                echo '</div>';
            }
            echo '<br><input type="submit" value="Submit">';
            echo '</form>';
            echo '</div>';

        } else {
            echo "0 results";
        }

    } ?>
</main>
<?php include 'structure/footer.php'; ?>
</body>
</html>