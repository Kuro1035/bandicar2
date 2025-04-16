<?php
include('db.php'); // Menghubungkan ke database

// Ambil ID mobil yang akan diedit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Ambil data mobil dari database
    $query = "SELECT * FROM mobil WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    // Jika tidak ada id, redirect ke halaman daftar mobil
    echo "<script>window.location = 'mobil.php';</script>";
}

// Proses update data mobil
if (isset($_POST['update'])) {
    $nama_mobil = $_POST['nama_mobil'];
    $merk = $_POST['merk'];
    $tahun = $_POST['tahun'];
    $harga_sewa = $_POST['harga_sewa'];

    // Cek jika ada gambar yang diupload
    if ($_FILES['gambar']['name'] != "") {
        // Hapus gambar lama jika ada
        $gambar_lama = $row['gambar'];
        if ($gambar_lama) {
            unlink("images/$gambar_lama");
        }

        // Proses upload gambar baru
        $gambar = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_path = "" . $gambar;
        move_uploaded_file($gambar_tmp, $gambar_path);

        // Update data mobil dengan gambar baru
        $query = "UPDATE mobil SET nama_mobil = '$nama_mobil', merk = '$merk', tahun = '$tahun', harga_sewa = '$harga_sewa', gambar = '$gambar' WHERE id = $id";
    } else {
        // Jika tidak ada gambar baru, update data tanpa gambar
        $query = "UPDATE mobil SET nama_mobil = '$nama_mobil', merk = '$merk', tahun = '$tahun', harga_sewa = '$harga_sewa' WHERE id = $id";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data mobil berhasil diperbarui!'); window.location='mobil.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mobil</title>
    <link rel="stylesheet" href="mobil.css">
</head>
<body>
    <h1>Edit Data Mobil</h1>

    <!-- Form Edit Data Mobil -->
    <form method="POST" action="mobil_edit.php?id=<?php echo $row['id']; ?>" enctype="multipart/form-data">
        <label for="nama_mobil">Nama Mobil:</label>
        <input type="text" name="nama_mobil" value="<?php echo $row['nama_mobil']; ?>" required>

        <label for="merk">Merk Mobil:</label>
        <input type="text" name="merk" value="<?php echo $row['merk']; ?>" required>

        <label for="tahun">Tahun Produksi:</label>
        <input type="number" name="tahun" value="<?php echo $row['tahun']; ?>" required>

        <label for="harga_sewa">Harga Sewa Per Hari:</label>
        <input type="number" name="harga_sewa" value="<?php echo $row['harga_sewa']; ?>" required>

        <!-- Input Gambar (Jika ingin mengganti gambar) -->
        <label for="gambar">Gambar Mobil:</label>
        <input type="file" name="gambar" accept="image/*">

        <!-- Menampilkan Gambar yang Ada -->
        <?php if ($row['gambar']) { ?>
            <img src="<?php echo $row['gambar']; ?>" width="100" height="75" alt="Gambar Mobil">
        <?php } ?>

        <button type="submit" name="update">Update</button>
        <button><a href="mobil.php" class="btn-batal">Batal</a></button>
    </form>
</body>
</html>
