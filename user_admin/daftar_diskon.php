<?php
include ("navbar_admin.php");
$query = "SELECT * FROM discounts";

// // Jika ada pencarian produk
// if (isset($_GET["cari"])) {
//     $nama_produk = $_GET["cari"];
//     $query = "SELECT p.product_id, p.nama_produk, d.discount_id, d.persentase_diskon, d.tanggal_mulai, d.tanggal_berakhir 
//               FROM discounts d 
//               INNER JOIN products p ON p.product_id = d.product_id 
//               WHERE p.nama_produk LIKE '%" . $nama_produk . "%'";
// }

$dt_query = $koneksi->query($query);

$query1 = "SELECT * FROM products";
$dt_query1 = $koneksi->query($query1);
$dt_query2 = $koneksi->query($query1);  

// Debug output untuk memeriksa hasil query produk
if ($dt_query1 === false) {
    die("Error: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gardenia | Daftar Diskon</title>

    <!-- FooTable -->
    <link href="../css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
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
                        <a href="../logout.html">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Data Diskon Gardenia</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>Toko</a>
                    </li>
                    <li class="active">
                        <strong>Diskon list</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>

        <!-- Pencarian -->
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <form method="GET">
                                <label class="control-label">Cari Diskon</label>
                                <input type="text" placeholder="Nama Diskon" class="form-control" name="cari">
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-30">
                        <form action="<?php $_PHP_SELF ?>" method="GET">
                            <button class="btn btn-primary dim" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>

                <!-- tambah diskon -->
                <div class="row">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="text-left">
                                <a data-toggle="modal" class="btn btn-primary" href="#modal-tambah_diskon">Tambah
                                    Diskon</a>
                            </div>
                            <div id="modal-tambah_diskon" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-14">
                                                    <h3 class="m-t-none m-b">Tambahkan Diskon</h3>
                                                    <form role="form" action="aksi_tambah_diskon.php" method="POST">
                                                        <div class="form-group"><label>Kode</label>
                                                           <input class="form-control" type="text" placeholder="Masukkan Kode" name="kode" id="">
                                                        </div>
                                                        <div class="form-group"><label>Persentase Diskon</label> <input
                                                                type="text" placeholder="Masukkan Diskon"
                                                                class="form-control" name="persentase_diskon">
                                                        </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                                type="submit"><strong>Tambahkan</strong></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--form update diskon-->
            <div id="modal-updateDiskon" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-14">
                                    <h3 class="m-t-none m-b"> Diskon</h3>
                                    <form role="form" action="aksi_edit_diskon.php" method="POST">
                                        <!-- Input tersembunyi untuk ID diskon -->
                                        <input type="hidden" id="edit_id_diskon" name="edit_id_diskon">
                                        <div class="form-group"></div>
                                        <div class="form-group"><label>Kode Diskon</label><input type="text"
                                                placeholder="Masukkan Kode" class="form-control"
                                                name="edit_kode">
                                        </div>
                                        <div class="form-group"><label>Persentase Diskon</label> <input type="text"
                                                placeholder="Masukkan Persentase" class="form-control"
                                                name="edit_persentase_diskon">
                                            </div>
                                        <div>
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

            <!-- Diskon List -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">ID Diskon</th>
                                        <th data-hide="none">Kode</th>
                                        <th data-toggle="true">persentase_diskon</th>
                                        <th class="text-right" data-sort-ignore="true"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    while ($dt_diskon = $dt_query->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $dt_diskon['discount_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $dt_diskon['kode']; ?>
                                            </td>
                                            <td>
                                                <?php echo $dt_diskon['persentase_diskon']; ?>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary dim edit-button" type="button"
                                                        data-iddiskon="<?php echo $dt_diskon['discount_id']; ?>">
                                                        <a data-toggle="modal" href="#modal-updateDiskon"
                                                            style="color: inherit; text-decoration: none;">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </button>
                                                    <button class="btn btn-danger dim" type="button">
                                                        <a href="aksi_delete_diskon.php?id=<?php echo $dt_diskon['discount_id']; ?>"
                                                            style="color: inherit; text-decoration: none;"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');"><i
                                                                class="fa fa-trash"></i></a>
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
                                        <td colspan="8">
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

    <!-- FooTable -->
    <script src="../js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function () {

            $('.footable').footable();

        });

    </script>

    <!-- SUMMERNOTE -->
    <script src="../js/plugins/summernote/summernote.min.js"></script>

    <!-- Data picker -->
    <script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <script>
        $(document).ready(function () {

            $('.summernote').summernote();

            $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

        });
    </script>

    <!-- ambil id diskon -->
    <script>
        $(document).ready(function () {
            $('.edit-button').click(function () {
                var idDiskon = $(this).data('iddiskon');
                $('#edit_id_diskon').val(idDiskon);
            });
        });
    </script>

</body>

</html>