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

    function GET($key) {
        if (isset($this->get[$key])) {
            return $this->get[$key];
        }
        return NULL;
    }

    function POST($key) {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        }
        return NULL;
    }

    function COOKIE($key) {
        if (isset($this->cookie[$key])) {
            return $this->cookie[$key];
        }
        return NULL;
    }

    function SERVER($key) {
        if (isset($this->server[$key])) {
            return $this->server[$key];
        }
        return NULL;
    }
}
