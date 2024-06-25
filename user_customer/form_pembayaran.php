<?php
include ('navbar_customer.php');

// Ambil user_id dari data pengguna yang sedang login
$user_id = $_SESSION['id_user'];
$order_id = $_GET['order_id'];


// Ambil data order detail yang hanya dimiliki oleh pengguna yang sedang login
$sql_orderdet = "SELECT * FROM detail_transaksi_barang WHERE id_transaksi='$order_id'";
$query_orderdet = $koneksi->query($sql_orderdet);

$order_items = [];
$subTotal = 0;

while ($order_item = $query_orderdet->fetch_array()) {
    $product_id = $order_item['id_barang'];
    $sql_product = "SELECT * FROM barang WHERE id_barang='$product_id'";
    $query_product = $koneksi->query($sql_product);
    $product = $query_product->fetch_array();

    $subTotal += $product['harga'] * $order_item['jumlah'];

    // Simpan data produk dalam array
    $order_items[] = [
        'id_cart' => $order_item['id_detail_transaksi_barang'],
        'id' => $product['id_barang'],
        'nama_produk' => $product['nama_barang'],
        'harga' => $product['harga'],
        'deskripsi' => $product['deskripsi'],
        'gambar' => $product['gambar'], // Menyimpan path gambar produk
        'jumlah' => $order_item['jumlah'], // Simpan jumlah produk dari tabel cart
    ];
}


$tot_harga = $subTotal;

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gaardenia | Pembayaran</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
            </div>
        </nav>

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
                    <h2>Pembayaran</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Forms</a>
                        </li>
                        <li class="active">
                            <strong>Pembayaran</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <!-- form pembayaran -->
                            <div class="ibox-title">
                                <h5>Lengkapi Pembayaran</h5>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="aksi_bayar.php?order_id=<?php echo $order_id ?>"
                                    class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Order ID</label>
                                        <div class="col-sm-10">
                                            <input name="order_id" type="text" class="form-control" readonly
                                                style="background-color: white;" value="<?php echo $order_id; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Sub Harga</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" readonly
                                                style="background-color: white;" value=" $ <?php echo $subTotal; ?>">
                                            <input id="subtotal_field" type="text" class="form-control" readonly
                                                style="background-color: white; display: none;" value="<?php echo $subTotal; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Metode Pembayaran</label>
                                        <div class="col-sm-10">
                                            <select class="form-control m-b" name="metode_pembayaran">
                                                <option>Transfer Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Total Harga</label>
                                        <div class="col-sm-10">
                                            <input id="total_harga" type="text" class="form-control" readonly
                                                style="background-color: white; display: none;" value=" $ <?php echo $tot_harga; ?>">
                                                <input name="total_harga" id="total_harga1" type="text" class="form-control" readonly
                                                style="background-color: white;" value=" <?php echo $tot_harga; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-white" type="submit">Cancel</button>
                                            <button class="btn btn-primary" type="submit" name="submit">Bayar</button>
                                        </div>
                                    </div>
                                </form>

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


    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $("#diskon_field").change(function () {
                var diskon_persen = $('option:selected', this).attr('diskon') / 100;
                var sub_total = document.getElementById('subtotal_field').value;
                var diskon =sub_total * diskon_persen;
                console.log("diskon :"+sub_total);
                var total_harga = sub_total - diskon;

                var total_field = document.getElementById('total_harga');
                var total_field = document.getElementById('total_harga1');
                total_field.value = "$".concat(" ", total_harga) ;
                total_field.value = total_harga ;
            });
        });


        // function handleDiskon() {
        //     var hargaField = document.getElementById('total_harga');
        //     var diskon_field = document.getElementById('diskon_field');
        //     var option = diskon_field.diskon;
        //     console.log(option);
        // }
    </script>
</body>

</html>