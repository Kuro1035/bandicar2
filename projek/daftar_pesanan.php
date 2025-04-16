<?php
include('db.php'); // Koneksi ke database

// Ambil data pesanan dari tabel
$query = "SELECT pesanan.*, mobil.nama_mobil, mobil.harga_sewa FROM pesanan
          JOIN mobil ON pesanan.id_mobil = mobil.id";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="daftar_pesanan.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Pesanan</h1>
        <a href="dashboard_user.php" class="btn-batal">Kembali</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Mobil</th>
                <th>Tanggal Pesan</th>
                <th>Durasi (hari)</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$row['nama_pemesan']}</td>";
                echo "<td>{$row['nama_mobil']}</td>";
                echo "<td>{$row['tanggal_mulai']}</td>";
                echo "<td>{$row['tanggal_selesai']}</td>";
                echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
                echo "<td><a href='hapus_pesanan.php?id={$row['id']}' class='action-link' onclick=\"return confirm('Yakin ingin menghapus pesanan ini?')\">Hapus</a></td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </table>
    </div>
</body>
</html>
