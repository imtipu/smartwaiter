<?php
include 'start.php';
require 'vendor/autoload.php';
$page = "orders";
//require_once 'style.php';
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $foods = $getStore->foodList();
    $orders = $getStore->orderList();
    $ordersArray = array($orders);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>All Orders</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <h3 class="text-center">All Orders</h3>
        <hr>
        <?php
        if ($orders->num_rows > 0){
            ?>
            <table id="order" class="table table-sm table-bordered text-center">
                <thead class="thead-dark">
                <tr>
                    <th>Serial</th>
                    <th>Customer Phone</th>
                    <th>Order Details</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //        print_r($foods);
                $counter = 1;
                foreach ($orders as $order){

                    ?>
                    <tr>
                        <td class="text-center"><div class="m-auto"><span class="btn btn-danger"><?=$counter++?></span></div></td>
                        <td><div class="order-phone"><?=$order['user_phone']?></div></td>
                        <td>
                            <table class="table" style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>Order Id</th>
                                    <th>Food Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total Price</th>
                                    <th>Order Time</th>
                                    <th>Order Table</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $phones = $getStore->orderByPhone($order['user_phone']);
                                foreach($phones as $phone) {
                                    ?>
                                    <tr>
                                        <td><?=$phone['order_id']?></td>
                                        <td><?=$phone['food_name']?></td>
                                        <td><?=$phone['item_price']?>/-</td>
                                        <td><?=$phone['food_quantity']?></td>
                                        <td><?=$phone['total_price']?>/-</td>
                                        <td><?=$phone['ordered_at']?></td>
                                        <td><?=$getStore->getTableByMac($phone['mac_address'])['table_name']?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>

                            </table>
                        </td>

                        <td class="status text-center">
                            <div class="text-center" id="status_<?=$order['user_phone']?>">
                                <?php
                                if ($order['status'] == 2) {
                                    ?>
                                    <span class="btn btn-sm btn-outline-dark">Order In Table</span>
                                    <?php
                                }elseif ($order['status'] == 3){
                                    ?>
                                    <span class="btn btn-success btn-sm">Order Completed.</span>
                                    <a target="_blank" href="invoice.php?phone=<?= $order['user_phone'] ?>&status=<?= $order['status'] ?>"
                                       class="mt-3 btn btn-sm btn-info">Create Invoice</a>
                                    <?php
                                }elseif ($order['status'] == 0){
                                    ?>
                                    <span class="mt-3 btn btn-sm btn-outline-info">Active</span>
                                    <?php
                                }
                                elseif ($order['status'] == 1){
                                    ?>
                                    <span class="mt-3 btn btn-sm btn-outline-primary">In Kitchen</span>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>

            </table>
            <?php
        }else{
            echo '<div class="text-center alert alert-info">No Orders available</div>';
        }
        ?>
    </main>


    <?php include 'js.php';?>
    </body>
    </html>
    <?php
}
?>

