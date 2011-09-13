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
        if (headers_sent()) {
            return FALSE;
        }
        if ($permanent) {
            header("HTTP/1.1 301 Moved Permanently");
        }
        header("Location: $url");
        return TRUE;
    }

    public static function header($name, $value = NULL) {
        if (headers_sent()) {
            return FALSE;
        }
        $header = $name;
        if ($value) {
            $header .= ": $value";
        }
        header($header);
        return TRUE;
    }

    /**
     * Sets a status code by taking the number and automatically adding the status text for the developer
     * @param $code int
     * @return bool
     */
    public static function status($code) {
        if (headers_sent()) {
            return FALSE;
        }
        $text = '';
        # List needs to contain more entries
        # http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
        switch($code) {
            case '200':
                $text = "OK";
                break;
            case '400':
                $text = "Bad Request";
                break;
            case '401':
                $text = "Unauthorized";
                break;
            case '403':
                $text = "Forbidden";
                break;
            case '404':
                $text = "Not Found";
                break;
            case '500':
                $text = "Internal Server Error";
                break;
            default:
                return FALSE;
        }
        header($code . ' ' . $text);
        return TRUE;
    }

    /**
     * This function sets a cookie. To read a cookie, use Request::cookie();
     */
    public static function cookie($name, $value, $expire = 0, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL) {
        if (headers_sent()) {
            return FALSE;
        }
        return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
        // Response cookie sets cookies
        // Request cookie will get cookies
    }
}
