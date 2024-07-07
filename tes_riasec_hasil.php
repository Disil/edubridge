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
    echo "No scores found for this user. Please take the RIASEC test first.";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>RIASEC Test Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <style>
        h1 {
            text-align: center;
        }
        .chart-container {
            width: 80%;
            max-width: 600px;
            margin-top: 20px;
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
<h1>Your RIASEC Test Results</h1>
<?php include "structure/header.php"?>
<main>
    <div class="chart-container">
        <canvas id="riasecChart"></canvas>
    </div>

    <table class="scores-table">
        <tr>
            <th>R</th>
            <th>I</th>
            <th>A</th>
            <th>S</th>
            <th>E</th>
            <th>C</th>
        </tr>
        <tr>
            <?php foreach ($scores as $score): ?>
                <td><?php echo $score; ?></td>
            <?php endforeach; ?>
        </tr>
    </table>

    <script>
        const ctx = document.getElementById('riasecChart').getContext('2d');
        new Chart(ctx, {
            type: 'radar',
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
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    pointBackgroundColor: 'rgb(54, 162, 235)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(54, 162, 235)'
                }]
            },
            options: {
                elements: {
                    line: {
                        borderWidth: 3
                    }
                },
                scales: {
                    r: {
                        angleLines: {
                            display: false
                        },
                        suggestedMin: 0,
                        suggestedMax: 15
                    }
                }
            }
        });
    </script>
    <script>


        const ctx = document.getElementById('riasecChart').getContext('2d');

        const riasecChart = new Chart(ctx, {

            type: 'bar',

            data: {

                labels: ['Realistic', 'Investigative', 'Artistic', 'Social', 'Enterprising', 'Conventional'],

                datasets: [{

                    label: 'RIASEC Scores',

                    data: [<?php echo $scores['R']; ?>, <?php echo $scores['I']; ?>, <?php echo $scores['A']; ?>, <?php echo $scores['S']; ?>, <?php echo $scores['E']; ?>, <?php echo $scores['C']; ?>],

                    backgroundColor: 'rgba(54, 162, 235, 0.2)',

                    borderColor: 'rgba(54, 162, 235, 1)',

                    borderWidth: 1

                }]

            },

            options: {

                scale: {

                    ticks: {

                        beginAtZero: true,

                        max: 10

                    }

                }

            }

        });

    </script>
</main>
<?php include "structure/footer.php"?>
</body>
</html>