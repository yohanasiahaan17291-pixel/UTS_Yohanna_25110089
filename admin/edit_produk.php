<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../config/koneksi.php";

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($koneksi,
    "SELECT * FROM produk WHERE id=?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) {
    die("Produk tidak ditemukan");
}

if (isset($_POST['update'])) {

    $nama = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = mysqli_prepare($koneksi,
        "UPDATE produk SET nama_produk=?,
        kategori=?, harga=?, stok=?,
        status=?, deskripsi=? WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt, "ssdissi",
        $nama, $kategori, $harga, $stok,
        $status, $deskripsi, $id
    );

    mysqli_stmt_execute($stmt);

    header("Location: dashboard.php");
    exit;
}
?>

<h2>Edit Produk</h2>

<form method="POST">

<input name="nama_produk"
value="<?= htmlspecialchars($data['nama_produk']); ?>" required><br><br>

<input name="kategori"
value="<?= htmlspecialchars($data['kategori']); ?>" required><br><br>

<input type="number" name="harga"
value="<?= $data['harga']; ?>" required><br><br>

<input type="number" name="stok"
value="<?= $data['stok']; ?>" required><br><br>

<select name="status">
<option value="aktif">Aktif</option>
<option value="discontinued">Discontinued</option>
</select><br><br>

<textarea name="deskripsi"><?= htmlspecialchars($data['deskripsi']); ?></textarea><br><br>

<button name="update">Update Produk</button>

</form>