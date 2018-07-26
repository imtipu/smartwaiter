<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if (isset($_GET)){
    $cat_id = $_GET['id'];
//    echo $cat_id;
    if ($getStore->cat_delete($cat_id) == true){
        $_SESSION['statusMsg'] = '<div class="alert alert-success">Category Deleted.</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);

    } else {
        $_SESSION['statusMsg'] = '<div class="alert alert-danger">Category Delete Failed</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);
    }
}