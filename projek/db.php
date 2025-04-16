<?php
$host = "localhost";      // Host database
$user = "root";           // Username database
$pass = "";               // Password database
$db   = "rental_mobil";   // Nama database

// Koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
