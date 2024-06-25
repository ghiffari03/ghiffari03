<?php
include ("navbar_admin.php");
$query = "SELECT * FROM jasa";

//cari
if (isset($_GET["cari_jasa"])) {
    $nama_jasa = $_GET["cari_jasa"];
    $query = "SELECT * FROM jasa where nama_jasa LIKE  '%" . $nama_jasa . "%'";
}
$dt_query = $koneksi->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gardenia | Daftar Tanaman</title>

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
                <h2>Data jasa Cinta Lestari</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>Toko</a>
                    </li>
                    <li class="active">
                        <strong>Daftar jasa</strong>
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
                            <form method="GET" <?php $_PHP_SELF ?>>
                                <label class="control-label">Cari jasa</label>
                                <input type="text" name="cari_jasa" placeholder="Nama jasa" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-30">
                        <button class="btn btn-primary dim" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <button class="btn btn-primary dim" type="button"><a href="tambah_jasa.php"
                                style="color: inherit; text-decoration: none;"><i class="fa fa-plus"></a></i></button>
                    </div>
                </div>
            </div>

            <!-- jasa List -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                    <tr>
                                        <th data-hide="">jasa id</th>
                                        <th data-toggle="true">Nama jasa</th>
                                        <th data-hide="phone">Jenis</th>
                                        <th data-hide="all">Deskripsi</th>
                                        <th data-hide="all">Tanggal Ditambahkan</th>
                                        <th class="text-right" data-sort-ignore="true"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    while ($dt_jasa = $dt_query->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $dt_jasa['id_jasa']; ?>
                                            </td>
                                            <td>
                                                <?php echo $dt_jasa['nama_jasa']; ?>
                                            </td>
                                            <td>
                                                <?php echo $dt_jasa['jenis_jasa']; ?>
                                            </td>
                                            <td>
                                                <?php echo $dt_jasa['deskripsi']; ?>
                                            </td>
                                            <td>
                                                <?php echo $dt_jasa['tanggal_ditambahkan']; ?>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn btn-info dim image-button" type="button"
                                                        data-idjasa="<?php echo $dt_jasa['id_jasa']; ?>"
                                                        data-image="<?php echo $dt_jasa['gambar']; ?>">
                                                        <a href="#modal-gambar" data-toggle="modal"
                                                            style="color: inherit; text-decoration: none;"><i
                                                                class="fa fa-image"></i></a>
                                                    </button>
                                                    <button class="btn btn-primary dim edit-button" type="button"
                                                        data-idjasa="<?php echo $dt_jasa['id_jasa']; ?>">
                                                        <a data-toggle="modal" href="#modal-jasa"
                                                            style="color: inherit; text-decoration: none;">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </button>
                                                    <button class="btn btn-danger dim" type="button">
                                                        <a href="aksi_delete_jasa.php?id=<?php echo $dt_jasa['id_jasa']; ?>"
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
                                        <td colspan="9">
                                            <ul class="pagination pull-right"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!--form gambar-->
                    <div id="modal-gambar" class="modal fade" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="m-t-none m-b">Gambar jasa</h3>
                                            <div class="form-group">
                                                <img id="current-image" src="#" alt="Gambar jasa"
                                                    style="width: 100%; height: auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--form update jasa-->
                    <div class="ibox float-e-margins">
                        <div id="modal-jasa" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-14">
                                                <h3 class="m-t-none m-b"> Edit jasa</h3>
                                                <form role="form" action="aksi_edit_jasa.php" method="POST" enctype="multipart/form-data">
                                                    <!-- Input tersembunyi untuk ID kategori -->
                                                    <input type="hidden" id="edit_id_jasa" name="edit_id_jasa">
                                                    <div class="form-group"><label>Nama jasa</label> <input
                                                            type="text" placeholder="Masukkan Nama" class="form-control"
                                                            name="edit_nama_jasa">
                                                    </div>
                                                    <div class="form-group"><label>Deskripsi jasa</label> <input
                                                            type="text" placeholder="Tulis Deskripsi"
                                                            class="form-control" name="edit_deskripsi_jasa"></div>
                                                    <div>
                                                        <div class="form-group"><label>Harga</label> <input type="text"
                                                                placeholder="Masukkan Harga" class="form-control"
                                                                name="harga"></div>
                                                        <div>
                                                            <div class="form-group"><label>Stok</label> <input
                                                                    type="text" placeholder="Masukkan Stok"
                                                                    class="form-control" name="stok">
                                                            </div>
                                                            <div class="form-group"><label>jenis</label> <input
                                                                    type="text" placeholder="Masukkan jenis"
                                                                    class="form-control" name="jenis">
                                                            </div>
                                                            <div class="form-group"><label>Gambar:</label>
                                                                <div>
                                                                    <div class="fallback">
                                                                        <input name="file" type="file" multiple />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                                                type="submit"
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

    $(document).ready(function () {
        $('.edit-button').click(function () {
            var idjasa = $(this).data('idjasa');
            $('#edit_id_jasa').val(idjasa);
        });

        $('.image-button').click(function () {
            var imageUrl = $(this).data('image');
            var fullImageUrl = '../img/' + imageUrl;
            console.log('Image URL:', fullImageUrl);  // Tambahkan ini untuk debugging
            $('#current-image').attr('src', fullImageUrl).show();
        });
    });
</script>

</body>

</html>