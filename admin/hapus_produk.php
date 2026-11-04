<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../config/koneksi.php";

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($koneksi,
    "DELETE FROM produk WHERE id=?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: dashboard.php");
exit;
?>