<?php
namespace App;

/**
 * This is the Home controller, and is executed by default when someone browses to the root site path
 * @throws \Exception
 *
 */
class Controller_Home extends Controller_HasLayout {
    /**
     * This is the main page of the website.
     * @return void
     */
    public function action_index() {
        $this->page_data['content'] = \Sleek\View::render('pages/home', $this->page_data, TRUE);
    }

    /**
     * This is the page the user hits when submitting a URL via their browser.
     * @return void
     */
    public function action_submit() {
        $url = $this->request->post('url');
        $this->page_data['code'] = FALSE;

        if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
            $EzLink = new Model_EzLink();
            $id = $EzLink->insertUrl($url);
            $this->page_data['code'] = Model_EzLink::integerToCode($id);
        }

        $this->page_data['content'] = \Sleek\View::render('pages/submit', $this->page_data, TRUE);
    }

    public function action_test($arguments) {
        echo "<pre>";
        echo "Arguments:\n";
        var_dump($arguments);
        echo "\n\nTest Param:\n";
        $gets = $this->request->get('testParam');
        var_dump($gets);
        echo "\n\nGlobal GET:\n";
        var_dump($_GET);
        echo "\n\nSERVER:\n";
        var_dump($_SERVER);
        echo "</pre>";
        exit();
    }

    public function action_view_user($arguments) {
        die($arguments['user_id']);
    }

}
