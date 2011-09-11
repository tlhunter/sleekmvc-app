<?php
class Error {
    public static function handler($errno, $errstr, $errfile, $errline, $errcontext) {
        $errorClassName = 'Controller_' . Config::get('error_controller');
        $errorClass = new $errorClassName;
        $errorClass->action_500($errno, $errstr, $errfile, $errline, $errcontext);
        exit();
    }

    public static function shutdown() {
        $error = error_get_last();
        if ($error['type'] == 1) {
            //include_once(APP_PATH . 'controller/Error.php');
            $errorClassName = 'Controller_' . Config::get('error_controller');
            $errorClass = new $errorClassName;
            $errorClass->action_fatal($error);
        }
    }
}

set_error_handler(array('Error', 'handler')); // Catches generic errors (or so I'm told)
//register_shutdown_function(array('Error', 'shutdown')); // Catches Fatal errors
