<?php
include('db.php'); // Menghubungkan ke database

// Hapus data mobil
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    // Ambil nama gambar yang terhapus
    $query = "SELECT gambar FROM mobil WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $gambar = $row['gambar'];
    
    // Hapus gambar dari server
    if ($gambar) {
        unlink("images/$gambar"); // Hapus file gambar dari folder images
    }

    $query = "DELETE FROM mobil WHERE id = $id";
    mysqli_query($koneksi, $query);
    echo "<script>alert('Data mobil berhasil dihapus!'); window.location='mobil.php';</script>";
}

// Proses simpan data mobil baru
if (isset($_POST['simpan'])) {
    $nama_mobil = $_POST['nama_mobil'];
    $merk = $_POST['merk'];
    $tahun = $_POST['tahun'];
    $harga_sewa = $_POST['harga_sewa'];

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_path = "images/" . $gambar;
    move_uploaded_file($gambar_tmp, $gambar_path);

    $query = "INSERT INTO mobil (nama_mobil, merk, tahun, harga_sewa, gambar) 
              VALUES ('$nama_mobil', '$merk', '$tahun', '$harga_sewa', '$gambar')";

    mysqli_query($koneksi, $query);
    echo "<script>alert('Data mobil berhasil ditambahkan!'); window.location='mobil.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mobil</title>
    <link rel="stylesheet" href="mobil.css">
</head>
<body>
    <h1>Manajemen Data Mobil</h1>

    <!-- Form Tambah Data Mobil -->
    <form method="POST" action="mobil.php" enctype="multipart/form-data">
        <label for="nama_mobil">Nama Mobil:</label>
        <input type="text" name="nama_mobil" placeholder="Masukkan nama mobil" required>

        <label for="merk">Merk Mobil:</label>
        <input type="text" name="merk" placeholder="Masukkan merk mobil" required>

        <label for="tahun">Tahun Produksi:</label>
        <input type="number" name="tahun" placeholder="Masukkan tahun produksi" required>

        <label for="harga_sewa">Harga Sewa Per Hari:</label>
        <input type="number" name="harga_sewa" placeholder="Masukkan harga sewa" required>

        <!-- Input Gambar -->
        <label for="gambar">Gambar Mobil:</label>
        <input type="file" name="gambar" accept="image/*" required>

        <button type="submit" name="simpan">Simpan</button>
        <button><a href="dashboard.php" class="btn-batal">Batal</a></button>
    </form>

    <!-- Tabel Data Mobil -->
    <h2>Daftar Mobil</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Mobil</th>
            <th>Merk Mobil</th>
            <th>Tahun</th>
            <th>Harga Sewa</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT * FROM mobil";
        $result = mysqli_query($koneksi, $query);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['nama_mobil']}</td>";
            echo "<td>{$row['merk']}</td>";
            echo "<td>{$row['tahun']}</td>";
            echo "<td>Rp. " . number_format($row['harga_sewa'], 0, ',', '.') . "</td>";
            // Menampilkan gambar
            echo "<td><img src='{$row['gambar']}' width='100' height='75'></td>";
            echo "<td>
                <a href='mobil_edit.php?id={$row['id']}' class='btn-edit'>Edit</a>
                <a href='mobil.php?hapus={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus?')\" class='btn-delete'>Hapus</a>
                </td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>
