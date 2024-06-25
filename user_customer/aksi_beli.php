<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['username'])) {
    die("Anda belum login. <a href='../login.php'>Login di sini</a>");
}


if(isset($_POST['add_barang'])){
        // Ambil user_id dari data pengguna yang sedang login
    $user_id = $_SESSION['id_user'];

    // Ambil product_id dari formulir
    $product_id = $_POST['product_id'];


    // Default jumlah untuk ditambahkan ke keranjang
    $default_quantity = 1;

    // Cek apakah produk sudah ada di keranjang
    $sql_check = "SELECT * FROM keranjang_barang WHERE id_user='$user_id' AND id_barang='$product_id'";
    $query_check = $koneksi->query($sql_check);

    if ($query_check->num_rows > 0) {
        // Jika produk sudah ada di keranjang, tambahkan ke jumlah yang ada
        $sql_update = "UPDATE keranjang_barang SET jumlah = jumlah + $default_quantity WHERE id_user='$user_id' AND id_barang='$product_id'";
        $koneksi->query($sql_update);
    } else {
        // Jika produk belum ada di keranjang, tambahkan produk baru dengan jumlah default
        $sql_insert = "INSERT INTO keranjang_barang (id_user, id_barang, jumlah) VALUES ('$user_id', '$product_id', '$default_quantity')";
        $koneksi->query($sql_insert);
    }

    header("Location: toko.php");
}

if(isset($_POST['add_jasa'])){
    // Ambil user_id dari data pengguna yang sedang login
$user_id = $_SESSION['id_user'];

// Ambil product_id dari formulir
$product_id = $_POST['product_id'];


// Default jumlah untuk ditambahkan ke keranjang
$default_quantity = 1;

// Cek apakah produk sudah ada di keranjang
$sql_check = "SELECT * FROM keranjang_jasa WHERE id_user='$user_id' AND id_jasa='$product_id'";
$query_check = $koneksi->query($sql_check);

if ($query_check->num_rows > 0) {
    // Jika produk sudah ada di keranjang, tambahkan ke jumlah yang ada
    $sql_update = "UPDATE keranjang_jasa SET luas_taman = luas_taman + $default_quantity WHERE id_user='$user_id' AND id_jasa='$product_id'";
    $koneksi->query($sql_update);
} else {
    // Jika produk belum ada di keranjang, tambahkan produk baru dengan jumlah default
    $sql_insert = "INSERT INTO keranjang_jasa (id_user, id_jasa, luas_taman) VALUES ('$user_id', '$product_id', '$default_quantity')";
    $koneksi->query($sql_insert);
}

header("Location: toko_jasa.php");
}


?>
