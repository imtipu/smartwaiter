<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if (isset($_GET)){
    $user_id = $_GET['id'];
//    echo $cat_id;
    if ($getStore->userDelete($user_id) == true){
        $_SESSION['statusMsg'] = '<div class="alert alert-success">User Removed.</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);

    } else {
        $_SESSION['statusMsg'] = '<div class="alert alert-danger">User Remove Failed</div>';
        header('location:' . $_SERVER['HTTP_REFERER']);
    }

}