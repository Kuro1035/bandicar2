<?php
include('db.php');

// Ambil data user
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
}

// Proses Update User
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $query = "UPDATE user SET username='$username', role='$role' WHERE id='$id'";
    mysqli_query($koneksi, $query);
    header("Location: user.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST" action="user_edit.php">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $data['username']; ?>" required>
        <label>Role:</label>
        <select name="role" required>
            <option value="admin" <?php if ($data['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="operator" <?php if ($data['role'] == 'operator') echo 'selected'; ?>>Operator</option>
        </select>
        <button type="submit" name="update">Update</button>
        <a href="user.php">Batal</a>
    </form>
</body>
</html>
