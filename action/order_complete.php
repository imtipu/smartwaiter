<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;

$getStore = new store\Store();

if (isset($_GET)) {
    $status = $_GET['status'];
    $phone = $_GET['user_phone'];
    if ($status == 2) {
        if ($getStore->orderComplete($phone) == true){
            $data['msg'] = '<div class="text-center"><span class="text-success">Order Completed</span></div>';
            $data['msg2'] = $getStore->orderComplete($phone);
            $data['status'] = '<a target="_blank" href="invoice.php?phone='.$phone.'&status=3" class="mt-3 btn btn-sm btn-info">Create Invoice</a>';
        }else{
            $data['msg'] = '<div class="text-center"><span class="text-danger">Order not Completed</span></div>';
        }
        echo json_encode($data);

    }
}