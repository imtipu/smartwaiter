<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "cat";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $cats = $getStore->catList();
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
        <h3 class="text-center">All Categories</h3>
        <hr>
        <div class="text-center"><a href="category-add.php" class="btn btn-primary">Add New Category</a></div>
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
        if ($cats->num_rows > 0){
            ?>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($cats as $cat){
                    ?>
                    <tr>
                        <td><?=$cat['cat_id']?></td>
                        <td><img class="img-responsive" style="max-width: 100px;" src="<?=$cat['cat_image']?>"></td>
                        <td><?=$cat['cat_name']?></td>
                        <td>
                            <a href="cat-update.php?id=<?=$cat['cat_id']?>" class="btn btn-sm btn-primary">Update</a>
                            <a href="action/cat-delete.php?id=<?=$cat['cat_id']?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </table>
            <?php
        }else{
            echo '<div class="text-center alert alert-info">No Category available.</div>';
        }
        ?>

    </main>

    <?php include 'js.php';?>
    </body>
    </html>
    <?php
}
?>

