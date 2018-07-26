<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;

$getStore = new store\Store();

if (isset($_GET)){
    $status = $_GET['status'];
    $phone = $_GET['phone'];
    if ($status == 0){
        if ($getStore->orderUpdateToKitchen($phone) == true){

            $_SESSION['statusMsg'] = '<div class="alert alert-success">Order Successfully Sent to Kitchen</div>';
            header('location:'.$_SERVER['HTTP_REFERER']);

        }else{
            $_SESSION['statusMsg'] = '<div class="alert alert-danger">Order failed to send at Kitchen</div>';
            header('location:'.$_SERVER['HTTP_REFERER']);
        }

    }elseif ($status == 1){
        if ($getStore->orderMakeDone($phone) == true){
            $_SESSION['statusMsg'] = '<div class="alert alert-success">Order Done</div>';
            header('location:'.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['statusMsg'] = '<div class="alert alert-danger">Order Done failed.</div>';
            header('location:'.$_SERVER['HTTP_REFERER']);
        }

    }
}