<?php
session_start();
include "../config/koneksi.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
        $koneksi,
        "SELECT * FROM admin WHERE username = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {

        session_regenerate_id(true);
        $_SESSION['admin'] = $admin['username'];

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login My Store</title>
</head>

<body>

<h2>LOGIN ADMIN MY STORE</h2>

<?php if(isset($error)) echo $error; ?>

<form method="POST">

    <input type="text" name="username"
    placeholder="Username" required>

    <br><br>

    <input type="password" name="password"
    placeholder="Password" required>

    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>

</body>
</html>