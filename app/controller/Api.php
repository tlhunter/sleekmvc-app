<?php
namespace App;

/**
 * This controller has two actions. The first one (index) is used for showing information to
 * the browser. A user navigates here and reads information. This action will require use of
 * the layout. The second action is the API URL, used when a program is making a request to
 * the app to generate a short URL. That request doesn't need the layout, so notice the
 * auto_render_layout attribute we set to FALSE. Checkout Controller_HasLayout for more
 * details.
 */
class Controller_Api extends Controller_HasLayout {

    /**
     * Browser visits /api
     * @return void
     */
    public function action_index() {
        // Here, we render the views/pages/api.php view file, pass it in the data array, and
        // return the data as a string to stick back into the data array as the layout view's
        // $content variable.
        $this->page_data['content'] = \Sleek\View::render('pages/api', $this->page_data, TRUE);
    }

    /**
     * Program visits /api/create?url=http://www.example.com
     * @return void
     */
    public function action_create() {
        // Disables the layout stuff
        $this->auto_render_layout = FALSE;

        // Get the ?url= parameter
        $url = $this->request->get('url');

        if (!$url) {
            echo "ERROR: Empty URL";
        } else if (!filter_var($url, FILTER_VALIDATE_URL)) {
            echo "ERROR: Invalid URL";
        } else {
            $EzLink = new Model_EzLink();
            $id = $EzLink->insertUrl($url);
            // Controllers shouldn't really output directly, but it seems like a waste of a view file otherwise
            echo 'http://' . $this->request->server('HTTP_HOST') . '/link/' . Model_EzLink::integerToCode($id);
        }
    }
}
