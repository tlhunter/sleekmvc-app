<?php
namespace App;

/**
 * This controller is used when your app generates an error. It allows you to handle
 * various types of errors an app usually has, such as 404 and 500 errors.
 */
class Controller_Error extends \Sleek\Controller_Base {

    /**
     * Use this for a custom 404 error page. Note that it won't grab all 404's
     * @return void
     */
    public function action_404() {
        $this->response->status(404);
        $this->response->view('error/404');
    }

    /**
     * Use this for a custom 500 error page. Note that depending on how severe you blow up the
     * application, it may not always work.
     * @param bool $number
     * @param string $text
     * @param string $filename
     * @param int $linenumber
     * @param string $context
     * @return void
     */
    public function action_500($number = FALSE, $text = '', $filename = '', $linenumber = 0, $context = '') {
        $this->response->status(500);
        $data = array(
            'number' => $number,
            'text' => $text,
            'filename' => $filename,
            'linenumber' => $linenumber,
            'context' => $context,
        );
        $this->response->view('error/500', $data);
    }

    /**
     * Use this for throwing PHP fatal errors.
     * @param string $error
     * @return void
     */
    public function action_fatal($error) {
        $this->response->status(500);
        $data['error'] = $error;
        $this->response->view('error/fatal', $data);
    }
}
