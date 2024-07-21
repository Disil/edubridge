<?php //include '../structure/check_conn_admin.php';
include '../database.php';
global $conn;

$sql = "SELECT * FROM acuan_nilai_jurusan";
$result = $conn->query($sql);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO acuan_nilai_jurusan (id_jurusan, nama_jurusan, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssssssssss", $id_jurusan, $nama_jurusan, $ipa, $ips, $bahasa, $praktek, $politik, $seni, $R, $I, $A, $S, $E, $C);

$nama_jurusan = $_POST['nama_jurusan'];
$ipa = $_POST['ipa'];
$ips = $_POST['ips'];
$bahasa = $_POST['bahasa'];
$praktek = $_POST['praktek'];
$politik = $_POST['politik'];
$seni = $_POST['seni'];
$R = $_POST['R'];
$I = $_POST['I'];
$A = $_POST['A'];
$S = $_POST['S'];
$E = $_POST['E'];
$C = $_POST['C'];

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = $stmt->error;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/classless.css">
    <link rel="stylesheet" href="../css/tabbox.css">
    <link rel="stylesheet" href="../css/themes.css">
    <title>EduBridge - Kelola Jurusan</title>
</head>
<body>
<header>
    <?php include '../structure/navbar.php'; ?>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th>ID Jurusan</th>
            <th>Nama Jurusan</th>
            <th>IPA</th>
            <th>IPS</th>
            <th>Bahasa</th>
            <th>Praktek</th>
            <th>Politik</th>
            <th>Seni</th>
            <th>R</th>
            <th>I</th>
            <th>A</th>
            <th>S</th>
            <th>E</th>
            <th>C</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_jurusan"] . "</td>";
                echo "<td>" . $row["nama_jurusan"] . "</td>";
                echo "<td>" . $row["ipa"] . "</td>";
                echo "<td>" . $row["ips"] . "</td>";
                echo "<td>" . $row["bahasa"] . "</td>";
                echo "<td>" . $row["praktek"] . "</td>";
                echo "<td>" . $row["politik"] . "</td>";
                echo "<td>" . $row["seni"] . "</td>";
                echo "<td>" . $row["R"] . "</td>";
                echo "<td>" . $row["I"] . "</td>";
                echo "<td>" . $row["A"] . "</td>";
                echo "<td>" . $row["S"] . "</td>";
                echo "<td>" . $row["E"] . "</td>";
                echo "<td>" . $row["C"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='14'>No data available</td></tr>";
        }
        ?>
        </tbody>
    </table>
    <h2>Tambah Jurusan Baru</h2>
    <form id="addRowForm" method="post" action="edit_jurusan.php">
        <label for="nama_jurusan">Nama Jurusan:</label><br>
        <input type="text" id="nama_jurusan" name="nama_jurusan"><br>
        <label for="ipa">IPA:</label><br>
        <input type="text" id="ipa" name="ipa"><br>
        <label for="ips">IPS:</label><br>
        <input type="text" id="ips" name="ips"><br>
        <label for="bahasa">Bahasa:</label><br>
        <input type="text" id="bahasa" name="bahasa"><br>
        <label for="praktek">Praktek:</label><br>
        <input type="text" id="praktek" name="praktek"><br>
        <label for="politik">Politik:</label><br>
        <input type="text" id="politik" name="politik"><br>
        <label for="seni">Seni:</label><br>
        <input type="text" id="seni" name="seni"><br>
        <label for="R">R:</label><br>
        <input type="text" id="R" name="R"><br>
        <label for="I">I:</label><br>
        <input type="text" id="I" name="I"><br>
        <label for="A">A:</label><br>
        <input type="text" id="A" name="A"><br>
        <label for="S">S:</label><br>
        <input type="text" id="S" name="S"><br>
        <label for="E">E:</label><br>
        <input type="text" id="E" name="E"><br>
        <label for="C">C:</label><br>
        <input type="text" id="C" name="C"><br>
        <button type="submit">Add Row</button>
    </form>

    <script>
        document.getElementById('addRowForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const form = event.target;
            const data = new FormData(form);

            fetch('edit_jurusan.php', {
                method: 'POST',
                body: data
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Row added successfully!');
                        location.reload();
                    } else {
                        alert('Failed to add row. ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error adding row.');
                });
        });
    </script>
</main>
</body>
</html>