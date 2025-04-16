<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_mobil = $_POST['id_mobil'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    // Ambil Harga Mobil
    $query_mobil = "SELECT harga FROM mobil WHERE id = '$id_mobil'";
    $result = mysqli_query($koneksi, $query_mobil);
    $data = mysqli_fetch_assoc($result);
    $harga = $data['harga'];

    // Simpan Transaksi
    $query = "INSERT INTO transaksi (id_pelanggan, id_mobil, tanggal_pinjam, tanggal_kembali, total_bayar)
              VALUES ('$id_pelanggan', '$id_mobil', '$tanggal_sewa', '$tanggal_selesai', '$harga')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
