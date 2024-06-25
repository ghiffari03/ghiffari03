<?php
session_start();

require_once("../koneksi.php");

$user = $_SESSION['username'];
$role = $_SESSION['role'];

$user_id = $_SESSION['id_user'];

$query= "SELECT transaksi.id_user,  pembayaran.* FROM pembayaran, transaksi where transaksi.id_transaksi=pembayaran.id_transaksi AND transaksi.id_user='$user_id'";
$dt_orders = $koneksi->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th data-hide="phone">Tanggal Pembayaran</th>
                                            <th data-hide="phone">Total Harga</th>
                                            <th data-hide="phone">Metode Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($row = $dt_orders->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['id_transaksi']?>
                                            </td>
                                            <td>
                                                <?php echo $row['tanggal_pembayaran'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['total_harga'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['metode_pembayaran'] ?>
                                            </td>
                                            <td>
                                                <span class="label label-primary"> <?php echo $row['status_pembayaran'] ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
</body>
</html>