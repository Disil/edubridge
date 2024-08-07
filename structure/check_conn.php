<?php

session_start();

if (!isset($_SESSION['email'])) {
    // user is not logged in, redirect them to the login page
    header('Location: ../login.php');
    exit;
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (isset($_SESSION['id_siswa'])) {
    $id_siswa = $_SESSION['id_siswa'];
    $nama_siswa = $_SESSION['nama_siswa'];
} else {
    echo "id_siswa is not set in the session";
}

ini_set('display_errors', 1);
error_reporting(E_ALL);