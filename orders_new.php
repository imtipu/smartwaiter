<?php
include 'start.php';
require 'vendor/autoload.php';
$page = "orders-today";
//require_once 'style.php';
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $foods = $getStore->foodList();
    $orders = $getStore->orderList();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>Orders</title>
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
                                        <td><?=$phone['item_price']?></td>
                                        <td><?=$phone['food_quantity']?></td>
                                        <td><?=$phone['total_price']?></td>
                                        <td><?=$phone['ordered_at']?></td>
                                        <td><?=$getStore->getTableByMac($phone['mac_address'])['table_name']?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>

                            </table>
                        </td>

                        <td class="status">
                            <div>
                                <?php
                                if ($order['status'] == 0){
                                    echo '<a href="action/order-status.php?phone='.$order['user_phone'].'&status='.$order['status'].'" class="btn btn-sm btn-outline-primary">Send to kitchen</a>';
                                }
                                if ($order['status'] == 1){
                                    echo '<button class="btn btn-sm btn-info">In Kitchen</button>';
                                }
                                if ($order['status'] == 2){
                                    echo '<span class="btn btn-sm btn-dark">Order In Table</span>';
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

