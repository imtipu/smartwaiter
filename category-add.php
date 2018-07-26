<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "cat-add";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $foods = $getStore->foodList();
    $cats = $getStore->catList();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>Admin</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <h3 class="text-center">Add New Food</h3>
        <hr>
        <div class="msg">
            <?php
            if (isset($_SESSION['errorFormat'])){
                echo $_SESSION['errorFormat'];
                unset($_SESSION['errorFormat']);
            }
            if (isset($_SESSION['errorSize'])){
                echo $_SESSION['errorSize'];
                unset($_SESSION['errorSize']);
            }
            if (isset($_SESSION['catMsg'])){
                echo $_SESSION['catMsg'];
                unset($_SESSION['catMsg']);
            }
            ?>
        </div>
        <div class="col-md-6 col-sm-8 col-12">
            <form action="action/cat-add.php" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <label for="cat_name">Category Name</label>
                    <input type="text" name="cat_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cat_img">Image</label>
                    <input type="file" name="cat_img" class="form-control" required>
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

