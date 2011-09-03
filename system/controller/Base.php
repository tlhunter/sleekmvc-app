<?php
abstract class Controller_Base {
    protected $request      = null;
    protected $response     = null;
    protected $session      = null;

    public function __construct() {
        $this->request = new Request($_GET, $_POST, $_COOKIE, $_SERVER);

        if (Config::get('use_sessions')) {
            $this->session = new Session();
        }

        $this->response = new Response();
    }

    public function preAction() {

    }

    public function postAction() {

    }
}
