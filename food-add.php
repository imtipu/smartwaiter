<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "food-add";
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
            if (isset($_SESSION['foodMsg'])){
                echo $_SESSION['foodMsg'];
                unset($_SESSION['foodMsg']);
            }
            ?>
        </div>
        <div class="col-md-6 col-sm-8 col-12">
            <form action="action/add-food.php" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <label for="food_name">Food Name</label>
                    <input type="text" name="food_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="food_price">Price</label>
                    <input type="text" name="food_price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="food_desc">Description</label>
                    <textarea name="food_desc" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="food_cat_id">Category</label>
                    <select name="food_cat_id" class="form-control" required>
                        <option selected>-- Select Category --</option>
                        <?php
                        foreach ($cats as $cat){
                            echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="food_img">Image</label>
                    <input type="file" name="food_img" class="form-control" required>
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

