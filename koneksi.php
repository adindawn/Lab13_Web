<?php
$host = "localhost";
$user = "root";
$pass = "mysql";
$db   = "praktikum14";

// koneksi ke database
$conn = mysqli_connect($host, $user, $pass, $db);

// cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
