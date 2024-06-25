<?php
session_start();

if ($_SESSION['role'] == 'customer') {
    include ("../user_customer/navbar_customer.php");
}

if ($_SESSION['role'] == 'mentor') {
    include ("../user_mentor/navbar_mentor.php");
}

$id_forum = $_GET['id'];


if (isset($_POST['add'])) {
    $text = $_POST['text'];
    $id_user = $_SESSION['id_user'];

    $sql = "INSERT INTO komen (id_user, id_forum, text) VALUES ('$id_user', '$id_forum', '$text')";
    $stmt = $koneksi->query($sql);
}

$sql = "SELECT forum.*, user.username FROM forum, user WHERE forum.id_user = user.id_user AND forum.id_forum = $id_forum ";
$forum = $koneksi->query($sql)->fetch_assoc();

$sql = "SELECT komen.*, user.username, user.role FROM komen, user WHERE komen.id_user = user.id_user AND komen.id_forum = $id_forum ";
$comments = $koneksi->query($sql)->fetch_all(MYSQLI_ASSOC);

?>
<div id="wrapper">
    <!-- Sidebar and other layout elements here -->

    <div id="page-wrapper" class="gray-bg">
        <!-- Navbar and other page elements here -->

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="container">
                <h2>Detail Post</h2>

                <form method="post">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0"><?php echo $forum['pertanyaan'] ?></h5>
                                    <p class="card-text"><small class="text-muted">Posted by
                                            <?php echo $forum['username'] ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="mt-4">
                    <h5>Komentar</h5>
                    <!-- comment  -->
                    <?php foreach ($comments as $key => $comment) { ?>
                        <form>
                            <div class="ibox media mb-3">
                                <div class="ibox-content media-body">
                                    <div class="mt-0">
                                        <?php
                                        if($comment['role'] == "mentor" ){
                                        ?>
                                        <h5 class="text-right">Mentor</h5>
                                        <?php } ?>
                                        
                                        <h6><?php echo $comment['username'] ?></h6>
                                    </div>
                                    <div class="form-control"><?php echo $comment['text'] ?></div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                    <!-- end comment  -->
                </div>

                <div class="mt-4">
                    <h5>Tambah Komentar</h5>
                    <form method="post">
                        <div class="form-group">
                            <label for="comment">Komentar:</label>
                            <textarea class="form-control" name="text" id="comment" rows="3"></textarea>
                        </div>
                        <input style="display: none;" name='id_course' value="<?php echo $_GET['id'] ?>">
                        <button type="submit" name="add" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer and other layout elements here -->

    </div>
</div>

<script>
    function handleEditBtn(el) {
        var formField = document.getElementById('edit-post');
        var idField = document.getElementById('edit-id');
        formField.removeAttribute('disabled');
        idField.removeAttribute('disabled');
    }
</script>

<?php require_once 'footer.php' ?>