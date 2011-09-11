<?php
class Controller_Error extends Controller_Base {

    public function action_404() {
        header("HTTP/1.1 404 Not Found");
        View::render('error/404');
    }

    public function action_500($number = FALSE, $text = '', $filename = '', $linenumber = 0, $context = '') {
        $data = array(
            'number' => $number,
            'text' => $text,
            'filename' => $filename,
            'linenumber' => $linenumber,
            'context' => $context,
        );
        View::render('error/500', $data);
        return TRUE;
    }
}
