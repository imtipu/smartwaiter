<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "food";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $foods = $getStore->foodList();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>Foods</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <h3 class="text-center">All Foods</h3>

        <hr>
        <div class="text-center"><a href="food-add.php" class="btn btn-primary">Add New Food</a></div>
        <div class="msg text-center">
            <?php
            if (isset($_SESSION['statusMsg'])){
                echo $_SESSION['statusMsg'];
                unset($_SESSION['statusMsg']);
            }
            ?>
        </div>
        <hr>
        <?php
        if ($foods->num_rows > 0){
            ?>
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Food Name</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
            <?php
            foreach ($foods as $food){
                ?>
                <tr>
                    <td><?=$food['food_id']?></td>
                    <td><img class="img-responsive" style="max-width: 100px;" src="<?=$food['food_image']?>"></td>
                    <td><?=$food['food_name']?></td>
                    <td><?=$getStore->catById($food['cat_id'])['cat_name']?></td>
                    <td><?=$food['food_price']?></td>
                    <td>
                        <a href="food-update.php?id=<?=$food['food_id']?>" class="btn btn-sm btn-primary">Update</a>
                        <a href="action/food-delete.php?id=<?=$food['food_id']?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                    <td>
                        <?php
                        if ($food['status'] == 1){
                            echo '<span class="btn btn-sm btn-info">Available</span><a href="action/food-status.php?id='.$food['food_id'].'&status=0" class="btn btn-sm btn-outline-danger ml-2">Make Unavailable</a>';
                        }else{
                            echo '<span class="btn btn-sm btn-danger">Unavailable</span><a href="action/food-status.php?id='.$food['food_id'].'&status=1" class="btn btn-sm btn-outline-info ml-2">Make Available</a>';
                        }
                        ?>
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>
        <?php
        }else{
            echo '<div class="text-center alert alert-info">No Food available.</div>';
        }
        ?>

    </main>

    <?php include 'js.php';?>
    </body>
    </html>
    <?php
}
?>

