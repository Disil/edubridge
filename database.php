<?php
$db_server = "edubridge.my.id";
$db_user = "root";
$db_pass = "S@tri@2007";
$db_name = "wpcguvn_edubridge_db";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    die("Connection failed: " . $conn->connect_error);
}