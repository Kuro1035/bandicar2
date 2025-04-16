<?php
include('db.php'); // Menghubungkan ke database

// Hapus data pelanggan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM pelanggan WHERE id = $id";
    mysqli_query($koneksi, $query);
    echo "<script>alert('Data pelanggan berhasil dihapus!'); window.location='pelanggan.php';</script>";
}

// Simpan data pelanggan baru
if (isset($_POST['simpan'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_ktp = $_POST['no_ktp'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    $query = "INSERT INTO pelanggan (nama_pelanggan, no_ktp, alamat, no_telp) 
              VALUES ('$nama_pelanggan', '$no_ktp', '$alamat', '$no_telp')";

    mysqli_query($koneksi, $query);
    echo "<script>alert('Data pelanggan berhasil ditambahkan!'); window.location='pelanggan.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Pelanggan</title>
    <link rel="stylesheet" href="pelanggan.css">
</head>
<body>
    <h1>Manajemen Data Pelanggan</h1>

    <!-- Form Tambah Data Pelanggan -->
    <form method="POST" action="pelanggan.php">
        <label for="nama_pelanggan">Nama Pelanggan:</label>
        <input type="text" name="nama_pelanggan" placeholder="Masukkan nama pelanggan" required>

        <label for="no_ktp">No KTP:</label>
        <input type="text" name="no_ktp" placeholder="Masukkan No KTP" required>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" placeholder="Masukkan alamat" required>

        <label for="no_telp">No Telepon:</label>
        <input type="text" name="no_telp" placeholder="Masukkan No Telepon" required>

        <button type="submit" name="simpan">Simpan</button>
        <button type="submbit"><a href="dashboard.php" class="btn-batal">Batal</a></button>
    </form>

    <!-- Tabel Data Pelanggan -->
    <h2>Daftar Pelanggan</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>No KTP</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT * FROM pelanggan";
        $result = mysqli_query($koneksi, $query);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['nama_pelanggan']}</td>";
            echo "<td>{$row['no_ktp']}</td>";
            echo "<td>{$row['alamat']}</td>";
            echo "<td>{$row['no_telp']}</td>";
            echo "<td>
                <a href='pelanggan_edit.php?id={$row['id']}' class='btn-edit'>Edit</a>
                <a href='pelanggan.php?hapus={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus?')\" class='btn-delete'>Hapus</a>
                </td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>
