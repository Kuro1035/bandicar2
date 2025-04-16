<?php
include('db.php'); // Koneksi ke database

// Periksa apakah ID pesanan diterima
if (isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    // Hapus data pesanan berdasarkan ID
    $query = "DELETE FROM pesanan WHERE id = $id_pesanan";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Pesanan berhasil dihapus!'); window.location='daftar_pesanan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pesanan!'); window.location='daftar_pesanan.php';</script>";
    }
} else {
    echo "<script>alert('ID pesanan tidak ditemukan!'); window.location='daftar_pesanan.php';</script>";
}
?>
