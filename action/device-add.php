<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if (isset($_POST)){
//    echo $cat_id;
    if ($getStore->deviceAdd($_POST['table_name'],$_POST['mac_address']) == true){
        $_SESSION['statusMsg'] = '<div class="alert alert-success">Device Added.</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);

    } else {
        $_SESSION['statusMsg'] = '<div class="alert alert-danger">Device Add Failed</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);
    }

}