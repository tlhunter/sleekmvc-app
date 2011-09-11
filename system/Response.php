<?php
class Response {
    /**
     * @var Response The singleton instance of our response class
     */
    static private $_instance   = NULL;

    private function __construct() {

    }

    /**
     * Prevents the class from being cloned
     * @return NULL
     */
    private function __clone() { }

    /**
     * Returns the singleton instance of the Database class
     * @return Response
     */
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new Response();
        }
        return self::$_instance;
    }

    public static function redirect($url, $permanent = FALSE) {
        if ($permanent) {
            header("HTTP/1.1 301 Moved Permanently");
        }
        header("Location: $url");
        exit(); // is this a good idea?
    }

    public static function header($name, $value) {

    }

    public static function status($code) {

    }

    public static function cookie($key, $value) {
        // Response cookie sets cookies
        // Request cookie will get cookies
    }
}
