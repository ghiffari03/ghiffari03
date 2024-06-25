<?php
include("../koneksi.php");

if(isset($_POST['submit'])){
    // Mengambil data yang dikirimkan dari form
    $id = $_POST['edit_id_kategori']; // Perubahan disini
    $nama_kategori = $_POST['edit_nama_kategori'];
    $deskripsi = $_POST['edit_deskripsi'];
    
    // Update data kategori ke database
    $sql = "UPDATE categories SET nama_kategori='$nama_kategori', deskripsi_kategori='$deskripsi' WHERE kategori_id='$id'";
    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil diupdate, kembali ke halaman daftar kategori
        header("Location: daftar_kategori.php?pesan=edit_berhasil");
    } else {
        // Jika gagal diupdate, kembali ke halaman daftar kategori dengan pesan gagal
        header("Location: daftar_kategori.php?pesan=edit_gagal");
    }
} else {
    // Jika form tidak disubmit, kembali ke halaman daftar kategori
    header("Location: daftar_kategori.php");
}
?>