<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
    die("Anda belum login. <a href='../login.php'>Login di sini</a>");
}

$user = $_SESSION['username'];
$role = $_SESSION['role'];

$sql = "SELECT * FROM users WHERE username='$user'";
$query = $koneksi->query($sql);
$data = $query->fetch_array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $payment_id = $_POST['payment_id'];
    $user_id = $_POST['user_id'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    
    // Update status pengiriman menjadi 'Diterima'
    $sql = "UPDATE shipments SET status_pengiriman='Diterima' WHERE payment_id='$payment_id'";
    if ($koneksi->query($sql) === TRUE) {
        // Simpan ulasan dan rating ke dalam tabel ulasan
        $sql_review = "INSERT INTO ulasan_toko (`order_id`, `user_id`, `review`, `rating`) VALUES ('$order_id', '$user_id', '$review', '$rating')";
        if ($koneksi->query($sql_review) === TRUE) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'invalid_request';
}
?>
