<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "device-update";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else {
    if (isset($_GET['id'])) {
        $device_id = $_GET['id'];
        $getStore = new store\Store();
        $device = $getStore->deviceByID($device_id);
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <?php include 'header.php'; ?>
            <title><?=$device['mac_address']?></title>
        </head>
        <body>
        <?php include 'nav.php'; ?>
        <main class="container">
            <h3 class="text-center">Update Device</h3>
            <hr>
            <div class="msg">
                <?php

                if (isset($_SESSION['statusMsg'])) {
                    echo $_SESSION['statusMsg'];
                    unset($_SESSION['statusMsg']);
                }
                ?>
            </div>
            <div class="col-md-6 col-sm-8 col-12">
                <form action="action/device-update.php" method="post" role="form">
                    <input type="hidden" name="device_id" value="<?=$device['device_id']?>">
                    <div class="form-group">
                        <label for="table_name">Table Name/No</label>
                        <input type="text" id="table_name" name="table_name" class="form-control" value="<?=$device['table_name']?>" required>
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

