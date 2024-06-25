<?php
include '../koneksi.php';

// Periksa apakah formulir telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['edit_id_diskon'] ?? null;
    $kode = $_POST['edit_kode'] ?? null;
    $persentase_diskon = $_POST['edit_persentase_diskon'] ?? null;

    $sql = "UPDATE discounts SET kode='$kode', persentase_diskon='$persentase_diskon' WHERE discount_id='$id'";
                // Jalankan query
                if ($koneksi->query($sql) === TRUE) {
                    echo "Data diskon berhasil diperbarui";
                    header('Location: daftar_diskon.php');
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        }

// Tutup koneksi
$koneksi->close();
?>