<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "device-add";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>Device Add</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <h3 class="text-center">Add New Device</h3>
        <hr>
        <div class="msg">
            <?php
            if (isset($_SESSION['statusMsg'])){
                echo $_SESSION['statusMsg'];
                unset($_SESSION['statusMsg']);
            }
            ?>
        </div>
        <div class="col-md-6 col-sm-8 col-12">
            <form action="action/device-add.php" class="m-auto" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <label for="cat_name">MAC Address</label>
                    <input type="text" name="mac_address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cat_img">Table Name/No</label>
                    <input type="text" name="table_name" class="form-control" required>
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Add" class="btn btn-primary">
                </div>
            </form>
        </div>
    </main>

    <?php include 'js.php';?>
    </body>
    </html>
    <?php
}
?>

