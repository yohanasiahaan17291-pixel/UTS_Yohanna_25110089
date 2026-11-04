<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../config/koneksi.php";

$query = mysqli_query($koneksi,
    "SELECT * FROM produk ORDER BY id DESC"
);

$total = mysqli_num_rows(mysqli_query(
    $koneksi, "SELECT id FROM produk"
));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard My Store</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<h1>MY STORE</h1>

<h2>Dashboard Admin</h2>

<p>Selamat datang, <?= htmlspecialchars($_SESSION['admin']); ?></p>

<h3>Total Produk: <?= $total; ?></h3>

<a href="tambah_produk.php">
    <button>+ Tambah Produk</button>
</a>

<a href="logout.php">Logout</a>

<h2>Daftar Produk</h2>

<table border="1" cellpadding="10">

<tr>
    <th>No</th>
    <th>Nama Produk</th>
    <th>Kategori</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; ?>

<?php while($data=mysqli_fetch_assoc($query)) { ?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($data['nama_produk']); ?></td>

<td><?= htmlspecialchars($data['kategori']); ?></td>

<td>Rp <?= number_format($data['harga']); ?></td>

<td><?= $data['stok']; ?></td>

<td><?= $data['status']; ?></td>

<td>
    <a href="edit_produk.php?id=<?= $data['id']; ?>">Edit</a>

    |

    <a href="hapus_produk.php?id=<?= $data['id']; ?>"
    onclick="return confirm('Yakin ingin menghapus produk?')">
    Hapus
    </a>
</td>

</tr>

<?php } ?>

</table>

</body>
</html>