<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "users";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $users = $getStore->userList();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>Devices</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <h3 class="text-center">All Users</h3>

        <hr>
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
        if ($users->num_rows > 0){
            ?>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($users as $user){
                    ?>
                    <tr>
                        <td><?=$user['user_id']?></td>
                        <td><?=$user['user_name']?></td>
                        <td><?=$user['user_phone']?></td>
                        <td>
<!--                            <a href="user-update.php?id=--><?//=$user['user_id']?><!--" class="btn btn-sm btn-primary">Update</a>-->
                            <a href="action/user-delete.php?id=<?=$user['user_id']?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </table>
            <?php
        }else{
            echo '<div class="text-center alert alert-info">No user available.</div>';
        }
        ?>

    </main>

    <?php include 'js.php';?>
    </body>
    </html>
    <?php
}
?>

