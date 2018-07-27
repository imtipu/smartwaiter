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
            <div class="col-md-12">
                <div class="text-center">
                    <h1>Smart Waiter</h1>
                </div>
                <hr>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-secondary">
                    <div class="card-header" style="border-bottom: 2px solid #dee2e6;">
                        <h5 class="card-title">Food</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Food: <span class="float-right"><?=$getStore->countFoods()?></span></p>
                        <p class="card-text">Total Category: <span class="float-right"><?=$getStore->countCat()?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-header" style="border-bottom: 2px solid #dee2e6;"><h5 class="card-title">Order</h5></div>
                    <div class="card-body">
                        <p class="card-text">Today: <span class="float-right"><?=$getStore->countOrderDoneToday()?></span></p>
                        <p class="card-text">This Month: <span class="float-right"><?=$getStore->countOrderDoneMonth()?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-dark">
                    <div class="card-header" style="border-bottom: 2px solid #dee2e6;"><h5 class="card-title">Earning</h5></div>
                    <div class="card-body">
                        <p class="card-text">Today: <span class="float-right"><?php if($getStore->earningTodayOrder()){echo $getStore->earningTodayOrder();}else{ echo "0.00"; }?> BDT.</span></p>
                        <p class="card-text">This Month: <span class="float-right"><?php if($getStore->earningCurrentMonth()){echo $getStore->earningCurrentMonth();}else{ echo "0.00"; }?> BDT.</span></p>
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

