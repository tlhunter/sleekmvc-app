<?php
namespace App;

class Controller_Error extends \Sleek\Controller_Base {

    public function action_404() {
        $this->response->status(404);
        \Sleek\View::render('error/404');
    }

    public function action_500($number = FALSE, $text = '', $filename = '', $linenumber = 0, $context = '') {
        $data = array(
            'number' => $number,
            'text' => $text,
            'filename' => $filename,
            'linenumber' => $linenumber,
            'context' => $context,
        );
        \Sleek\View::render('error/500', $data);
        return TRUE;
    }
}
