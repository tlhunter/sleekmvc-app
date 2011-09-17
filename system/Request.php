<?php
namespace Sleek;

class Request {
    /**
     * @var Request The singleton instance of our request class
     */
    static private $_instance   = NULL;

    static protected $url      = array();

    private function __construct() {
        self::$url['controller']   = (isset($_GET['controller']) ? ucfirst($_GET['controller']) : Config::get('default_controller'));
        self::$url['action']       = (isset($_GET['action']) ? $_GET['action'] : Config::get('default_action'));
        self::$url['arguments']    = isset($_GET['arg']) ? $_GET['arg'] : array();
        unset($_GET['controller'], $_GET['action'], $_GET['arg']); // This data shouldn't be available to GET
    }

    /**
     * Prevents the database class from being cloned
     * @return NULL
     */
    private function __clone() { }

    /**
     * Returns the singleton instance of the Database class
     * @return Database
     */
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new Request();
        }
        return self::$_instance;
    }

    public function get($key) {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
        return NULL;
    }

    public function post($key) {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return NULL;
    }

    public function cookie($key) {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
        return NULL;
    }

    public function server($key) {
        if (isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }
        return NULL;
    }

    public function urlController() {
        return self::$url['controller'];
    }

    public function urlAction() {
        return self::$url['action'];
    }

    public function urlArguments($index = NULL) {
        if ($index != NULL) {
            if (isset(self::$url['arguments'][$index])) {
                return self::$url['arguments'][$index];
            } else {
                return NULL;
            }
        }
        return self::$url['arguments'];
    }
}
