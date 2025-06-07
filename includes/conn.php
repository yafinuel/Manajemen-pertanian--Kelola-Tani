<?php
session_start();
$host = "localhost";
$db_user = "root";
$db_pass = "root";
$db_name = "kelola_tani";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function isLoggedIn() {
    return isset($_SESSION['id_user']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ../login/login.php");
        exit();
    }
}
?>