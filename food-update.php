<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "food-update";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else {
    if (isset($_GET['id'])) {
        $food_id = $_GET['id'];
        $getStore = new store\Store();
        $cats = $getStore->catList();
        $food= $getStore->foodById($food_id);
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <?php include 'header.php'; ?>
            <title>Admin</title>
        </head>
        <body>
        <?php include 'nav.php'; ?>
        <main class="container">
            <h3 class="text-center">Add New Food</h3>
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
                if (isset($_SESSION['foodMsg'])) {
                    echo $_SESSION['foodMsg'];
                    unset($_SESSION['foodMsg']);
                }
                ?>
            </div>
            <div class="col-md-6 col-sm-8 col-12">
                <form action="action/food-update.php" method="post" enctype="multipart/form-data" role="form">
                    <input type="hidden" name="food_id" value="<?=$food['food_id']?>">
                    <div class="form-group">
                        <label for="food_name">Food Name</label>
                        <input type="text" name="food_name" class="form-control" value="<?=$food['food_name']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="food_price">Price</label>
                        <input type="text" name="food_price" class="form-control" value="<?=$food['food_price']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="food_desc">Description</label>
                        <textarea name="food_desc" class="form-control" required><?=$food['food_description']?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="food_cat_id">Category</label>
                        <select name="food_cat_id" class="form-control" required>
                            <?php
                            foreach ($cats as $cat) {
                                ?>
                               <option value="<?=$cat['cat_id']?>" <?php if ($cat['cat_id'] == $food['cat_id']){echo 'selected';}?>><?=$cat['cat_name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="food_img">Image</label>
                        <input type="file" name="food_img" class="form-control" required>
                        <img src="<?=$food['food_image']?>" style="max-width: 200px">
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

