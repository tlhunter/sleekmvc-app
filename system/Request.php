<?php
class Request {
    protected $get      = array();
    protected $post     = array();
    protected $cookie   = array();
    protected $server   = array();

    function __construct($get, $post, $cookie, $server) {
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
}
