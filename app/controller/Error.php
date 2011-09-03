<?php
class Controller_Error extends Controller_Base {

    static function action_404($c, $a, $ar) {
        header("HTTP/1.1 404 Not Found");
        View::render('error/404');
    }

    static function action_500($errno = FALSE, $errstr = '', $errfile = '', $errline = 0, $errcontext = '') {
        echo $errstr;
        $data = array(
            'errno' => $errno,
            'srrstr' => $errstr,
            'errfile' => $errfile,
            'errline' => $errline,
            'errcontext' => $errcontext,
        );
        View::render('error/500', $data);
        return TRUE;
    }
}
