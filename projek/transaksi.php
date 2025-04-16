<?php
include('db.php'); // Menghubungkan database

if (isset($_POST['simpan'])) {
    $id_mobil = $_POST['id_mobil'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Query simpan
    $query = "INSERT INTO transaksi (id_mobil, id_pelanggan, tanggal_sewa, tanggal_kembali) 
              VALUES ('$id_mobil', '$id_pelanggan', '$tanggal_sewa', '$tanggal_kembali')";

    // Debugging
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Transaksi berhasil ditambahkan'); window.location='transaksi.php';</script>";
    } else {
        echo "Gagal menyimpan transaksi: " . mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi Baru</title>
    <link rel="stylesheet" href="transaksi.css">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Tambah Transaksi Baru</h2>
        </div>
        <form method="POST" action="transaksi.php">
            <!-- Jenis Mobil -->
            <label for="id_mobil">Jenis Mobil</label>
            <select name="id_mobil" required>
                <option value="">Silahkan Pilih</option>
                <option value="1">Toyota Avanza</option>
                <option value="2">Honda Jazz</option>
                <option value="3">Suzuki Ertiga</option>
            </select>
            <!-- No KTP -->
            <label for="id_pelanggan">No KTP</label>
            <input type="text" name="id_pelanggan" placeholder="Masukkan No KTP" required>

            <!-- Tanggal Sewa -->
            <label for="tanggal_sewa">Tanggal Sewa</label>
            <input type="date" name="tanggal_sewa" required>

            <!-- Tanggal Selesai Sewa -->
            <label for="tanggal_kembali">Tanggal Selesai Sewa</label>
            <input type="date" name="tanggal_kembali" required>

            <!-- Tombol Simpan dan Batal -->
            <div class="button-container">
                <button type="submit" name="simpan" class="btn-simpan">Simpan</button>
                <a href="dashboard.php" class="btn-batal">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
