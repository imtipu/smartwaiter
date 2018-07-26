<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if (isset($_GET)){
    $device_id = $_GET['id'];
//    echo $cat_id;
    if ($getStore->deviceDelete($device_id) == true){
        $_SESSION['statusMsg'] = '<div class="alert alert-success">Device Removed.</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);

    } else {
        $_SESSION['statusMsg'] = '<div class="alert alert-danger">Category Remove Failed</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);
    }

}