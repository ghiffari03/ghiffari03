<?php
include ('navbar_customer.php');

// Ambil user_id dari data pengguna yang sedang login
$user_id = $data['user_id'];
$order_id = $_GET['order_id'];

// Ambil data order detail yang hanya dimiliki oleh pengguna yang sedang login
$sql_orderdet = "SELECT * FROM orderdetails WHERE order_id='$order_id'";
$query_orderdet = $koneksi->query($sql_orderdet);

$order_items = [];
$total = 0;

while ($order_item = $query_orderdet->fetch_array()) {
    $product_id = $order_item['product_id'];
    $sql_product = "SELECT * FROM products WHERE product_id='$product_id'";
    $query_product = $koneksi->query($sql_product);
    $product = $query_product->fetch_array();

    $total += $product['harga'] * $order_item['kuantitas'];

    // Simpan data produk dalam array
    $order_items[] = [
        'id_cart' => $order_item['cart_id'],
        'id' => $product['product_id'],
        'nama_produk' => $product['nama_produk'],
        'harga' => $product['harga'],
        'deskripsi' => $product['deskripsi'],
        'gambar' => $product['gambar'], // Menyimpan path gambar produk
        'jumlah' => $order_item['kuantitas'], // Simpan jumlah produk dari tabel cart
    ];
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gardenia | Order Detail</title>
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
                    <h2>Order Detail</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>Order Detail</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
            </div>

            <!-- Item cart -->
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <form action="aksi_checkout.php" method="post">
                        <div class="col-md-9">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Product in your cart</h5>
                                    <span class="pull-right">(<?php echo count($order_items); ?>) items</span>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <!-- asdsad -->
                                        <table class="table shopping-cart-table">
                                            <tbody>
                                                <?php foreach ($order_items as $index => $item): ?>
                                                    <tr>
                                                        <td width="90">
                                                            <input name="id_cart[]" style="display: none;"
                                                                value="<?php echo $item['id_cart'] ?>">
                                                            <input name="id[]" style="display: none;"
                                                                value="<?php echo $item['id'] ?>">
                                                            <div class="cart-product-imitation">
                                                                <img src="<?php echo $item['gambar']; ?>"
                                                                    alt="Gambar Produk" class="img-responsive"
                                                                    style="width: 100%; height: auto;">
                                                            </div>
                                                        </td>
                                                        <td class="desc">
                                                            <h3>
                                                                <a href="#" class="text-navy">
                                                                    <?php echo $item['nama_produk']; ?>
                                                                </a>
                                                            </h3>
                                                            <p class="small">
                                                                <?php echo $item['deskripsi']; ?>
                                                            </p>
                                                            <div class="m-t-sm">
                                                                <a href="#" class="text-muted"><i class="fa fa-gift"></i>
                                                                    Add
                                                                    gift package</a>
                                                                |
                                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i>
                                                                    Remove item</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            $ <span class="item-price"
                                                                data-price="<?php echo $item['harga']; ?>"
                                                                data-index="<?php echo $index; ?>"><?php echo $item['harga']; ?></span>
                                                        </td>
                                                        <td width="65">
                                                            <input name="jumlah[]" type="number"
                                                                class="form-control item-quantity"
                                                                data-index="<?php echo $index; ?>"
                                                                value="<?php echo $item['jumlah']; ?>" min="1" readonly>
                                                        </td>
                                                        <td>
                                                            <h4 class="item-total" id="item-total-<?php echo $index; ?>">
                                                                $ <?php echo $item['harga'] * $item['jumlah']; ?>
                                                            </h4>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <button name="update_cart" type="submit" class="btn btn-primary pull-right"><i
                                            class="fa fa fa-shopping-cart"></i>
                                        Update Order</button>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Cart Summary</h5>
                                </div>
                                <div class="ibox-content">
                                    <span>Total</span>
                                    <h2 class="font-bold" id="cart-total">
                                        $ <?php
                                        echo $total;
                                        ?>
                                    </h2>
                                    <hr />
                                </div>
                            </div>
                        </div>
                </div>
                </form>
                <button class="btn btn-white"><a href="order.php"
                                            style="color: inherit; text-decoration: none;"><i class="fa fa-arrow-left">
                                            </i></a></button>

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

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>