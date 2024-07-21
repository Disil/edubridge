<?php
include 'database.php';
include 'structure/check_conn.php';
global $conn;
// Function to get id_siswa from session
function getIdSiswa() {
    return isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : null;
}

// Function to get RIASEC scores for a specific user
function getRIASECScores($conn, $id_siswa) {
    $sql = "SELECT R, I, A, S, E, C FROM wpcguvfn_edubridge_db.nilai_riasec WHERE id_siswa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_siswa);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

$id_siswa = getIdSiswa();

if (!$id_siswa) {
    echo "No user session found. Please take the RIASEC test first.";
    exit;
}

$scores = getRIASECScores($conn, $id_siswa);

if (!$scores) {
    echo "<script>alert('Anda belum mengisi tes riasec. Anda akan dialihkan menuju halaman tes.'); window.location.href='tes_riasec.php';</script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>RIASEC Test Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <style>
        .chart-container {
            width: 80%;
            max-width: 600px;
            margin: auto;
        }
        .scores-table {
            margin-top: 20px;
            border-collapse: collapse;
        }
        .scores-table th, .scores-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .scores-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Hasil Tes RIASEC Kamu</h1>
<?php include "structure/navbar.php" ?>
<main>
    <div class="chart-container">
        <canvas id="riasecChart"></canvas>
    </div>
    <figure>
        <script>
        const ctx = document.getElementById('riasecChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Realistic', 'Investigative', 'Artistic', 'Social', 'Enterprising', 'Conventional'],
                datasets: [{
                    label: 'RIASEC Scores',
                    data: [
                        <?php echo $scores['R']; ?>,
                        <?php echo $scores['I']; ?>,
                        <?php echo $scores['A']; ?>,
                        <?php echo $scores['S']; ?>,
                        <?php echo $scores['E']; ?>,
                        <?php echo $scores['C']; ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', // Red
                        'rgba(54, 162, 235, 0.2)', // Blue
                        'rgba(255, 206, 86, 0.2)', // Yellow
                        'rgba(75, 192, 192, 0.2)', // Green
                        'rgba(153, 102, 255, 0.2)', // Purple
                        'rgba(255, 159, 64, 0.2)' // Orange
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', // Red
                        'rgba(54, 162, 235, 1)', // Blue
                        'rgba(255, 206, 86, 1)', // Yellow
                        'rgba(75, 192, 192, 1)', // Green
                        'rgba(153, 102, 255, 1)', // Purple
                        'rgba(255, 159, 64, 1)' // Orange
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 15
                    }
                }
            }
        });
    </script>
    </figure>

    <h2>Penjelasan</h2>
    <p>Menurut hasil Tes RIASEC, kamu dominan dalam bidang:</p>
    <?php $dominantType = array_keys($scores, max($scores))[0];
    $deskripsi = "";
    switch ($dominantType) {
        case 'R':
            $deskripsi = "Sebagai individu dengan tipe kepribadian realistik kamu cenderung menyukai aktivitas praktis dan fisik. Kamu memiliki keahlian dalam menggunakan alat dan mesin, serta menyelesaikan masalah konkret dalam lingkungan yang berbasis pada keterampilan, seperti perbaikan, konstruksi, atau aktivitas luar ruangan. Kamu praktis, terampil secara mekanis, dan suka menyelesaikan masalah yang bersifat konkrit.";
            break;
        case 'I':
            $deskripsi = "Individu dengan tipe kepribadian ini memiliki minat dalam mengeksplorasi ide-ide baru dan dan memecahkan masalah yang kompleks menggunakan logika dan pengetahuan mendalam. Mereka suka melakukan penelitian, menganalisis data, dan menggunakan logika untuk memecahkan masalah. Kamu cenderung menyukai bidang-bidang ilmiah, teknis, dan penelitian, seperti sains, matematika, dan teknologi informasi.";
            break;
        case 'A':
            $deskripsi = "Orang dengan tipe kepribadian artistik cenderung memiliki imajinasi yang kuat dan ekspresi kreatif yang tinggi. Kamu menikmati seni dalam berbagai bentuknya, seperti seni visual, musik, drama, atau tulisan kreatif. Mereka biasanya tidak menyukai rutinitas yang ketat dan lebih suka bekerja di lingkungan yang memungkinkan ekspresi diri jadi lebih sering menghindari lingkungan yang kaku dan merasa terkekang oleh aturan.";
            break;
        case 'S':
            $deskripsi = "Social (S) - Kamu suka membantu orang lain, bekerja dalam tim, dan memberikan dukungan.";
            break;
        case 'E':
            $deskripsi = "Enterprising (E) - Kamu suka memimpin, berbicara di depan umum, dan bekerja dalam bidang bisnis.";
            break;
        case 'C':
            $deskripsi = "Conventional (C) - Kamu suka bekerja dengan data, mengikuti aturan, dan bekerja dalam bidang administrasi.";
            break;
    } ?>
    <p style="text-align: center; font-size: 2em;"><b><?php echo $dominantType; ?></b></p>
    <p>Yaitu: <?php echo $deskripsi; ?></p>
    <p>Jika kamu sudah mengisi nilai rapot dan tes riasec, silahkan klik tombol dibawah atau pergi ke halaman "Hasil rekomendasi" untuk melihat jurusan apa yang sesuai dengan kemampuan dan sifat kamu.</p>
    <button onclick="window.location.href='hasil_rekomendasi.php'">Lihat Hasil Rekomendasi Jurusan</button>
</main>
<?php include "structure/footer.php"?>
</body>
</html>