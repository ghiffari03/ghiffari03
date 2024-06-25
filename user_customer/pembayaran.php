<?php
include ("navbar_customer.php");

// Ambil user_id dari data pengguna yang sedang login
$user_id = $_SESSION['id_user'];

$query= "SELECT transaksi.id_user, pembayaran.* FROM pembayaran, transaksi where transaksi.id_transaksi = pembayaran.id_transaksi AND transaksi.id_user='$user_id'";
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
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control"
                                    name="top-search" id="top-search">
                            </div>
                        </form>
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
                    <h2>E-commerce Payment</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Order</a>
                        </li>
                        <li class="active">
                            <strong>Payment</strong>
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
                                            <th data-hide="phone">Tanggal Pembayaran</th>
                                            <th data-hide="phone">Total Harga</th>
                                            <th data-hide="phone">Metode Pembayaran</th>
                                            <th data-hide="phone">Status Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($row = $dt_orders->fetch_assoc()) {
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
                                <a href="pdf.php" class="btn btn-warning">Cetak</a >
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