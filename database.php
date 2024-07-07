<?php
$servername = "localhost";
$username = "wpcguvfn_user";
$password = "EduBridgeID";
$dbname = "wpcguvfn_edubridge_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}