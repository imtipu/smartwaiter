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
            <div class="col-md-4">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Food</h5>
                        <p class="card-text">Total Food: <?=$getStore->countFoods()?></p>
                        <p class="card-text">Total Category: <?=$getStore->countCat()?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Order</h5>
                        <p class="card-text">Today: <?=$getStore->countOrderDoneToday()?></p>
                        <p class="card-text">This Month: <?=$getStore->countOrderDoneMonth()?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Earning</h5>
                        <p class="card-text">Today: <?=$getStore->earningTodayOrder()?></p>
                        <p class="card-text">This Month: <?=$getStore->earningCurrentMonth()?></p>
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

