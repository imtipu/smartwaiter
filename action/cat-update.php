<?php
require '../start.php';
require_once '../vendor/autoload.php';
use App\store;
$getStore = new store\Store();
if(isset($_POST) or isset($_FILES)) {
//    print_r($_POST);
//    print_r($_FILES);
//    if ($_FILES['cat_img'] && $_FILES['cat_img']['error'] == 0){
//        echo $_FILES['cat_img'];
//    }else{
//        echo 'not';
//    }
//    die();
//    $_FILES['userProfileImage'] = $_POST['userProfileImage'];
    if ($_FILES['cat_img']['name'] == "") {
        $getStore->prepareCat($_POST);
        if ($getStore->updateCat($_POST['cat_id']) == true) {
            $_SESSION['catMsg'] = '<div class="alert alert-success">Category Updated.</div>';
            header('location:' . $_SERVER['HTTP_REFERER']);

        } else {
            $_SESSION['catMsg'] = '<div class="alert alert-danger">Category Update Failed</div>';
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        $errors = array();
        $file_name = $_FILES['cat_img']['name'];
////    echo $file_name;
        $file_size = $_FILES['cat_img']['size'];
        $file_tmp = $_FILES['cat_img']['tmp_name'];
        $file_type = $_FILES['cat_img']['type'];
//    $file_ext=strtolower(end(explode('.',$file_name)));
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
//    echo $file_ext;
//    die();
        $expensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG");
//
//    $file_basename = substr($file_name, 0, strripos($file_name, '.'));

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            $_SESSION['formatStatus'] = false;
            $_SESSION['errorFormat'] = '<div class="alert alert-warning">Extension not allowed, please choose a JPEG or PNG file.</div>';

        }
//
        if ($file_size > 2097152) {
            $errors[] = "File size must be excately 2 MB.";
            $_SESSION['sizeStatus'] = false;
            $_SESSION['errorSize'] = '<div class="alert alert-warning">File size must be excately 2 MB</div>';

        }
//
        if ((in_array($file_ext, $expensions) === true) && ($file_size <= 2097152)) {


            $target_dir = "../img/cat-img/";
            $file_rename = md5($_POST['cat_name']) . "." . $file_ext;

//        $postImage = $getUser->uploadProfileImage($user_id);
            $target_file = $target_dir . $file_rename;
            $_POST['cat_image'] = 'img/cat-img/' . $file_rename;
//        $imgFile = $target_dir.$getImage['img_name'];
//        $movefile = move_uploaded_file($file_tmp, $target_file);

            $getStore->prepareCat($_POST);
            if ($getStore->updateCatWithImage($_POST['cat_id']) == true) {
                $_SESSION['catMsg'] = '<div class="alert alert-success">Category Updated.</div>';
                if (file_exists($target_file)) {
                    unlink($target_file);
                    move_uploaded_file($file_tmp, $target_file);
                } else {
                    move_uploaded_file($file_tmp, $target_file);
                }
                header('location:' . $_SERVER['HTTP_REFERER']);

            } else {
                $_SESSION['catMsg'] = '<div class="alert alert-danger">Category Update Failed</div>';
                header('location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
