<?php
session_start();
require_once "../koneksi.php";

//multi update
if (isset($_POST["update_keranjang_barang"])) {
    $jumlah = $_POST['jumlah'];
    $id = $_POST['id_cart'];
    foreach ($jumlah as $index => $item) {
        $query = "UPDATE keranjang_barang SET jumlah = $item where id_keranjang_barang = ".$id[$index];
        $koneksi->query($query);
    }

    header("Location:keranjang_barang.php");
    
}

if (isset($_POST["checkout_barang"])) {
    $jumlah = $_POST['jumlah'];
    $id = $_POST['id'];
    $id_cart = $_POST['id_cart'];

    $user_id = $_SESSION['id_user'];
    $query = "INSERT  INTO transaksi (`id_user`, `status`) VALUES ('$user_id', 'pending')";
    $order =  $koneksi->query($query);

    $order_id = $koneksi->insert_id;

    //multi-insert
    foreach ($id as $index => $product) {
        $kuantitas = $jumlah[$index];
        $query = "INSERT  INTO detail_transaksi_barang (`id_transaksi`, `id_barang`, `jumlah`) VALUES ('$order_id', '$product', '$kuantitas')";
        $order =  $koneksi->query($query);
    }

        $query = "DELETE FROM keranjang_barang where id_user = '$user_id'";
        $delete =  $koneksi->query($query);


    header("Location:keranjang_barang.php");
    
}

//multi-delete produk keranjang
if (isset($_POST["delete_keranjang_barang"])) {
    $ids = $_POST['id_delete'];
    // var_dump($ids);

    foreach ($ids as $index => $id) {
        $query = "DELETE FROM `keranjang_barang` WHERE id_keranjang_barang = '$id'";
        $delete = $koneksi->query($query);

    }
    header("Location:keranjang_barang.php");
}

