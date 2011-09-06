<?php
class Database {
    static private $_instance = NULL;
    protected $connection = NULL;

    private function __construct() {
        $settings = Config::get('database');
        $this->connection = mysql_connect($settings['host'], $settings['user'], $settings['pass']);
        $this->selectDatabase($settings['name']);

    }

    private function __clone() { }

    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function selectDatabase($database) {
        mysql_select_db($database, $this->connection);
    }

    public function query($query) {
        $result = mysql_query($query, $this->connection);
        if ($result) {
            return $result;
        }
        return FALSE;
    }

    public function lastId() {
        return mysql_insert_id($this->connection);
    }

    public function lastError() {
        return mysql_error($this->connection);
    }

}
