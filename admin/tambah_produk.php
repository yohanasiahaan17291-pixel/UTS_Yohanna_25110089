<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = mysqli_prepare($koneksi,
        "INSERT INTO produk
        (nama_produk,kategori,harga,stok,deskripsi)
        VALUES (?,?,?,?,?)"
    );

    mysqli_stmt_bind_param(
        $stmt, "ssdis",
        $nama, $kategori, $harga, $stok, $deskripsi
    );

    mysqli_stmt_execute($stmt);

    header("Location: dashboard.php");
    exit;
}
?>

<h2>Tambah Produk</h2>

<form method="POST">

<input name="nama_produk" placeholder="Nama Produk" required><br><br>

<input name="kategori" placeholder="Kategori" required><br><br>

<input type="number" name="harga" placeholder="Harga" required><br><br>

<input type="number" name="stok" placeholder="Stok" required><br><br>

<textarea name="deskripsi" placeholder="Deskripsi"></textarea><br><br>

<button name="simpan">Simpan Produk</button>

</form>