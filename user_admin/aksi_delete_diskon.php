<?php
include("../koneksi.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Query untuk menghapus produk berdasarkan id
    $sql = "DELETE FROM discounts WHERE discount_id='$id'";
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('HAPUS DATA BERHASIL');</script>";
    } else {
        echo "<script>alert('HAPUS DATA GAGAL');</script>";
    }
}
header('Location: daftar_diskon.php');
?>
