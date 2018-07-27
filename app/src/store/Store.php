<?php
/**
 * Created by PhpStorm.
 * User: zerot
 * Date: 25-May-18
 * Time: 1:52 AM
 */

namespace App\store;
use App\config\Database;

class Store
{
    public $conn;
    public function __construct()
    {
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $this->conn = $connection;
    }
    public function countOrderActive(){
        $sql = 'select * from `orders` where ``';
        $res = $this->conn->query($sql);
        return $res;
    }
    public function totalFood(){
        $sql = 'select * from `food`';
        $res = $this->conn->query($sql);
        return $res;
    }

    public function foodList(){
        $sql = 'select * from `food` ORDER BY `status` DESC ';
        $res = $this->conn->query($sql);
        return $res;
    }
    public function foodById($id){
        $sql = 'select * from `food` WHERE `food_id`='.$id;
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row;
    }
    public function foodStatusUpdate($id,$status){
        $sql = "update `food` set `status`='$status' where `food_id`='$id'";
        $res = $this->conn->query($sql);
        return $res;
    }
    public $food_name;
    public $food_price;
    public $food_cat_id;
    public $food_desc;
    public $food_image;
    public function prepareFood($data){
        if (array_key_exists("food_name",$data)){
            $this->food_name = mysqli_real_escape_string($this->conn,$data['food_name']);
        }
        if (array_key_exists("food_price",$data)){
            $this->food_price = mysqli_real_escape_string($this->conn,$data['food_price']);
        }
        if (array_key_exists("food_cat_id",$data)){
            $this->food_cat_id = mysqli_real_escape_string($this->conn,$data['food_cat_id']);
        }
        if (array_key_exists("food_desc",$data)){
            $this->food_desc = mysqli_real_escape_string($this->conn,$data['food_desc']);
        }
        if (array_key_exists("food_image",$data)){
            $this->food_image = mysqli_real_escape_string($this->conn,$data['food_image']);
        }
        return $data;
    }

