<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;

$getStore = new store\Store();

if (isset($_GET)){
    $food_id = $_GET['id'];
    $status = $_GET['status'];
    if ($getStore->foodStatusUpdate($food_id,$status)){
        $_SESSION['statusMsg'] = '<div class="alert alert-success">Food Status Updated.</div>';
        header('location:'.$_SERVER['HTTP_REFERER']);
//        echo $getStore->foodStatusUpdate($food_id,$status);
    }else{
        $_SESSION['statusMsg'] = '<div class="alert alert-dander">Food Status Update Failed.</div>';
        header('location:'.$_SERVER['HTTP_REFERER']);
//        echo $getStore->foodStatusUpdate($food_id,$status);
    }

}