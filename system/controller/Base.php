<?php
namespace Sleek;
/**
 * Controller classes need to extend this base class.
 * This class provides common functionality useful to controllers
 * Using a preAction() and postAction() function in child classes is optional.
 */
abstract class Controller_Base {
    /**
     * Contains data from the client's request (GET, POST, COOKIE, SERVER)
     * @var Request
     */
    protected $request      = null;

    /**
     * Contains data useful for the response to the client (headers, etc.)
     * @var Response
     */
    protected $response     = null;

    /**
     * Contains a way to get and set Session variables
     * @var Session
     */
    protected $session      = null;

    /**
     * Instantiates the Request and Response variables (and Session if enabled in config file)
     */
    public function __construct() {
        $this->request = Request::getInstance();
        $this->response = Response::getInstance();

        // Use the 'use_sessions' setting to enable or disable the session class
        if (Config::get('use_sessions')) {
            $this->session = Session::getInstance();
        }
    }

    /**
     * This function is run before the controller action
     * @return NULL
     */
    public function preAction() { }

    /**
     * This function is run after the controller action
     * @return NULL
     */
    public function postAction() { }
}
