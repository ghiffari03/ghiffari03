<?php
include '../koneksi.php'; // Sertakan file koneksi database Anda

// Periksa apakah formulir telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = $_POST['kode'] ?? null;
    $persentase_diskon = $_POST['persentase_diskon'] ?? null;

    $sql = "INSERT INTO discounts (kode, persentase_diskon) VALUES ('$kode', '$persentase_diskon')";
    $query = $koneksi->query($sql);
    if ($query === true ) {
        header('Location: daftar_diskon.php');
    } else {
        echo "error";
    }    
}

// Tutup koneksi
$koneksi->close();
?>