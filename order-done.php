<?php
include 'start.php';
require 'vendor/autoload.php';
$page = "orders-done";
//require_once 'style.php';
use App\store;
if (!isset($_SESSION['login'])){
    header('location: login.php');
}else{
    $getStore = new store\Store();
    $foods = $getStore->foodList();
    $orders = $getStore->orderDone();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'header.php';?>
        <title>Completed Orders</title>
    </head>
    <body>
    <?php include 'nav.php';?>
    <main class="container">
        <h3 class="text-center">Orders Completed</h3>
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
                        <td  class="order-phone"><div><?=$order['user_phone']?></div></td>
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

                        <td class="status">
                            <div>
                                <button class="btn btn-sm btn-success">Order Completed</button>
                                <a target="_blank" href="invoice.php?phone=<?= $order['user_phone'] ?>&status=<?= $order['status'] ?>" class="mt-3 btn btn-sm btn-info">Create Invoice</a>
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

    <div id="completeModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Complete Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <?php include 'js.php';?>
    <script>
        function orderCompleteModal(status,user_phone,event) {
            event.preventDefault();
            var newphone = user_phone.toString();
            $('#completeModal').modal('show');
            $('#completeModal .modal-body').html('<div class="text-center"><span class="text-info">Are you confirm?</span></div>');
            $('#completeModal .modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
                '<button onclick="orderComplete('+status+','+user_phone+',event)" type="button" class="btn btn-primary">Complete</button>');
        }
        function orderComplete(status,user_phone,event) {
            event.preventDefault();
            $.ajax({
                type:'get',
                url:'action/order_complete.php',
                data:{status:status,user_phone:user_phone},
                dataType: 'json',
                success:function (data) {
                    console.log(data);
                    $('#completeModal .modal-body').html(data.msg);
                    setTimeout(function(){ $('#completeModal').modal('hide'); }, 500);
                    $('#status_'+user_phone).html(data.status);
                }
            })
        }
    </script>
    </body>
    </html>
    <?php
}
?>

