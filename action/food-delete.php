<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if (isset($_GET)){
    $food_id = $_GET['id'];
//    echo $cat_id;
    if ($getStore->deleteFood($food_id) == true){
        $_SESSION['statusMsg'] = '<div class="alert alert-success">Food Deleted.</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);

    } else {
        $_SESSION['statusMsg'] = '<div class="alert alert-danger">Food Delete Failed</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);
    }

}