<?php
class Error {
    public static function handler($errno, $errstr, $errfile, $errline, $errcontext) {
        call_user_func_array(
            array(
                'Controller_' . Config::get('error_controller'),
                'action_500'
            ),
            array(
                $errno,
                $errstr,
                $errfile,
                $errline,
                $errcontext,
            )
        );
    }

    public static function shutdown() {
        $error = error_get_last();
        if ($error['type'] == 1) {
            call_user_func_array(
                array(
                    'Controller_' . Config::get('error_controller'),
                    'action_500'
                ),
                array(
                    $error,
                )
            );
        }
    }
}

set_error_handler(
    array(
        'Error',
        'handler'
    )
);

register_shutdown_function(
    array(
        'Error',
        'shutdown'
    )
);
