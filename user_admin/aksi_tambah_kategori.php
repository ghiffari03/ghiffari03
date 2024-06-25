<?php
include "../koneksi.php";
$nmkategori = $_POST['nama_kategori'];
$deskripsi = $_POST['deskripsi'];
$sql = "INSERT INTO categories(nama_kategori, deskripsi_kategori) VALUES
    ('" . $nmkategori . "','" . $deskripsi . "')";
$query = $koneksi->query($sql);
if ($query === true) {
    header('location: daftar_kategori.php');
} else {
    echo "eror";
}
?>