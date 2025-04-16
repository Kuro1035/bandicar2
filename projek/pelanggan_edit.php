<?php
include('db.php'); // Menghubungkan ke database

// Ambil data pelanggan berdasarkan ID untuk ditampilkan di form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM pelanggan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data pelanggan tidak ditemukan!'); window.location='pelanggan.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location='pelanggan.php';</script>";
    exit;
}

// Proses update data pelanggan
if (isset($_POST['update'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_ktp = $_POST['no_ktp'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    $query = "UPDATE pelanggan SET 
                nama_pelanggan = '$nama_pelanggan', 
                no_ktp = '$no_ktp', 
                alamat = '$alamat', 
                no_telp = '$no_telp' 
              WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data pelanggan berhasil diupdate!'); window.location='pelanggan.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data pelanggan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggan</title>
    <link rel="stylesheet" href="pelanggan.css">
</head>
<body>
    <h1>Edit Data Pelanggan</h1>

    <!-- Form Edit Data Pelanggan -->
    <form method="POST" action="">
        <label for="nama_pelanggan">Nama Pelanggan:</label>
        <input type="text" name="nama_pelanggan" value="<?php echo $data['nama_pelanggan']; ?>" required>

        <label for="no_ktp">No KTP:</label>
        <input type="text" name="no_ktp" value="<?php echo $data['no_ktp']; ?>" required>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required>

        <label for="no_telp">No Telepon:</label>
        <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" required>

        <button type="submit" name="update">Update</button>
        <button><a href="pelanggan.php" class="btn-batal">Batal</a></button>
    </form>
</body>
</html>
