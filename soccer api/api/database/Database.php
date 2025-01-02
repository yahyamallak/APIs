<?php

namespace Api\Database;

use PDO;

class Database {

    private static $instance = null;
    private static $host = "localhost";
    private static $dbname = "api_soccer_players";
    private static $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
    private static $username = "root";
    private static $password = "";

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new PDO(self::$dsn, self::$username, self::$password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);   
        }
        return self::$instance;
    }
}