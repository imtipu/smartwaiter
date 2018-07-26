<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "keys";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $keys = $getStore->accessKeys();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>Access Keys</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <h3 class="text-center">All Access Keys</h3>
        <hr>
        <div class="text-center"><a href="action/key-make.php" class="btn btn-primary">Generate New Key</a></div>
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
        if ($keys->num_rows > 0){
            ?>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Key</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($keys as $key){
                    ?>
                    <tr>
                        <td><?=$key['id']?></td>
                        <td><?=$key['access_key']?></td>
                        <td>
                            <a href="action/key-delete.php?id=<?=$key['id']?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </table>
            <?php
        }else{
            echo '<div class="text-center alert alert-info">No Keys available.</div>';
        }
        ?>

    </main>

    <?php include 'js.php';?>
    </body>
    </html>
    <?php
}
?>

