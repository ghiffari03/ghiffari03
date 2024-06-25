<?php
include ('navbar_customer.php');

// Ambil user_id dari data pengguna yang sedang login
$user_id = $_SESSION['id_user'];

// Ambil order_id dari parameter URL
$order_id = $_GET['order_id'];

// Ambil data produk dalam order
$sql = "SELECT detail_transaksi_barang.*, barang.* FROM detail_transaksi_barang
        JOIN barang ON detail_transaksi_barang.id_barang = barang.id_barang
        WHERE id_transaksi = '$order_id'";
$query_cart = $koneksi->query($sql);

// Simpan data produk dalam array
$cart_items = [];
while ($row = $query_cart->fetch_assoc()) {
    $cart_items[] = $row;
}

// Hitung total harga keranjang
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['harga'] * $item['jumlah'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinta Lestari | Cart</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
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
                    <h2>Detail Order</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>Detail Order</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2"></div>
            </div>

            <!-- Item cart -->
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-md-9">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Detail Order</h5>
                                <span class="pull-right">(<?php echo count($cart_items); ?>) items</span>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table shopping-cart-table">
                                        <tbody>
                                            <?php foreach ($cart_items as $index => $item): ?>
                                                <tr>
                                                    <td width="90">
                                                        <div class="cart-product-imitation">
                                                            <img src="<?php echo $item['gambar']; ?>" alt="Gambar Produk"
                                                                class="img-responsive" style="width: 100%; height: auto;">
                                                        </div>
                                                    </td>
                                                    <td class="desc">
                                                        <h3>
                                                            <a href="#" class="text-navy">
                                                                <?php echo $item['nama_barang']; ?>
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
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Fungsi untuk mencetak PDF
        function cetakPDF() {
            var doc = new jsPDF();
            doc.html(document.body, {
                callback: function(pdf) {
                    pdf.save("halaman_web.pdf");
                }
            });
        }

        // Tambahkan event listener untuk tombol cetak PDF
        document.getElementById("btnPrintPDF").addEventListener("click", cetakPDF);
    </script>

</body>

</html>
