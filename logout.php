<?php
session_start();
if (isset($_SESSION['login_id'])){
    unset($_SESSION['login']);
    unset($_SESSION['login_id']);
    session_destroy();
    header('Location: ./');
}else{
    header('Location: ./');
}