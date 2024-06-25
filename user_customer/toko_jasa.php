<?php
include ("navbar_customer.php");
$query = "SELECT * FROM jasa";
$dt_query = $koneksi->query($query);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinta Lestari | Tanaman Hias</title>
    <link href="../css/plugins/slick/slick.css" rel="stylesheet">
    <link href="../css/plugins/slick/slick-theme.css" rel="stylesheet">
</head>

<body>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
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
                <h2>Toko</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard_customer.php">Home</a>
                    </li>
                    <li class="active">
                        <strong>Toko Jasa</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>

        <!-- produk list -->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?php while ($dt_barang = $dt_query->fetch_array()) {
                    // Path ke folder gambar
                    $gambar_path = $dt_barang['gambar_jasa'];
                    ?>
                    <div class="col-md-3">
                        <div class="ibox">
                            <div class="ibox-content product-box">
                                <div class="item active">
                                    <img src="<?php echo $gambar_path; ?>" alt="" class="img-responsive">
                                </div>
                                <div class="product-desc">
                                    <span class="product-price">
                                        $ <?php echo $dt_barang['harga_jasa']; ?>
                                    </span>
                                    <small class="text-muted"><?php echo $dt_barang['jenis_jasa']; ?></small>
                                    <a href="#modal-info-<?php echo $dt_barang['id_jasa']; ?>" data-toggle="modal"
                                        class="product-name">
                                        <?php echo $dt_barang['nama_jasa']; ?>
                                    </a>
                                    <div class="small m-t-xs">
                                        <?php echo $dt_barang['deskripsi']; ?>
                                    </div>
                                    <form method="post" action="aksi_beli.php">
                                        <input type="hidden" name="product_id"
                                            value="<?php echo $dt_barang['id_jasa']; ?>">
                                        <button type="submit" name="add_jasa" class="btn btn-primary btn-sm m-t-xs"><i
                                                class="fa fa-cart-plus"></i> Add to cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>
    <script src="../js/plugins/slick/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.product-images').slick({
                dots: true
            });
        });
    </script>

    <style>
        .img-responsive {
            width: 100%;
            height: 200px;
            /* Atur tinggi gambar sesuai kebutuhan Anda */
            object-fit: cover;
            /* Menjaga proporsi gambar */
        }
    </style>
</body>

</html>