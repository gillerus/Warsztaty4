<?php

class Database {

    static public $conn = null;
    static private $host = 'localhost';
    static private $login = 'root';
    static private $pass = 'coderslab';
    static private $db = 'shop';

    static public function getConnection() {
        self::$conn = new mysqli(self::$host, self::$login, self::$pass, self::$db);
        self::$conn->set_charset("utf8");
        if (mysqli_connect_errno()) {
            echo 'There is an error ' . mysqli_connect_error();
            die;
        } else {
            return self::$conn;
        }
    }

    static public function closeConnection() {
        self::$conn->close();
        self::$conn = null;
    }

}
