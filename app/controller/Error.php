<?php
namespace App\Controller;

class Error extends \SleekMVC\Controller\Base {

    public function action_404() {
        $this->response->status(404);
        \SleekMVC\View::render('error/404');
    }

    public function action_500($number = FALSE, $text = '', $filename = '', $linenumber = 0, $context = '') {
        $data = array(
            'number' => $number,
            'text' => $text,
            'filename' => $filename,
            'linenumber' => $linenumber,
            'context' => $context,
        );
        \SleekMVC\View::render('error/500', $data);
        return TRUE;
    }
}
