<?php

class Database 
{
    private static $_instance = null;
    public $db = null;

    private function __construct() {
        $host = getenv("DB_HOST");
        $port= getenv("BD_PORT");
        $db = getenv("DB_NAME");
        $user = getenv("DB_USER");
        $passwd = getenv("DB_PASSWD");
        $this->db = new PDO("mysql:host={$host};dbname={$db};port={$port}", $user, $passwd);
    }

    private function __clone() {}

    public static function getInstance() {
        if (!(self::$_instance instanceOf self))
            self::$_instance = new self;
        return self::$_instance;
    }
}
