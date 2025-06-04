<?php
$host = "localhost";
$username = "root";
$password = "root";
$database = "kelola_tani";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>