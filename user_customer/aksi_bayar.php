<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Anda belum login. <a href='../login.php'>Login di sini</a>");
}

$user = $_SESSION['username'];
$role = $_SESSION['role'];
$id_user = $_SESSION['id_user'];

if(isset($_POST['submit'])) {
    $id_order = $_GET['order_id'];
    $total_harga = $_POST['total_harga'];

    $alamat_pengiriman = $data['alamat'];

    $sql = "INSERT INTO pembayaran (id_transaksi, total_harga, metode_pembayaran, status_pembayaran) VALUES ('$id_order', '$total_harga', 'transfer bank', 'dibayar')";
    $query = $koneksi->query($sql);

    if ($query === TRUE) {
        $payment_id = $koneksi->insert_id;

        $sql = "UPDATE transaksi SET status = 'selesai' WHERE id_transaksi = '$id_order'";
        $query = $koneksi->query($sql);

    //     if ($query === TRUE) {
    //         // Insert ke tabel shipments 
    //         $status_pengiriman = 'diproses'; 

    //         $sql = "INSERT INTO shipments (payment_id, alamat_pengiriman, status_pengiriman) VALUES ('$payment_id', '$alamat_pengiriman', '$status_pengiriman')";
    //         $query = $koneksi->query($sql);

    //         if ($query === TRUE) {
    //             header("Location: order.php?pesan=insert_berhasil");
    //             exit();
    //         } else {
    //             echo "Error: " . $koneksi->error;
    //         }
    //     } else {
    //         echo "Error: " . $koneksi->error;
    //     }
    // } else {
    //     echo "Error: " . $koneksi->error;
    }
    header("Location: order.php");
}


// include("../koneksi.php");

// if(isset($_POST['submit'])) {
//     $id_order = $_GET['order_id'];
//     $total_harga = $_POST['total_harga'];
//     $dikon_id = $_POST['diskon_id'];

//     $sql = "INSERT INTO payments (order_id, total_harga, metode_pembayaran, status_pembayaran, discount_id) VALUES ('$id_order', '$total_harga', 'transfer bank', 'dibayar', '$dikon_id')";
//     $query = $koneksi->query($sql);
//     if ($query === TRUE) {
//         $sql = "UPDATE orders SET status_pesanan ='selesai' WHERE order_id='$id_order'";
//         $hasil =$koneksi->query($sql);
//         if ($hasil === TRUE){
//             $sql = "INSERT INTO shipments (payment_id, tanggal_pengiriman, alamat_pengiriman, ekspedisi, nomor_resi, status_pengiriman) VALUES (')";
//         }
//     } else {
//         echo " error ";
//         // header("Location: pemabayaran.php?");
//     }
// }
// header("Location: order.php");
?>