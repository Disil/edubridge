<?php

include('structure/check_conn.php');
include('database.php');
global $conn;
global $id_siswa;

// by default tidak ada data rapot
$adaRapot = false;

// Cek apakah semua field wajib diisi
$requiredFields = ['matematika', 'bahasa_indonesia', 'bahasa_inggris', 'pjok', 'prakarya', 'sejarah', 'ppkn', 'seni_budaya'];
$error = false;
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $error = true;
    }
}

if ($error) {
    // Tampilkan pesan error jika ada field yang belum diisi
    echo '<div id="message" class="message success floating-message">Isi data rapot terlebih dahulu.</div>';
    echo '<script>
        setTimeout(function() {
            document.getElementById("message").style.display = "none";
        }, 2000);
    </script>';
} else {
    // Periksa apakah data sudah ada di database
    $checkStmt = $conn->prepare("SELECT id_siswa FROM nilai_rapot_asli WHERE id_siswa = ?");
    $checkStmt->bind_param("i", $_SESSION['id_siswa']);
    $checkStmt->execute();
    $checkStmt->store_result();
    $dataExists = $checkStmt->num_rows > 0;

    if ($dataExists) {
        $adaRapot = true;

        // Prosedur untuk UPDATE nilai rapot
        $updateStmt = $conn->prepare("UPDATE wpcguvfn_edubridge_db.nilai_rapot_asli SET matematika = ?, fisika = ?, kimia = ?, biologi = ?, ekonomi = ?, geografi = ?, sosiologi = ?, bahasa_indonesia = ?, bahasa_inggris = ?, pjok = ?, prakarya = ?, sejarah = ?, ppkn = ?, seni_budaya = ? WHERE id_siswa = ?");
        $updateStmt->bind_param("iiiiiiiiiiiiiii",
            $_POST['matematika'],
            $_POST['fisika'],
            $_POST['kimia'],
            $_POST['biologi'],
            $_POST['ekonomi'],
            $_POST['geografi'],
            $_POST['sosiologi'],
            $_POST['bahasa_indonesia'],
            $_POST['bahasa_inggris'],
            $_POST['pjok'],
            $_POST['prakarya'],
            $_POST['sejarah'],
            $_POST['ppkn'],
            $_POST['seni_budaya'],
            $_SESSION['id_siswa']
        );
        if ($updateStmt->execute()) {
            header("Location: nilai_rapot.php?isi_nilai_berhasil=true");
            exit;
        } else {
            echo "Error updating data: " . $updateStmt->error;
        }
    } else {
        $adaRapot = false;
        // Jika data belum ada, lakukan INSERT
        $insertStmt = $conn->prepare("INSERT INTO wpcguvfn_edubridge_db.nilai_rapot_asli (id_siswa, matematika, fisika, kimia, biologi, ekonomi, geografi, sosiologi, bahasa_indonesia, bahasa_inggris, pjok, prakarya, sejarah, ppkn, seni_budaya) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE 
:
        matematika = VALUES(matematika), 
        fisika = VALUES(fisika),
        kimia = VALUES(kimia), 
        biologi = VALUES(biologi), 
        ekonomi = VALUES(ekonomi), 
        geografi = VALUES(geografi), 
        sosiologi = VALUES(sosiologi), 
        bahasa_indonesia = VALUES(bahasa_indonesia), 
        bahasa_inggris = VALUES(bahasa_inggris), 
        pjok = VALUES(pjok), 
        prakarya = VALUES(prakarya), 
        sejarah = VALUES(sejarah), 
        ppkn = VALUES(ppkn), 
        seni_budaya = VALUES(seni_budaya)");

        $insertStmt->bind_param("iiiiiiiiiiiiiii",
            $_SESSION['id_siswa'],
            $_POST['matematika'],
            $_POST['fisika'],
            $_POST['kimia'],
            $_POST['biologi'],
            $_POST['ekonomi'],
            $_POST['geografi'],
            $_POST['sosiologi'],
            $_POST['bahasa_indonesia'],
            $_POST['bahasa_inggris'],
            $_POST['pjok'],
            $_POST['prakarya'],
            $_POST['sejarah'],
            $_POST['ppkn'],
            $_POST['seni_budaya']
        );
        if ($insertStmt->execute()) {
            header("Location: nilai_rapot.php?isi_nilai_berhasil=true");
            exit;
        } else {
            echo "Error inserting data: " . $insertStmt->error;
        }
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
    <title>EduBridge - Input Nilai Rapot</title>
</head>
<body>
<header><?php include "structure/navbar.php" ?></header>
<main>
    <h1>Input Nilai Rapot Pelajaran</h1>
    <?php if ($adaRapot) {
    echo '<p>Kamu <b>telah</b> memasukkan nilai rapot. Jika kamu salah memasukkan nilai, silahkan ubah lalu klik submit.</p>';
} else {
        echo '<p>Silahkan masukkan nilai rapot semester terbaru. Jika kamu tidak punya nilai untuk mata pelajaran tersebut (misalnya kamu jurusan IPA dan tidak ada pelajaran ekonomi), maka kolomnya bisa tidak diisi ataupun diisi dengan 0.</p>';
        echo '<p>Nilai yang dimasukkan boleh diambil dari nilai semester terbaru, ataupun rata-rata keseluruhan.</p>';
    }
    ?>
    <form action="input_nilai_rapot.php" method="post">
        <figure>
            <table>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                </tr>
                <tr>
                    <td><label for="matematika">➕ Matematika:</label></td>
                    <td><input type="number" id="matematika" name="matematika"</td>
                </tr>
                <tr>
                    <td><label for="fisika">👨‍🔬 Fisika:</label></td>
                    <td><input type="number" id="fisika" name="fisika"></td>
                </tr>
                <tr>
                    <td><label for="kimia">⚗️ Kimia:</label></td>
                    <td><input type="number" id="kimia" name="kimia"></td>
                </tr>
                <tr>
                    <td><label for="biologi">🧬 Biologi:</label></td>
                    <td><input type="number" id="biologi" name="biologi"></td>
                </tr>
                <tr>
                    <td><label for="ekonomi">💸 Ekonomi:</label></td>
                    <td><input type="number" id="ekonomi" name="ekonomi"></td>
                </tr>
                <tr>
                    <td><label for="geografi">🌏 Geografi:</label></td>
                    <td><input type="number" id="geografi" name="geografi"></td>
                </tr>
                <tr>
                    <td><label for="sosiologi">🧑‍🤝‍🧑 Sosiologi:</label></td>
                    <td><input type="number" id="sosiologi" name="sosiologi"></td>
                </tr>
                <tr>
                    <td><label for="bahasa_indonesia">🇮🇩 Bahasa Indonesia:</label></td>
                    <td><input type="number" id="bahasa_indonesia" name="bahasa_indonesia"></td>
                </tr>
                <tr>
                    <td><label for="bahasa_inggris">🇬🇧 Bahasa Inggris:</label></td>
                    <td><input type="number" id="bahasa_inggris" name="bahasa_inggris"></td>
                </tr>
                <tr>
                    <td><label for="pjok">🤸‍♀️ PJOK:</label></td>
                    <td><input type="number" id="pjok" name="pjok"></td>
                </tr>
                <tr>
                    <td><label for="prakarya">🧵 Prakarya:</label></td>
                    <td><input type="number" id="prakarya" name="prakarya"></td>
                </tr>
                <tr>
                    <td><label for="sejarah">🕰️ Sejarah:</label></td>
                    <td><input type="number" id="sejarah" name="sejarah"></td>
                </tr>
                <tr>
                    <td><label for="ppkn">🫡 PPKN:</label></td>
                    <td><input type="number" id="ppkn" name="ppkn"></td>
                </tr>
                <tr>
                    <td><label for="seni_budaya">🎨 Seni Budaya:</label></td>
                    <td><input type="number" id="seni_budaya" name="seni_budaya"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </figure>
    </form>
</main>
<?php include "structure/footer.php"?>
</body>
</html>