<?php
namespace App;

/**
 * This controller class has some useful code for displaying a page layout. You can extend
 * this class instead of \Sleek\Controller_Base to get access to this layout code in your
 * controllers. Make sure you call parent::preAction() and parent::postAction in your
 * extending controller preAction and postAction methods (if they exist). Also, if some of
 * your actions in a controller need a layout and others don't, you can set the
 * auto_render_layout attribute to FALSE.
 *
 * Also, this controller has no action's of it's own, so it doesn't have any 'pages' available
 * for the browser to hit. It is only useful for other classes to extend. For this reason I
 * have made the class abstract.
 */
abstract class Controller_HasLayout extends \Sleek\Controller_Base {

    /**
     * A common array for storing view data
     * @var array
     */
    protected $page_data = array();

    /**
     * Whether or not to execute the layout
     * @var bool
     */
    protected $auto_render_layout = TRUE;

    /**
     * Runs before the action. Sets some default view variables.
     * @return void
     */
    public function preAction() {
        $this->page_data['title'] = 'EzLink';
        $this->page_data['server'] = $this->request->server('HTTP_HOST');
        $this->page_data['base_url'] = \Sleek\Config::get('base_url');
    }

    /**
     * Runs after the action. Executes the layout/main view file.
     * @return void
     */
    public function postAction() {
        if ($this->auto_render_layout) {
            $EzLink = new Model_EzLink();
            $this->page_data['count_urls'] = $EzLink->countUrls();
            $this->page_data['count_clicks'] = $EzLink->countClicks();
            $this->response->view('layout/main', $this->page_data);
        }
    }


}