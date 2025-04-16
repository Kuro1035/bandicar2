<?php
include('db.php');

// Proses Tambah User
if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];

    $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
    mysqli_query($koneksi, $query);
    header("Location: user.php");
}

// Proses Hapus User
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM user WHERE id='$id'";
    mysqli_query($koneksi, $query);
    header("Location: user.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <link rel="stylesheet" href="user.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        form { margin-top: 20px; }
        button { padding: 5px 10px; }
        .btn-delete { color: red; }
    </style>
</head>
<body>
    <h1>Manajemen User</h1>

    <!-- Form Tambah User -->
    <form method="POST" action="user.php">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="operator">Operator</option>
        </select>
        <button type="submit" name="simpan">Simpan</button>
        <a href="dashboard.php" class="btn-batal">Batal</a>
    </form>

    <!-- Tabel Data User -->
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT * FROM user";
        $result = mysqli_query($koneksi, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td>
                    <a href='user_edit.php?id={$row['id']}'>Edit</a> | 
                    <a href='user.php?hapus={$row['id']}' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus user ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
