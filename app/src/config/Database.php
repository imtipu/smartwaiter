<?php
namespace App\config;
class Database {
    private $_connection;
    private static $_instance; //The single instance
    private $_host = "127.0.0.1";
    private $_username = "root";
    private $_password = "";
    private $_database = "kamrul";

//    private $_host = "43.255.154.124";
//    private $_username = "enlisterdb";
//    private $_password = "enlister2018";
//    private $_database = "enlisterdev";
    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor
    private function __construct() {
        $this->_connection = new \mysqli($this->_host, $this->_username,
            $this->_password, $this->_database);

        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(),
                E_USER_ERROR);
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
    // Get mysqli connection
    public function getConnection() {
        return $this->_connection;
    }
}
?>