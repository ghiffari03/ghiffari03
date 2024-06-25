<?php
session_start();
include "../koneksi.php";
$nmjasa = $_POST['nama_jasa'];
$desjasas = $_POST['deskripsi_jasa'];
$harga = $_POST['harga'];
$jenis = $_POST['jenis'];
$idmitra = $_SESSION['id_user'];

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

        $sql = "INSERT INTO jasa (nama_jasa, deskripsi, harga_jasa, jenis_jasa, gambar_jasa, id_mitra_usaha) VALUES
        ('" . $nmjasa . "','" . $desjasas . "','" . $harga . "', '" . $jenis . "','" . $path . "', $idmitra)";

        $query = $koneksi->query($sql);
        if ($query === true) {
            header('location: daftar_jasa.php');
        } else {
            echo "eror";
        }
    }
}
?>