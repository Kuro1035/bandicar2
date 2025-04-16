<?php
$host = "localhost";
$user = "root";        // Sesuaikan dengan user database Anda
$password = "";        // Sesuaikan dengan password database Anda
$dbname = "rental_mobil";  // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
