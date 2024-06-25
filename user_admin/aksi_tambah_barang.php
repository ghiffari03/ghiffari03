<?php
include "../koneksi.php";
$nmbarang = $_POST['nama_barang'];
$desbarang = $_POST['deskripsi_barang'];
$harga = $_POST['harga'];
$jenis = $_POST['jenis'];
$jumlah = $_POST['jumlah'];

$nama_file = $_FILES['file']['name'];
$ukuran_file = $_FILES['file']['size'];
$tmp_file = $_FILES['file']['tmp_name'];
$path = "../img/" . $nama_file;

if ($ukuran_file > 2 * 1024 * 1024) { // 2MB dalam byte
    echo "Ukuran file melebihi batas maksimum (2MB).";
} else {
    // Simpan file ke direktori yang ditentukan
    if (move_uploaded_file($tmp_file, $path)) {
        // File berhasil diunggah, lanjutkan dengan penambahan data ke dalam tabel materi

        $sql = "INSERT INTO barang (nama_barang, deskripsi, harga, stok, jenis, gambar) VALUES
        ('" . $nmbarang . "','" . $desbarang . "','" . $harga . "','" . $jumlah . "','" . $jenis . "','" . $path . "')";

        $query = $koneksi->query($sql);
        if ($query === true) {
            header('location: daftar_barang.php');
        } else {
            echo "eror";
        }
    }
}
?>