<?php
include "koneksi.php";
    $user = $_POST['username'];
    $psw = $_POST['password'];
    $email = $_POST['email'];
    $nmlngkp = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['no_hp'];
    $role = $_POST['role'];
    $sql="INSERT INTO  user (username, password, email, nama_lengkap, alamat, no_hp, role) VALUES ('".$user."',
    '".$psw."','".$email."','".$nmlngkp."', '".$alamat."', '".$nohp."','".$role."')";
    $query=$koneksi->query($sql);
    if($query === true){
        header('location: login.php');
    }else{
        echo "error";
    }
?>