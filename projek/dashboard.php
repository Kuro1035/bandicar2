<?php 
include('db.php'); // Koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rental Mobil</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">RENTAL MOBIL</div>
        <div class="admin">admin</div>
    </header>

    <!-- Sidebar -->
    <aside>
        <div class="sidebar-logo">
            <img src="k.png" alt="Rental Mobil">
        </div>
        <nav>
            <ul>
                <li class="active"><a href="dashboard.php">Dashboard</a></li>
                <li><a href="user.php">User</a></li>
                <li><a href="mobil.php">Mobil</a></li>
                <li><a href="pelanggan.php">Pelanggan</a></li>
                <li><a href="transaksi.php">Transaksi</a></li>
                <li><a href="index.php">logout</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main>
        <h1>Dashboard</h1>

        <!-- Dashboard Cards -->
        <section class="dashboard-cards">
            <div class="card blue">
                <div class="icon">🚗</div>
                <h2>Jumlah Mobil</h2>
                <?php 
                $mobil_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM mobil");
                $mobil = mysqli_fetch_assoc($mobil_result);
                ?>
                <p><?php echo $mobil['total']; ?></p>
                <a href="mobil.php">Lihat Selengkapnya</a>
            </div>
            <div class="card green">
                <div class="icon">👥</div>
                <h2>Total Pelanggan</h2>
                <?php 
                $pelanggan_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pelanggan");
                $pelanggan = mysqli_fetch_assoc($pelanggan_result);
                ?>
                <p><?php echo $pelanggan['total']; ?></p>
                <a href="pelanggan.php">Lihat Selengkapnya</a>
            </div>
            <div class="card orange">
                <div class="icon">👤</div>
                <h2>Jumlah User</h2>
                <?php 
                $user_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users");
                $user = mysqli_fetch_assoc($user_result);
                ?>
                <p><?php echo $user['total']; ?></p>
                <a href="user.php">Lihat Selengkapnya</a>
            </div>
            <div class="card red">
                <div class="icon">📊</div>
                <h2>Jumlah Transaksi Pelanggan</h2>
                <?php 
                $transaksi_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi");
                $transaksi = mysqli_fetch_assoc($transaksi_result);
                ?>
                <p><?php echo $transaksi['total']; ?></p>
                <a href="transaksi.php">Lihat Selengkapnya</a>
            </div>
        </section>
        </table>
        </div>
    </main>
</body>
</html>
