<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if (isset($_POST)){
    $device_id = $_POST['device_id'];
    $table_name = $_POST['table_name'];
//    echo $cat_id;
    if ($getStore->deviceUpdate($device_id,$table_name) == true){
        $_SESSION['statusMsg'] = '<div class="alert alert-success">Device Updated.</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);

    } else {
        $_SESSION['statusMsg'] = '<div class="alert alert-danger">Device Update Failed</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);
    }

}