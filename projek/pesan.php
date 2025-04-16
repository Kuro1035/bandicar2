<?php
include('db.php'); // Koneksi ke database

// Cek apakah parameter `id` tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID kendaraan tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Ambil data mobil berdasarkan ID
$id = $_GET['id'];
$query = "SELECT * FROM mobil WHERE id = $id";
$result = mysqli_query($koneksi, $query);

// Cek apakah data mobil ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data kendaraan tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Proses pemesanan jika form disubmit
if (isset($_POST['pesan'])) {
    $nama_pemesan = mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']);
    $tanggal_mulai = mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']);
    $tanggal_selesai = mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']);

    // Menghitung durasi sewa (dalam hari)
    $start_date = new DateTime($tanggal_mulai);
    $end_date = new DateTime($tanggal_selesai);
    $interval = $start_date->diff($end_date);
    $durasi = $interval->days;

    // Menghitung total harga
    $harga_sewa = $row['harga_sewa']; // Harga sewa per hari
    $total_harga = $durasi * $harga_sewa; // Total harga

    // Query untuk memasukkan data pesanan ke dalam tabel pesanan
    $query_pesanan = "INSERT INTO pesanan (id_mobil, nama_pemesan, tanggal_mulai, tanggal_selesai, durasi, total_harga) 
                      VALUES ('$id', '$nama_pemesan', '$tanggal_mulai', '$tanggal_selesai', '$durasi', '$total_harga')";

    if (mysqli_query($koneksi, $query_pesanan)) {
        echo "<script>alert('Pemesanan berhasil! Total harga: Rp " . number_format($total_harga, 0, ',', '.') . "'); window.location='daftar_pesanan.php';</script>";
    } else {
        echo "<script>alert('Gagal memesan kendaraan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kendaraan</title>
    <link rel="stylesheet" href="pesan.css">
</head>
<body>
    <div class="container">
        <h1>Pesan Kendaraan</h1>
        <div class="details">
            <h3>Detail Kendaraan</h3>
            <p>Nama Mobil: <?= htmlspecialchars($row['nama_mobil']) ?></p>
            <p>Harga Sewa Per Hari: Rp <?= number_format($row['harga_sewa'], 0, ',', '.') ?></p>
        </div>
        <!-- Form Pemesanan -->
        <form method="POST" action="">
            <label for="nama_pemesan">Nama Pemesan:</label>
            <input type="text" name="nama_pemesan" required>

            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" name="tanggal_mulai" required>

            <label for="tanggal_selesai">Tanggal Selesai:</label>
            <input type="date" name="tanggal_selesai" required>

            <button type="submit" name="pesan">Pesan</button>
            <button><a href="dashboard_user.php" class="btn-batal">Batal</a></button>
        </form>
    </div>
</body>
</html>
