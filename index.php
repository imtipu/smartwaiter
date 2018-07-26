<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "home";
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
$getStore = new store\Store();
$foods = $getStore->foodList();
?>
<!doctype html>
<html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>Dashboard</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Total Food</h5>
                        <p class="card-text"><?=$getStore->countFoods()?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Active Order</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Today's Earning</h5>
                        <p class="card-text"><?=$getStore->earningTodayOrder()?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h5 class="card-title">Earning This Month</h5>
                        <p class="card-text"><?=$getStore->earningTotal()?></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'js.php';?>
    </body>
</html>
<?php
}
?>

