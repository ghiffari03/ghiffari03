<?php
session_start();
include "koneksi.php";
$user = $_POST['username'];
$psw = $_POST['password'];
$op = $_GET['op'];

if ($op == "in") {
    $sql = "SELECT * FROM user WHERE username='$user' AND password='$psw'";
    $query = $koneksi->query($sql);

    if (mysqli_num_rows($query) == 1) {
        $data = $query->fetch_array();
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role']; 
        $_SESSION['id_user'] = $data['id_user'];

        switch ($data['role']) {
            case "admin":
                header("location: user_admin/dashboard_admin.php");
                break;
            case "customer":
                header('location: user_customer/dashboard_customer.php');
                break;
            case "mitra":
                header('location: user_admin/dashboard_admin.php');
                break;
            case "mentor":
                header('location: user_mentor/dashboard_mentor.php');
                break;
            default:
                echo "Peran tidak dikenali. <a href=\"javascript:history.back()\">Kembali</a>";
        }
    } else {
        // Kasus ketika username atau password tidak cocok
        echo "Username atau password salah. Silakan coba lagi. <a href=\"javascript:history.back()\">Kembali</a>";
    }
} else if ($op == "out") {
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    unset($_SESSION['id_user']);
    header('location:login.php');
}
?>
