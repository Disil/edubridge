<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "020707";
$db_name = "edubridge_mysql";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/* if ($conn) {
    echo "Koneksi Berhasil";
} else {
    echo "Koneksi Gagal";
} */
