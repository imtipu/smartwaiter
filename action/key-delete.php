<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if (isset($_GET)){
    $key = $_GET['id'];
//    echo $cat_id;
    if ($getStore->deleteKey($key) == true){
        $_SESSION['statusMsg'] = '<div class="alert alert-success">Key Deleted.</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);

    } else {
        $_SESSION['statusMsg'] = '<div class="alert alert-danger">Key Delete Failed</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);
    }
}