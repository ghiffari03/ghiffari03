<?php
include("../koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM categories WHERE kategori_id='$id'";
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('HAPUS DATA BERHASIL');</script>";
    } else {
        echo "<script>alert('HAPUS DATA GAGAL');</script>";
    }
}
header('Location: daftar_kategori.php'); 

?>

<!--
echo "<script>window.location.href = 'daftar_kategori.php';</script>";
-->