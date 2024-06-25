<?php
include ('navbar_customer.php');

// Ambil user_id dari data pengguna yang sedang login
$user_id = $_SESSION['id_user'];

// Ambil data keranjang yang hanya dimiliki oleh pengguna yang sedang login
$sql_cart = "SELECT * FROM keranjang_barang WHERE id_user='$user_id'";
$query_cart = $koneksi->query($sql_cart);

$cart_items = [];
$total = 0;

while ($cart_item = $query_cart->fetch_array()) {
    $product_id = $cart_item['id_barang'];
    $sql_product = "SELECT * FROM barang WHERE id_barang='$product_id'";
    $query_product = $koneksi->query($sql_product);
    $product = $query_product->fetch_array();

    $total = $total + ($product['harga'] * $cart_item['jumlah']);

    // Simpan data produk dalam array
    $cart_items[] = [
        'id_cart' => $cart_item['id_keranjang_barang'],
        'id' => $product['id_barang'],
        'nama_produk' => $product['nama_barang'],
        'harga' => $product['harga'],
        'deskripsi' => $product['deskripsi'],
        'gambar' => $product['gambar'], // Menyimpan path gambar produk
        'jumlah' => $cart_item['jumlah'], // Simpan jumlah produk dari tabel cart
    ];
}


?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gardenia | Cart</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
                    <h2>Cart</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>Cart</strong>
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
                                <span class="pull-right">(<?php echo count($cart_items); ?>) items</span>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <!-- asdsad -->
                                    <table class="table shopping-cart-table">
                                        <tbody>
                                            <?php foreach ($cart_items as $item): ?>
                                                <tr>
                                                    <td><input type="checkbox" name="id_delete[]" value="<?php echo $item['id_cart']  ?>"></td>
                                                    <td width="90">
                                                    <input name="id_cart[]" style="display: none;" value="<?php echo $item['id_cart'] ?>">
                                                    <input name="id[]" style="display: none;" value="<?php echo $item['id'] ?>">
                                                        <div class="cart-product-imitation">
                                                            <img src="<?php echo $item['gambar']; ?>" alt="Gambar Produk"
                                                                class="img-responsive" style="width: 100%; height: auto;">
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
                                                    </td>
                                                    <td>
                                                        $ <span class="item-price"
                                                            data-price="<?php echo $item['harga']; ?>"
                                                            data-index="<?php echo $index; ?>"><?php echo $item['harga']; ?></span>
                                                    </td>
                                                    <td width="65">
                                                        <input name="jumlah[]" type="number" class="form-control item-quantity"
                                                            data-index="<?php echo $index; ?>"
                                                            value="<?php echo $item['jumlah']; ?>" min="1">
                                                    </td>
                                                    <td>
                                                        <h4 class="item-total" id="item-total-<?php echo $index; ?>">
                                                            $ <?php echo $item['harga'] * $item['jumlah']; ?>
                                                        </h4>
                                                    </td>
                                                    <td>
                                                        
                                                    </td>
                                                </tr>
                                            <?php  endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <button name="update_keranjang_barang" type="submit" class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i>
                                    Update Cart</button>
                                    <button name="delete_keranjang_barang" type="submit" class="btn btn-danger pull-right" style="margin-right: 5px;">Delete Item</button>
                                <button class="btn btn-white"><a href="toko.php" style="color: inherit; text-decoration: none;"><i class="fa fa-arrow-left"> Continue shopping</i></a></button>
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
                                <span class="text-muted small">*For United States, France and Germany applicable sales
                                    tax will be applied</span>
                                <div class="btn-group">
                                    <button type="submit" name="checkout_barang" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i>
                                        Checkout</button>
                                    <a href="#" class="btn btn-white btn-sm"> Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>

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

    <script>
        // Fungsi untuk mencetak PDF
        function cetakPDF() {
            // Buat objek jsPDF
            var doc = new jsPDF();

            // Tambahkan konten halaman web ke PDF
            doc.html(document.body, {
                callback: function(pdf) {
                    // Simpan atau tampilkan PDF
                    pdf.save("halaman_web.pdf"); // Simpan PDF dengan nama "halaman_web.pdf"
                    // pdf.output('dataurlnewwindow'); // Tampilkan PDF di jendela baru
                }
            });
        }

        // Tambahkan event listener untuk tombol cetak PDF
        document.getElementById("btnPrintPDF").addEventListener("click", cetakPDF);
    </script>

    <!-- <script>
        $(document).ready(function () {
            $('.item-quantity').on('input', function () {
                let index = $(this).data('index');
                let quantity = $(this).val();
                let price = parseFloat($('span.item-price[data-index="' + index + '"]').data('price'));
                let total = price * quantity;

                $('#item-total-' + index).text('$ ' + total.toFixed(2));

                updateCartTotal();
            });

            function updateCartTotal() {
                let cartTotal = 0;

                $('.item-total').each(function () {
                    let total = parseFloat($(this).text().replace('$', '').trim());
                    cartTotal += total;
                });

                $('#cart-total').text('$ ' + cartTotal.toFixed(2));
            }
        });
    </script> -->
</body>

</html>