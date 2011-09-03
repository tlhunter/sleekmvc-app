<?php
class Response {
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
