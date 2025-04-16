<?php
// Fungsi untuk melakukan register
function register($username, $password, $email, $conn) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password_hash', '$email')";
    return $conn->query($sql);
}

// Fungsi untuk melakukan login
function login($username, $password, $conn) {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return true;
        }
    }
    return false;
}
?>


