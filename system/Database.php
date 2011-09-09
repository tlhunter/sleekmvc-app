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
            return new DatabaseResult($result);
        }
        return FALSE;
    }

    public function querySimple($query) {

    }

    public function lastId() {
        return mysql_insert_id($this->connection);
    }

    public function lastError() {
        return mysql_error($this->connection);
    }

    public function affectedRows() {
        return mysql_affected_rows($this->connection);
    }

    public function insert($table, $data) {
        $sql = "INSERT INTO $table SET ";
        $interim = array();
        foreach($data AS $key => $value) {
            $interim[] = "`$key` = '" . mysql_real_escape_string($value, $this->connection) . "'";
        }
        $data = implode($interim, ',');
        $sql .= $data;
        if (mysql_query($sql)) {
            return mysql_insert_id($this->connection);
        } else {
            return FALSE;
        }
    }

    public function delete($table, $where) {

    }

    public function update($table, $data, $where) {

    }

    public function select($table, $where) {

    }

}
