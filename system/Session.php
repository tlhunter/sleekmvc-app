<?php
class Session {
    static private $_instance   = NULL;

    private function __construct() {
        session_start();
    }

    /**
     * Prevents the class from being cloned
     * @return NULL
     */
    private function __clone() { }

    /**
     * Returns the singleton instance of this class
     * @return Session
     */
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new Session();
        }
        return self::$_instance;
    }

    function __get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return NULL;
    }

    function __set($key, $value) {
        $_SESSION[$key] = $value;
    }
}
