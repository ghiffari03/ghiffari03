<?php
include("../koneksi.php");

if(isset($_POST['submit'])){
    $id = $_POST['edit_id_pengiriman']; 
    $tanggal_kirim = $_POST['edit_tanggal_pengiriman'];
    $ekspedisi = $_POST['edit_ekspedisi'];
    $no_resi = $_POST['edit_nomor_resi'];

    $tanggal_string = strtotime($tanggal_kirim);
    $tanggal = date('Y-m-d', $tanggal_string);

    
    $sql = "UPDATE shipments SET tanggal_pengiriman='$tanggal', ekspedisi='$ekspedisi', nomor_resi='$no_resi' WHERE id_pembayaran='$id'";
    if ($koneksi->query($sql) === TRUE) {
        header("Location: pengiriman.php?pesan=edit_berhasil");
    } else {
        header("Location: pengiriman.php?pesan=edit_gagal");
    }
} else {
    header("Location: pengiriman.php");
}

if(isset($_POST['submit_status'])){
    $id = $_POST['edit_id_pengiriman']; 
    $status_pengiriman = $_POST['edit_status_pengiriman'];

    $sql = "UPDATE pembayaran SET status_pembayaran='$status_pengiriman' WHERE id_pembayaran='$id'";
    if ($koneksi->query($sql) === TRUE) {
        echo "Status pengiriman berhasil diperbarui";
    } else {
        echo "Gagal memperbarui status pengiriman: " . $koneksi->error;
    }
} else {
    echo "Permintaan tidak valid";
}
?>
