<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinta Lestari | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-bold">Welcome to Cinta Lestari</h2>
                <p>
                CINTA LESTARI (sebagai tempat informasi mengenai berkebun dan tanaman, jual beli tanaman dan alat berkebun, serta servis pelayanan pembuatan dan pemeliharaan kebun atau taman yang membantu berkebun menjadi mudah dan senang)

                </p>
            </div>

            <div class="col-md-6">
                <div class="ibox-content">
                    <h1 class="logo-name">IN+</h1>
                    <form class="m-t" role="form" action="aksi_login.php?op=in" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" required="" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" required="" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <a href="#">
                            <small>Forgot password?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="form_register.php">Create an account</a>
                    </form>
                    <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p>
                </div>
            </div>

        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
        </div>
    </div>
    <div class="col-md-6 text-right">
        <small>© 2014-2015</small>
    </div>
</body>

</html>