<?php
class Request {
    protected $get      = array();
    protected $post     = array();
    protected $cookie   = array();
    protected $server   = array();
    protected $url      = array();

    function __construct($get, $post, $cookie, $server) {
        $this->url['controller']   = 'Controller_' . (isset($_GET['controller']) ? ucfirst($_GET['controller']) : Config::get('default_controller'));
        $this->url['action']       = 'action_' . (isset($_GET['action']) ? $_GET['action'] : Config::get('default_action'));
        $this->url['arguments']    = isset($_GET['arg']) ? $_GET['arg'] : array();

        unset($_GET['controller'], $_GET['action'], $_GET['arg']); // This data shouldn't be available to GET

        $this->get = $get;
        $this->post = $post;
        $this->cookie = $cookie;
        $this->server = $server;
    }

    function get($key) {
        if (isset($this->get[$key])) {
            return $this->get[$key];
        }
        return NULL;
    }

    function post($key) {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        }
        return NULL;
    }

    function cookie($key) {
        if (isset($this->cookie[$key])) {
            return $this->cookie[$key];
        }
        return NULL;
    }

    function server($key) {
        if (isset($this->server[$key])) {
            return $this->server[$key];
        }
        return NULL;
    }

    function urlController() {
        return $this->url['controller'];
    }

    function urlAction() {
        return $this->url['action'];
    }

    function urlArguments($index = NULL) {
        if ($index != NULL) {
            if (isset($this->url['arguments'][$index])) {
                return $this->url['arguments'][$index];
            } else {
                return NULL;
            }
        }
        return $this->url['arguments'];
    }
}
