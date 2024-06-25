<?php
include ("navbar_customer.php");

// Ambil user_id dari data pengguna yang sedang login
$user_id = $data['user_id'];

$query = "SELECT orders.user_id, shipments.*, payments.* FROM payments
         INNER JOIN orders ON orders.order_id = payments.order_id
         INNER JOIN shipments ON payments.payment_id = shipments.payment_id
         WHERE orders.user_id = '$user_id'";

$dt_shipment = $koneksi->query($query);


?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | Pengiriman</title>

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
                    <h2>E-commerce Shipment</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Order</a>
                        </li>
                        <li class="active">
                            <strong>Shipment</strong>
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
                                            <th>Payment ID</th>
                                            <th data-hide="phone">Tanggal Pengiriman</th>
                                            <th data-hide="phone">Alamat Pengiriman</th>
                                            <th data-hide="phone">Ekspedisi</th>
                                            <th data-hide="phone">Nomor Resi</th>
                                            <th data-hide="phone">Status Pengiriman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $dt_shipment->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['payment_id'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['tanggal_pengiriman'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['alamat_pengiriman'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['ekspedisi'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['nomor_resi'] ?>
                                                </td>
                                                <td>
                                                    <span class="label label-primary">
                                                        <?php echo $row['status_pengiriman'] ?></span>
                                                </td>
                                                <td>
                                                <td>
                                                    <button class="btn btn-primary dim edit-button" type="button"
                                                        data-toggle="modal" data-target="#reviewModal"
                                                        data-orderid="<?php echo $row['order_id']; ?>"
                                                        data-paymentid="<?php echo $row['payment_id'] ?>"
                                                        >
                                                        Diterima
                                                    </button>
                                                </td>

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

                <!-- modal  -->
                <div id="reviewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Ulasan Kepuasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="aksi_status_shipment.php" id="reviewForm" method="post">
                    <div class="form-group">
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">★</label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">★</label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">★</label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">★</label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">★</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review">Ulasan</label>
                        <textarea class="form-control" id="review" name="review" rows="3"></textarea>
                    </div>
                    <input type="text" id="order_id" name="order_id" value="">
                    <input type="text" id="payment_id" name="payment_id" value="">
                    <input type="text" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <button type="submit" class="btn btn-warning" name="submit_rating">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

                <style>
                    .rating {
                        display: inline-block;
                        font-size: 0;
                        direction: rtl;
                    }

                    .rating>input {
                        display: none;
                    }

                    .rating>label {
                        font-size: 2rem;
                        cursor: pointer;
                        color: #ddd;
                        padding: 0 0.1em;
                    }

                    .rating>input:checked~label,
                    .rating:not(:checked)>label:hover,
                    .rating:not(:checked)>label:hover~label {
                        color: gold;
                    }

                    .rating>input:checked+label:hover,
                    .rating>input:checked~label:hover,
                    .rating>label:hover~input:checked~label,
                    .rating>input:checked~label:hover~label {
                        color: gold;
                    }
                </style>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Tangkap data order_id saat tombol diklik
            $('.edit-button').on('click', function () {
                var orderId = $(this).data('orderid');
                var paymentId = $(this).data('paymentid');
                $('#order_id').val(orderId);
                $('#payment_id').val(paymentId);
                $('#reviewModal').modal('show');
            });

            function reviewForm(el) {
                
            }

            // Tangani submit form ulasan
            // $('#reviewForm').on('submit', function (event) {
            //     event.preventDefault();
            //     var orderId = $('#order_id').val();
            //     var userId = $('#user_id').val();
            //     var review = $('#review').val();
            //     var rating = $('input[name="rating"]:checked').val();

            //     $.ajax({
            //         url: 'aksi_status_shipment.php',
            //         type: 'POST',
            //         data: {
            //             order_id: orderId,
            //             user_id: userId,
            //             review: review,
            //             rating: rating
            //         },
            //         success: function (response) {
            //             if (response == 'success') {
            //                 alert('Ulasan berhasil disimpan.');
            //                 $('#reviewModal').modal('hide');
            //                 location.reload();
            //             } else {
            //                 alert('Gagal menyimpan ulasan.');
            //             }
            //         }
            //     });
            // });
        });
    </script>
</body>

</html>