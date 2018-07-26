<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if(isset($_POST) and isset($_FILES)) {
//    print_r($_POST);
//    print_r($_FILES);
//    $_FILES['userProfileImage'] = $_POST['userProfileImage'];
    $errors = array();
    $file_name = $_FILES['food_img']['name'];
////    echo $file_name;
    $file_size = $_FILES['food_img']['size'];
    $file_tmp = $_FILES['food_img']['tmp_name'];
    $file_type = $_FILES['food_img']['type'];
//    $file_ext=strtolower(end(explode('.',$file_name)));
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
//    echo $file_ext;
//    die();
    $expensions = array("jpeg", "jpg", "png","PNG","JPG","JPEG");
//
//    $file_basename = substr($file_name, 0, strripos($file_name, '.'));

    if (in_array($file_ext, $expensions) === false) {
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        $_SESSION['formatStatus'] = false;
        $_SESSION['errorFormat'] = '<div class="alert alert-warning">Extension not allowed, please choose a JPEG or PNG file.</div>';

    }
//
    if ($file_size > 2097152) {
        $errors[]="File size must be excately 2 MB.";
        $_SESSION['sizeStatus'] = false;
        $_SESSION['errorSize'] = '<div class="alert alert-warning">File size must be excately 2 MB</div>';

    }
//
    if ((in_array($file_ext, $expensions) === true) && ($file_size <= 2097152) ) {


        $target_dir = "../img/food-img/";
        $file_rename = md5($_POST['food_name']) . "." . $file_ext;

//        $postImage = $getUser->uploadProfileImage($user_id);
        $target_file = $target_dir . $file_rename;
        $_POST['food_image'] = 'img/food-img/'.$file_rename;
//        $imgFile = $target_dir.$getImage['img_name'];
//        $movefile = move_uploaded_file($file_tmp, $target_file);

        $getStore->prepareFood($_POST);
        if ($getStore->addNewFood() == true){
            $_SESSION['foodMsg'] = '<div class="alert alert-success">New Food Added.</div>';
            if (file_exists($target_file)) {
                unlink($target_file);
                move_uploaded_file($file_tmp, $target_file);
            }else{
                move_uploaded_file($file_tmp, $target_file);
            }
            header('location:'.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['foodMsg'] = '<div class="alert alert-danger">Food Add Failed</div>';
            header('location:'.$_SERVER['HTTP_REFERER']);
        }
//        if (file_exists($target_file)) {
//            unlink($target_file);
//            if (move_uploaded_file($file_tmp, $target_file) == true) {
//
//                if ($getStore->addNewFood() == true){
//                    $_SESSION['foodMsg'] = '<div class="alert alert-success">New Food Added.</div>';
//                    header('location:'.$_SERVER['HTTP_REFERER']);
//                }else{
//                    $_SESSION['foodMsg'] = '<div class="alert alert-danger">Food Add Failed</div>';
//                    header('location:'.$_SERVER['HTTP_REFERER']);
//                }
//            }
//        }else{
//            if (move_uploaded_file($file_tmp, $target_file) == true) {
//                if ($getStore->addNewFood() == true){
//                    $_SESSION['foodMsg'] = '<div class="alert alert-success">New Food Added.</div>';
//                    header('location:'.$_SERVER['HTTP_REFERER']);
//                }else{
//                    $_SESSION['foodMsg'] = '<div class="alert alert-danger">Food Add Failed</div>';
//                    header('location:'.$_SERVER['HTTP_REFERER']);
//                }
//            }
//        }
    }
}
