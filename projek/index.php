<?php
include('db.php');
include('functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data email, username, dan password dari form
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah email atau username terdaftar di database
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika email atau username ditemukan
    if ($result->num_rows > 0) {
        // Ambil data pengguna
        $users = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $users['password'])) {
            // Jika password benar, simpan data di session
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $users['username'];
            $_SESSION['role'] = $users['role']; // Simpan role di session

            // Redirect berdasarkan role
            if ($users['role'] == 'admin') {
                header('Location: dashboard.php'); // Redirect admin
            } else {
                header('Location: dashboard_user.php'); // Redirect user
            }
        } else {
            // Password salah
            echo "Password salah.";
        }
    } else {
        // Email atau username tidak ditemukan
        echo "Email atau Username tidak terdaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form method="POST">
            <h2>Login</h2>
            
            <!-- Kolom Email -->
            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>

            <!-- Kolom Username -->
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>

            <!-- Kolom Password -->
            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>

            <!-- Tombol Login -->
            <button type="submit">Login</button>
            <br><br>
            <!-- Link ke Register -->
            <p>Belum punya akun? <a href="register.php" class="register-link">Register</a></p>
        </form>
    </div>
</body>
</html>
