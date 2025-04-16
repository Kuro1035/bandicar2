<?php
include('db.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect data from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email is already registered
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "Email sudah terdaftar!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $koneksi->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        $stmt->execute();

        echo "Registrasi berhasil! <a href='index.php'>Login Sekarang</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form method="POST">
            <h2>Register</h2>

            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
