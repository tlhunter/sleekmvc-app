<?php
class Controller_Error extends Controller_Base {

    public function action_404() {
        header("HTTP/1.1 404 Not Found");
        View::render('error/404');
    }

    public function action_500($errno = FALSE, $errstr = '', $errfile = '', $errline = 0, $errcontext = '') {
        $data = array(
            'errno' => $errno,
            'errstr' => $errstr,
            'errfile' => $errfile,
            'errline' => $errline,
            'errcontext' => $errcontext,
        );
        View::render('error/500', $data);
        return TRUE;
    }
}
