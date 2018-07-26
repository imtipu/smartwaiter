<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();

$key = $getStore->getRandomString();
if ($getStore->addNewKey($key) == true){
    $_SESSION['statusMsg'] = '<div class="alert alert-success">Key Added.</div>';
    header('location:' . $_SERVER['HTTP_REFERER']);

} else {
    $_SESSION['statusMsg'] = '<div class="alert alert-danger">Key Add Failed</div>';
    header('location:' . $_SERVER['HTTP_REFERER']);
}