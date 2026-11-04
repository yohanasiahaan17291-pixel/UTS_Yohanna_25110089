<?php

$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "UTS_Yohanna_25110089"
);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>