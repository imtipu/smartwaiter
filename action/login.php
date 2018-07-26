<?php
require '../start.php';
require_once '../vendor/autoload.php';

use App\admin\login;
$getLoginUser = new Login();
if (isset($_POST)){
//    print_r($_POST);
//    die();
    $username = $_POST['username'];
    $password = $_POST['password'];
//    $getLoginUser->prepareLogin($_POST);
//
    $checklogin = $getLoginUser->check_login($username,$password);
//
    if ($checklogin == true) {
//        $user->updateLogin($checklogin['id']);
        $loginUser = $getLoginUser->getLoginUser($username,$password);
//        echo $loginUser['id'].$loginUser['email'];
        if ($loginUser == true) {
//            echo $loginUser['id'].$loginUser['email'];
            $_SESSION['login'] = true;
            $_SESSION['login_id'] = $loginUser['id'];
            header('location: '.$root);
//            $data['logged'] = "ok";
//            $data['loginMsg'] = '<div id="loginMsg" class="text-center"><div class="alert alert-success">Login Successfull</div></div>';
//            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    }else{
//        $data['logged'] = "false";
        $_SESSION['loginMsg'] = "<div class='alert alert-danger'>Invalid Username or Password</div>";
        header("Location: ".$_SERVER['HTTP_REFERER']);
//        echo "false";
    }
}