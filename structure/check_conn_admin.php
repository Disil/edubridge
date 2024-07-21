<?php
session_start(); // Start or resume the session

if (!isset($_SESSION['username'])) {
    // user is not logged in, redirect them to the login page
    header('Location: admin/login_admin.php');
    exit;
}

// Check if the user is already logged in
if (isset($_SESSION['id_admin'])) {
    // User is already logged in, redirect to dashboard
    $id_admin = $_SESSION['id_admin'];
    $username = $_SESSION['username'];
} else {
    echo "id_admin is not set in the session";
}