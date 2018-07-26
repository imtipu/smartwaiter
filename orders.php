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
        <title>Admin</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <h3 class="text-center">Active Orders</h3>
        <hr>
        <?php
        if ($orders->num_rows > 0) {
            ?>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Food Name</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total Price(by Qty)</th>
                    <th>Customer Phone</th>
                    <th>Status</th>
                    <th>Order Table</th>
                    <th>Order Time</th>
                </tr>
                <?php
                //        print_r($foods);
                foreach ($orders as $order){
                    ?>
                    <tr>
                        <td><?=$order['order_id']?></td>
                        <td><?=$order['food_name']?></td>
                        <td><?=$order['food_quantity']?></td>
                        <td><?=$order['item_price']?></td>
                        <td><?=$order['total_price']?></td>
                        <td><?=$order['user_phone']?></td>

                        <td>
                            <a href="action/order-status.php?phone=<?=$order['user_phone']?>&status=<?=$order['status']?>" class="btn btn-sm btn-outline-primary">Send Order To Kitchen</a>
                        </td>
                        <td><?=$getStore->getTableByMac($order['mac_address'])['table_name']?></td>
                        <td><?=$order['ordered_at']?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }else{
            echo '<div class="text-center alert alert-info">No Active Order.</div>';
        }
        ?>


    </main>


    <?php include 'js.php';?>
    </body>
    </html>
    <?php
}
?>

