<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "devices";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $devices = $getStore->deviceList();
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
        <h3 class="text-center">All Devices</h3>

        <hr>
        <div class="text-center"><a href="device-add.php" class="btn btn-primary">Add New Device</a></div>
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
        if ($devices->num_rows > 0){
            ?>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Table Name</th>
                    <th>MAC</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($devices as $device){
                    ?>
                    <tr>
                        <td><?=$device['device_id']?></td>
                        <td><?=$device['table_name']?></td>
                        <td><?=$device['mac_address']?></td>
                        <td>
                            <a href="device-update.php?id=<?=$device['device_id']?>" class="btn btn-sm btn-primary">Update</a>
                            <a href="action/device-delete.php?id=<?=$device['device_id']?>" class="btn btn-sm btn-danger">Delete</a>
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

