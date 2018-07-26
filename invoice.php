<?php
include 'start.php';
require 'vendor/autoload.php';
//require_once 'style.php';
$page = "invoice";
use App\store;

$getStore = new store\Store();


if (!isset($_SESSION['login'])){
    header('location: login.php');
}else {
    $foods = $getStore->foodList();

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>Admin</title>
    </head>
    <body>
    <?php include 'nav.php'; ?>
    <main class="container">
        <?php
        if (isset($_GET)) {
            $phone = $_GET['phone'];
            $satus = $_GET['status'];


        ?>
        <div class="invoice m-auto" style="max-width: 640px">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Invoice</h2>
                    <h3 class="">Order for # <?=$_GET['phone']?></h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <address>
                        <strong>Billed by:</strong><br>
                        Admin<br>
                        Dhanmondi<br>
                        <span class="btn btn-outline-dark">City Restaurent</span>
                    </address>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><strong>Order summary</strong></h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <td><strong>Item</strong></td>
                                        <td class="text-center"><strong>Price</strong></td>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                        <td class="text-right"><strong>Totals</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $orders = $getStore->orderSummary($phone);
                                    $total = $getStore->orderSummaryTotal($phone)['total'];
                                     foreach ($orders as $order) {
                                         ?>
                                         <tr>
                                             <td><?=$order['food_name']?></td>
                                             <td class="text-center"><?=$order['item_price']?>/-</td>
                                             <td class="text-center"><?=$order['food_quantity']?></td>
                                             <td class="text-right"><?=$order['total_price']?>/-</td>
                                         </tr>
                                         <?php
                                     }
                                     ?>

                                         <tr>
                                             <td class="thick-line"></td>
                                             <td class="thick-line"></td>
                                             <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                             <td class="thick-line text-right"><?=$total?>/-</td>
                                         </tr>
                                         <tr>
                                             <td class="no-line"></td>
                                             <td class="no-line"></td>
                                             <td class="no-line text-center"><strong>Vat (15%)</strong></td>
                                             <td class="no-line text-right"><?=$total*(0.15)?>/-</td>
                                         </tr>
                                         <tr>
                                             <td class="no-line"></td>
                                             <td class="no-line"></td>
                                             <td class="no-line text-center"><strong>Total</strong></td>
                                             <td class="no-line text-right"><?=$total+$total*0.15?>/-</td>
                                         </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </main>
    <?php include 'js.php';?>
    </body>
    </html>
    <?php
}
?>