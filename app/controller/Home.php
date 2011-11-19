<?php
namespace App;

/**
 * This is the Home controller, and is executed by default when someone browses to the root site path
 * @throws \Exception
 *
 */
class Controller_Home extends \Sleek\Controller_Base {

    /**
     * This controller shows how to cache values, and this variable represents that cache
     * @var \Sleek\Cache
     */
    protected $cache;

    /**
     * This function is executed once per page execution, and is run before the requested action
     * Think of it as a helpful place to put code which you want to run regardless of which action
     * a user requests. It is not required but is nice to have.
     * @return void
     */
    public function preAction() {
        $this->cache = \Sleek\Cache::getInstance();
    }

    /**
     * The index action is the default action of controllers (configurable in config.ini)
     * You can run this code by visiting /, /home, or /home/index
     * @return void
     */
    public function action_index() {
        // The $data array is what we use for storing view data. Each index of this array
        // will be accessible in the view we execute later. You don't have to name it $data
        // if you don't want to. The below variable will be called $title in the view file.
        $data['title'] = 'Hello World!';

        // Use the $request object in a controller for getting data from the user
        $data['something'] = $this->request->get('something');

        // If we don't already have this variable in the session, make one
        if (!$this->session->random) {
            $this->session->random = rand(1, 1000);
        }

        // If we haven't already cached a value, go ahead and do so
        if (!$this->cache->cachedValue) {
            $this->cache->cachedValue = time();
        }

        // Here we set the values from above to our view array
        $data['random'] = $this->session->random;
        $data['cachedDate'] = $this->cache->cachedValue;

        // This is another array. We'll be using two since we want to render two view files
        $data2['title'] = 'Hallo Welt!';

        // Here we are rendering a view file and returning it as a string. This allows us to
        // have 'views inside views'. The view file we load will be APP_PATH/view/hello.php
        $data2['content'] = \Sleek\View::render('hello', $data, TRUE);

        // Here we tell the response to load a view, and tell it what data to render
        $this->response->view('layout/main', $data2);
    }
    
    /**
     * You can have as many actions in a controller as you want.
     * This page is accessible via /home/register only.
     * The third, fourth, and fifth URL parameters are passed in as arguments.
     * You'll usually want to provide default values for these arguments.
     * @param string $username
     * @param string $email
     * @param int $age
     * @return void
     */
    public function action_register($username = '', $email = '', $age = 0) {
        echo "register!";
        $people = new Model_People;
        if ($id = $people->newPerson('test')) {
            echo "New person was created! Their id is $id.";
        } else {
            echo "Error creating person. Error is {$people->lastErrorPassThru()}.";
        }
    }

    /**
     * This page is loaded when you visit /home/people
     * @return void
     */
    public function action_people() {
        $people = new Model_People;
        $peopleList = $people->getAllPeopleSimple();
        $data['people'] = $peopleList;
        $this->response->view('people', $data);
    }

    /**
     * This action is executed when you visit /home/emailtest
     * It generates and sends an email.
     * @return void
     */
    public function action_emailtest() {
        $email = new \Sleek\Email;
        $email->setRecipient('user@example.com')
            ->setSubject('This is a test email from Sleek')
            ->setTypeHtml()
            ->setBody('<em>Hey there</em>, how is it <strong>going</strong>?')
            ->setSender('user@example.com')
            ->debug()
            ->send();
    }

    /**
     * This function is executed once per page load after the requested action has run
     * It is not needed, but can be helpful
     * @return void
     */
    public function postAction() {

    }

    /**
     * This function is like a per-controller 404 action. But, don't think of it as
     * being useful for just catching 404's. You can use it for cool things like a
     * short URL service. Think example.com/product/a7fc3
     * @param string $argument1
     * @param string $argument2
     * @param string $argument3
     * @return void
     */
    public function noAction($argument1 = '', $argument2 = '', $argument3 = '') {
        $requestedAction = $this->request->urlAction();
        echo "You requested the $requestedAction action of the Home controller, which doesn't exist.";
    }
    
}
