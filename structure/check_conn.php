<?php

session_start();

if (!isset($_SESSION['email'])) {
    // user is not logged in, redirect them to the login page
    header('Location: login.php');
    exit;
}
?>
