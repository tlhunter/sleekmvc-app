<?php
class Session {
    function __construct() {
        session_start();
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
