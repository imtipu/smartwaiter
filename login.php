<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "login";
if (isset($_SESSION['login_id'])){
    header("Localhost:".$root);
}else {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login</title>

        <!-- Bootstrap core CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="https://getbootstrap.com/docs/4.0/examples/starter-template/starter-template.css" rel="stylesheet">
    </head>

    <body>
    <main role="main" class="container">

        <div class="starter-template">
            <div class="login m-auto" style="max-width: 400px;">
                <h3>Admin Login</h3>
                <hr>
                <?php
                if (isset($_SESSION['loginMsg'])){
                    echo $_SESSION['loginMsg'];
                    unset($_SESSION['loginMsg']);
                }
                ?>
                <form action="action/login.php" method="post" role="form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-block btn-primary">
                    </div>
                </form>
            </div>

        </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    </body>
    </html>

    <?php
}
