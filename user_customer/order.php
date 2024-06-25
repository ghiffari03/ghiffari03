<?php
include ("navbar_customer.php");

// Ambil user_id dari data pengguna yang sedang login
$user_id = $_SESSION['id_user'];

$query = "SELECT * FROM transaksi where id_user='$user_id'";
$dt_orders = $koneksi->query($query);

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | E-commerce</title>

    <!-- FooTable -->
    <link href="../css/plugins/footable/footable.core.css" rel="stylesheet">
    <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="../logout.php">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>E-commerce orders</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>E-commerce</a>
                        </li>
                        <li class="active">
                            <strong>Orders</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th data-hide="phone">Date added</th>
                                            <th data-hide="phone">Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        while ($row = $dt_orders->fetch_assoc()) {
                                            
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['id_transaksi'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['tanggal_transaksi'] ?>
                                                </td>
                                                <td>
                                                    <span class="label label-primary">
                                                        <?php echo $row['status'] ?></span>
                                                </td>

                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <?php if ($row['status'] == 'pending') { ?>
                                                            <button class="btn btn-primary dim image-button" type="button">
                                                                <a href="form_pembayaran.php?order_id=<?php echo $row['id_transaksi']; ?>"
                                                                    style="color: inherit; text-decoration: none;">
                                                                    <i class="fa fa-money"></i>
                                                                </a>
                                                            </button>
                                                        <?php } else if ($row['status_pesanan'] == 'selesai') { ?>
                                                                <button class="btn btn-primary dim image-button" type="button"
                                                                    style="display: none;">
                                                                    <a href="form_pembayaran.php?order_id=<?php echo $row['id_transaksi']; ?>"
                                                                        style="color: inherit; text-decoration: none;">
                                                                        <i class="fa fa-money"></i>
                                                                    </a>
                                                                </button>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary dim image-button" type="button">
                                                                <a href="form_detail_order_barang.php?order_id=<?php echo $row['id_transaksi']; ?>"
                                                                    style="color: inherit; text-decoration: none;">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </button>
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
                </div>

            </div>
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
                </div>
            </div>
        </div>
    </div>

    <!-- Data picker -->
    <script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- FooTable -->
    <script src="../js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function () {

            $('.footable').footable();

            $('#date_added').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#date_modified').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

        });

    </script>

</body>

</html>