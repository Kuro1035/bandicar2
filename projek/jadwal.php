<?php
include('db.php');

// Query untuk mengambil data jadwal pemesanan
$query = "SELECT p.id, m.nama_mobil, m.merk, p.nama_pemesan, p.tanggal, p.durasi 
          FROM pesanan p 
          JOIN mobil m ON p.id_mobil = m.id 
          ORDER BY p.tanggal ASC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Jadwal</title>
    <link rel="stylesheet" href="jadwal.css">
</head>
<body>
    <div class="container">
        <h1>Jadwal Pemesanan Mobil</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Mobil</th>
                    <th>Merk</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Sewa</th>
                    <th>Durasi (Hari)</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_mobil']); ?></td>
                            <td><?php echo htmlspecialchars($row['merk']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_pemesan']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                            <td><?php echo htmlspecialchars($row['durasi']); ?></td>
                            <td>
                                <?php 
                                    $tanggal_selesai = date('Y-m-d', strtotime($row['tanggal'] . ' + ' . $row['durasi'] . ' days'));
                                    echo htmlspecialchars($tanggal_selesai);
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Tidak ada jadwal pemesanan saat ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <button><a href="dashboard_user.php" class"btn">keluar</a></button>
        </table>
    </div>
</body>
</html>
