<?php
class Database {
    private $_instance = NULL;

    private function __construct() {

    }

    private function __clone() {

    }

    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new Database();
        }

        return self::$_instance;
    }

}
