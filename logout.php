<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
</head>
<body>

<script language="javascript">
    var confirmLogout = confirm("Anda Yakin Akan Logout??");
    if (confirmLogout) {
        <?php
        session_destroy();
        ?>
        document.location="login.php";
    } else {
        <?php
        // Periksa apakah sesi masih aktif
        if (isset($_SESSION['user_id'])) {
            echo "window.history.back();";
        } else {
            echo "document.location='login.php';";
        }
        ?>
    }
</script>

</body>
</html>