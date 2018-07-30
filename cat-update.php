<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "cat-update";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else {
    if (isset($_GET['id'])) {
        $cat_id = $_GET['id'];
        $getStore = new store\Store();
        $cat= $getStore->catById($cat_id);
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <?php include 'header.php'; ?>
            <title>Update Category</title>
        </head>
        <body>
        <?php include 'nav.php'; ?>
        <main class="container">
            <h3 class="text-center">Update Category</h3>
            <hr>
            <div class="msg">
                <?php
                if (isset($_SESSION['errorFormat'])) {
                    echo $_SESSION['errorFormat'];
                    unset($_SESSION['errorFormat']);
                }
                if (isset($_SESSION['errorSize'])) {
                    echo $_SESSION['errorSize'];
                    unset($_SESSION['errorSize']);
                }
                if (isset($_SESSION['catMsg'])) {
                    echo $_SESSION['catMsg'];
                    unset($_SESSION['catMsg']);
                }
                ?>
            </div>
            <div class="col-md-6 col-sm-8 col-12">
                <form action="action/cat-update.php" method="post" enctype="multipart/form-data" role="form">
                    <input type="hidden" name="cat_id" value="<?=$cat['cat_id']?>">
                    <div class="form-group">
                        <label for="cat_name">Category Name</label>
                        <input type="text" name="cat_name" class="form-control" value="<?=$cat['cat_name']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="cat_img">Image</label>
                        <input type="file" name="cat_img" class="form-control">
                        <img src="<?=$cat['cat_image']?>" style="max-width: 200px">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </main>

        <?php include 'js.php'; ?>
        </body>
        </html>
        <?php
    }
}
?>