    public function addNewFood(){
        $sql = "insert into `food` (`cat_id`,`food_name`,`food_image`,`food_price`,`food_description`) VALUES ('".$this->food_cat_id."','".$this->food_name."','".$this->food_image."','".$this->food_price."','".$this->food_desc."')";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function updateFood($id){
        $sql = "update `food` set `cat_id`='".$this->food_cat_id."',`food_name`='".$this->food_name."',`food_image`='".$this->food_image."',`food_price`='".$this->food_price."',`food_description`='".$this->food_desc."' where `food_id`=".$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    public function deleteFood($id){
        $sql = 'delete from `food` where `food_id`='.$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    public function catList(){
        $sql = 'select * from `category`';
        $res = $this->conn->query($sql);
        return $res;
    }
    public $cat_name;
    public $cat_image;
    public function prepareCat($data){
        if (array_key_exists("cat_name",$data)){
            $this->cat_name = mysqli_real_escape_string($this->conn,$data['cat_name']);
        }
        if (array_key_exists("cat_image",$data)){
            $this->cat_image = mysqli_real_escape_string($this->conn,$data['cat_image']);
        }
        return $data;
    }

    public function addNewCat(){
        $sql = "insert into `category` (`cat_name`,`cat_image`) VALUES ('".$this->cat_name."','".$this->cat_image."')";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function cat_delete($id){
        $sql = "delete from category where cat_id=".$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    public function updateCatWithImage($id){
        $sql = "update `category` set `cat_name`='".$this->cat_name."',`cat_image`='".$this->cat_image."' where `cat_id`=".$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    public function updateCat($id){
        $sql = "update `category` set `cat_name`='".$this->cat_name."' where `cat_id`=".$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    public function catById($id){
        $sql = 'select * from `category` WHERE `cat_id`='.$id;
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row;
    }
    public function deleteCat($id){
        $sql = 'delete from `category` where `cat_id`='.$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    public function userList(){
        $sql = 'select * from `user`';
        $res = $this->conn->query($sql);
        return $res;
    }
    public function userDelete($id){
        $sql = 'delete from `user` where user_id='.$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    public function deviceList(){
        $sql = 'select * from `devices`';
        $res = $this->conn->query($sql);
        return $res;
    }
    public function deviceAdd($mac,$table){
        $new_mac = mysqli_real_escape_string($this->conn,$mac);
        $sql = 'insert into `devices` (`table_name`,`mac_address`) values ("'.$table.'","'.$new_mac.'")';
        $res = $this->conn->query($sql);
        return $res;
    }
    public function deviceByID($id){
        $sql = 'select * from `devices` where device_id='.$id;
        $res = $this->conn->query($sql);
        $row =$res->fetch_assoc();
        return $row;
    }
    public function deviceUpdate($id,$table){
        $sql = 'update `devices` set table_name="'.$table.'" where device_id='.$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    public function deviceDelete($id){
        $sql = 'delete from `devices` where device_id='.$id;
        $res = $this->conn->query($sql);
        return $res;
    }



    // order functions

    public function orderList(){
//        $sql = "select * from `orders` ORDER BY `user_phone`";
        $today =date("Y-m-d");
        $sql = "select `order_id`,`food_id`,`food_name`,`food_quantity`,`item_price`,`total_price`,`user_phone`,`status`,`mac_address`,`ordered_at` from `orders` group by `user_phone` order by `ordered_at` DESC ";
//        $sql = "select * from `orders` where date (`ordered_at`) = CURRENT_DATE group by `user_phone`";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderToday(){
//        $today = CURDATE();
//        $sql = "select * from `orders` where date(`ordered_at`)=CURDATE()";
        $sql = "select `order_id`,`food_id`,`food_name`,`food_quantity`,`item_price`,`total_price`,`user_phone`,`status`,`mac_address`,`ordered_at` from `orders` where date(`ordered_at`)=CURDATE() group by `user_phone` order by `ordered_at` DESC ";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderActive(){
//        $sql = "select * from `orders` WHERE `status`=0 ORDER BY `user_phone`";
        $sql = "select order_id,food_id,food_name,food_quantity,item_price,total_price,user_phone,status,mac_address,ordered_at from orders where status=0 group by user_phone";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderToKitchen(){
        $sql = "select `order_id`,`food_id`,`food_name`,`food_quantity`,`item_price`,`total_price`,`user_phone`,`status`,`mac_address`,`ordered_at` from `orders` where `status`='1' and date(`ordered_at`)=CURDATE() group by `user_phone` order by `ordered_at` ASC ";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderDone(){
        $sql = "select `order_id`,`food_id`,`food_name`,`food_quantity`,`item_price`,`total_price`,`user_phone`,`status`,`mac_address`,`ordered_at` from `orders` where `status`=2  or `status`=3 group by `user_phone` order by `ordered_at` ASC ";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderByPhone($phone){
        $sql = "select * from orders where user_phone='".$phone."'";
        $res = $this->conn->query($sql);
        return $res;
    }

    public function orderUpdateToKitchen($user_phone){
        $sql = "update `orders` set `status`=1 WHERE `user_phone`='".$user_phone."' and `status`=0";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderMakeDone($user_phone){
        $sql = "update `orders` set `status`=2 WHERE `user_phone`='".$user_phone."' and `status`=1";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderComplete($phone){
        $sql = "update `orders` set `status`=3 where `status`=2 and `user_phone`='".$phone."'";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderSummary($phone){
        $sql = "select * from `orders` where `status`=3 and `user_phone`='".$phone."'";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function orderSummaryTotal($phone){
        $sql = "select sum(`total_price`) as total from `orders` where `status`=3 and `user_phone`='".$phone."'";
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row;
    }

    // end order functions
    public function getTableByMac($mac){
        $sql = "select * from `devices` where `mac_address`='".$mac."'";
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
//        $count = $res->num_rows;
        return $row;
    }
    // get devices


    //
    public function accessKeys(){
        $sql = "select * from `access`";
        $res = $this->conn->query($sql);
        return $res;
    }
    public function addNewKey($key){
        $new_key = mysqli_real_escape_string($this->conn,$key);
        $sql = "INSERT INTO `access`(`access_key`) VALUES ('".$new_key."')";
        $res = $this->conn->query($sql);
        return $sql;
    }
    public function deleteKey($id){
        $sql = "delete from `access` where id=".$id;
        $res = $this->conn->query($sql);
        return $res;
    }
    function getRandomString($length = 16) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
    // counts
    public function countFoods(){
        $sql = "select * from `food`";
        $res = $this->conn->query($sql);
        $count = $res->num_rows;
        return $count;
    }
    public function countCat(){
        $sql = "select * from `category`";
        $res = $this->conn->query($sql);
        $count = $res->num_rows;
        return $count;
    }
    public function countOrderDoneToday(){
        $sql = "select * from `orders` where DATE(`ordered_at`) = CURDATE()";
        $res = $this->conn->query($sql);
        $count = $res->num_rows;
        return $count;
    }
    public function countOrderDoneMonth(){
        $sql = "select * from `orders` where MONTH(`ordered_at`) = CURDATE()";
        $res = $this->conn->query($sql);
        $count = $res->num_rows;
        return $count;
    }
    public function countTodayOrder(){
        $sql = "select * from `orders` where DATE(`ordered_at`) = CURDATE()";
        $res = $this->conn->query($sql);
        $count = $res->num_rows;
        return $count;
    }
    public function earningTodayOrder(){
        $sql = "select SUM(total_price) as total from `orders` where DATE(`ordered_at`) = CURDATE()";
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row['total'];
    }
    public function earningCurrentMonth(){
        $sql = "select SUM(total_price) as total from `orders` where MONTH (`ordered_at`) = CURDATE()";
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row['total'];
    }
    public function earningTotal(){
        $sql = "select SUM(total_price) as total from `orders`";
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row['total'];
    }

}