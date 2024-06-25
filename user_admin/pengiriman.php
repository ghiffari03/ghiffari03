<?php
include ("navbar_admin.php");

$query = "SELECT * FROM pembayaran";

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
                                                        <?php echo $row['status_pembayaran'] ?></span>
                                                </td>
                                                <td class="text-right">
                                                </td class="btn-group">
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button class="btn btn-info dim edit-button1" id="edit-button1"
                                                            type="button"
                                                            data-idpengiriman="<?php echo $row['shipment_id']; ?>"
                                                            data-status="dikirim">
                                                            <a style="color: inherit; text-decoration: none;">
                                                                <i class="fa fa-send"></i>
                                                            </a>
                                                        </button>
                                                        <button class="btn btn-primary dim edit-button" id="edit-button"
                                                            type="button"
                                                            data-idpengiriman="<?php echo $row['shipment_id']; ?>">
                                                            <a data-toggle="modal" href="#modal-pengiriman"
                                                                style="color: inherit; text-decoration: none;">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </button>
                                                    </div>
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

                <!--form update pengiriman-->
                <div id="modal-pengiriman" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-14">
                                        <h3 class="m-t-none m-b"> Edit Shipment</h3>
                                        <form role="form" action="aksi_edit_pengiriman.php" method="POST"
                                            enctype="multipart/form-data">
                                            <!-- Input tersembunyi untuk ID shipment -->
                                            <input type="hidden" id="edit_id_pengiriman" name="edit_id_pengiriman">
                                            <div class="form-group">
                                                <label>Pilih Tanggal Pengiriman</label><br>
                                                <input type="date" id="tanggal" name="edit_tanggal_pengiriman"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group"><label>Ekspedisi</label> <input type="text"
                                                    placeholder="Masukkan Ekspedisi" class="form-control"
                                                    name="edit_ekspedisi"></div>
                                            <div>
                                                <div class="form-group"><label>Nomor Resi</label> <input type="text"
                                                        placeholder="Masukkan Nomor Resi" class="form-control"
                                                        name="edit_nomor_resi">
                                                </div>
                                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"
                                                    name="submit"><strong>Perbarui</strong></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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

            $('.edit-button').click(function () {
                var idPengiriman = $(this).data('idpengiriman');
                $('#edit_id_pengiriman').val(idPengiriman);
            });

            $('.edit-button1').click(function () {
                    var idPengiriman = $(this).data('idpengiriman');
                    var statusPengiriman = $(this).data('status');
                    
                    //Kirim permintaan AJAX
                    $.ajax({
                        url: 'aksi_edit_pengiriman.php',
                        type: 'POST',
                        data: {
                            submit_status: true,
                            edit_id_pengiriman: idPengiriman,
                            edit_status_pengiriman: statusPengiriman
                        },
                        success: function (response) {
                            // Handle response dari server jika diperlukan
                            console.log(response);
                            // Redirect ke halaman pengiriman setelah berhasil
                            window.location.href = 'pengiriman.php?pesan=edit_berhasil';
                        },
                        error: function (xhr, status, error) {
                            // Handle kesalahan jika terjadi
                            console.error(xhr.responseText);
                            // Redirect ke halaman pengiriman dengan pesan kesalahan
                            window.location.href = 'pengiriman.php?pesan=edit_gagal';
                        }
                    });
                });


        });

    </script>

</body>

</html>