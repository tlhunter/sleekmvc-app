<?php
abstract class Model_Database extends Model_Base {
    protected $connection = NULL;
    private $instance = NULL;

    private function __construct() {
        // set connection using Config class
    }

    public static function getInstance() {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new Model_Database();
        return self::$instance;
    }

}
