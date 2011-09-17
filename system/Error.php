<?php
namespace SleekMVC;

class Error {
    public static function handler($errno, $errstr, $errfile, $errline, $errcontext) {
        $errorClassName = '\\App\\' . Config::get('error_controller');
        $errorClass = new $errorClassName;
        $errorClass->action_500($errno, $errstr, $errfile, $errline, $errcontext);
        exit();
    }

    public static function shutdown() {
        $error = error_get_last();
        if ($error['type'] == 1) {
            $errorClassName = '\\App\\' . Config::get('error_controller');
            $errorClass = new $errorClassName;
            $errorClass->action_fatal($error);
        }
    }

    public static function register() {
        set_error_handler(array('\\SleekMVC\\Error', 'handler'));
        //register_shutdown_function(array('Error', 'shutdown')); // Catches Fatal errors
    }        
}
