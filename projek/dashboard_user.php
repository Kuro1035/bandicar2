<?php
include('db.php');

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Rental Mobil</title>
    <link rel="stylesheet" href="dashboard_user.css">
</head>
<body>
    <!-- Menu Navigasi -->
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="index.php">Rental Mobil Bandicar</a>
        </div>
        <ul class="navbar-menu">
            <li><a href="index.php">Beranda</a></li>
            <li><a href="daftar_pesanan.php">Daftar pesanan</a></li>
        </ul>
        <div class="navbar-language">
            <a href="index.php">Logout</a> | <a href="index.php">Keluar</a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container">
        <h1>Pilihan Kendaraan</h1>
        <div class="card-container">
            <?php
            // Ambil data mobil dari database
            $query = "SELECT * FROM mobil";
            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='card'>
                    <img src='{$row['gambar']}' alt='{$row['nama_mobil']}' class='vehicle-image'>
                    <h3>{$row['nama_mobil']}</h3>
                    <p>Merk: {$row['merk']}</p>
                    <p>Tahun: {$row['tahun']}</p>
                    <p>Mulai Dari <strong>Rp " . number_format($row['harga_sewa'], 0, ',', '.') . "</strong></p>
                    <a href='pesan.php?id={$row['id']}' class='order-button'>Pesan</a>
                </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
