<?php
include ("navbar_admin.php");
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gardenia | Toko</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/../css/font-awesome.css" rel="stylesheet">

    <link href="../css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="../css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <!--Dropzone-->
    <link href="../css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="../css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="../css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/codemirror/codemirror.css" rel="stylesheet">
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
                    <h2>Tambah barang</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Toko</a>
                        </li>
                        <li>
                            <a href="daftar_barang.php">Daftar barang</a>
                        </li>
                        <li class="active">
                            <strong>Tambah barang</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- Tambah barang -->
            <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Info barang</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <form action="aksi_tambah_barang.php" enctype="multipart/form-data"
                                            method="POST">
                                            <fieldset class="form-horizontal">
                                                <div class="form-group"><label
                                                        class="col-sm-2 control-label">Nama:</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"
                                                            placeholder="Nama barang" name="nama_barang"></div>
                                                </div>
                                                <div class="form-group"><label
                                                        class="col-sm-2 control-label">Deskripsi:</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"
                                                            placeholder="deskripsi" name="deskripsi_barang"></div>
                                                </div>
                                                <div class="form-group"><label
                                                        class="col-sm-2 control-label">Harga:</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"
                                                            placeholder="$160.00" name="harga"></div>
                                                </div>
                                                <div class="form-group"><label
                                                        class="col-sm-2 control-label">Jumlah:</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"
                                                            placeholder="Jumlah" name="jumlah"></div>
                                                </div>
                                                <div class="form-group"><label
                                                        class="col-sm-2 control-label">Jenis:</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"
                                                            placeholder="jenis" name="jenis"></div>
                                                </div>
                                                <div class="form-group"><label
                                                        class="col-sm-2 control-label">Gambar:</label>
                                                    <div class="col-sm-10">
                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple />
                                                        </div>
                                                    <div>
                                                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                                                type="submit"><strong>Tambahkan</strong></button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
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



    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>



    <!-- SUMMERNOTE -->
    <script src="../js/plugins/summernote/summernote.min.js"></script>

    <!-- Data picker -->
    <script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Jasny -->
    <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- DROPZONE -->
    <script src="../js/plugins/dropzone/dropzone.js"></script>

    <!-- CodeMirror -->
    <script src="../js/plugins/codemirror/codemirror.js"></script>
    <script src="../js/plugins/codemirror/mode/xml/xml.js"></script>

    <script>
        Dropzone.options.dropzoneForm = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
        };

        $(document).ready(function () {

            var editor_one = CodeMirror.fromTextArea(document.getElementById("code1"), {
                lineNumbers: true,
                matchBrackets: true
            });

            var editor_two = CodeMirror.fromTextArea(document.getElementById("code2"), {
                lineNumbers: true,
                matchBrackets: true
            });

            var editor_two = CodeMirror.fromTextArea(document.getElementById("code3"), {
                lineNumbers: true,
                matchBrackets: true
            });
        });
    </script>

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

</body>

</html>