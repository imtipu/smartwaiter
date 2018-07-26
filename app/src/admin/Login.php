<?php
namespace App\admin;
use App\config\Database;
class Login
{
    public $conn;
    public function __construct()
    {
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $this->conn = $connection;
    }

    public $username;
    public $password;
    public function prepareLogin($data){
        if (array_key_exists('username',$data)){
            $this->username = mysqli_real_escape_string($this->conn,$data['username']);
        }
        if (array_key_exists('password',$data)){
            $this->password = mysqli_real_escape_string($this->conn,$data['password']);
        }
    }
    public function check_login($username,$password){
//        $username = $this->username;
//        $password = $this->password;
        $sql = "select * from `admin` where `username`='".$username."' and `password` = '".$password."'";
        $res = $this->conn->query($sql);
        $count = $res->num_rows;
        return $count;
    }
    public function getLoginUser($username,$password){
//        $username = $this->username;
//        $password = $this->password;
        $sql = "select * from `admin` where `username`='".$username."'  and `password` = '".$password."'";
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row;

    }
    public function getSessionUser($id){
        $sql = "select * from `admin` where `id`='".$id."'";
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row;
    }
}