<?php
session_start();

if($_SESSION['role'] == 'customer'){
    include ("../user_customer/navbar_customer.php");
}

if($_SESSION['role'] == 'mentor'){
    include ("../user_mentor/navbar_mentor.php");
}


if (isset($_POST['add'])) {
    $pertanyaan = $_POST['pertanyaan'];
    $id_user = $_SESSION['id_user'];

    $sql = "INSERT INTO forum (id_user, pertanyaan) VALUES ('$id_user', '$pertanyaan')";
    $stmt = $koneksi->query($sql);
}

$sql = "SELECT forum.*, user.username FROM forum, user WHERE forum.id_user = user.id_user";
$forum = $koneksi->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forum</title>
    </head>
    <body>
    <div id="wrapper">
        <!-- Sidebar and other layout elements here -->

        <div id="page-wrapper" class="gray-bg">
            <!-- Navbar and other page elements here -->

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="container">
                    <table style="width: 100%;">
                        <th></th>
                        <th class="text-right"></th>
                        <tr>
                            <td><h2>Daftar Post dalam Forum</h2></td>
                            <td class="text-right"><button class="btn btn-primary" data-toggle="modal" data-target="#postModal">+</button></td>
                        </tr>
                    </table>
                    <div class="row">
                        <!-- Post -->
                        <?php foreach ($forum as $key => $post) {
                        ?>
                        <a href="detail_forum.php?id=<?php echo $post['id_forum'] ?>">
                        <div class="col-md-4">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="mt-0"><?php echo $post['username'] ?></h5>
                                            <p><?php echo $post['pertanyaan'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <?php }  ?>
                        <!-- end post  -->
                    </div>
                </div>
            </div>

            <!-- add modal -->
            <div class="modal inmodal" id="postModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <form  method="post">
                                        <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Tambahkan Post</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label for="pertanyaan">Post</label><textarea name="pertanyaan" class="form-control"></textarea></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                            <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
    </body>
    </html>



