<?php
class Session {
    protected $_data = array();

    function __construct(&$session) {
        $this->_data = $session;
    }

    function __get($key) {
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }
        return NULL;
    }

    function __set($key, $value) {
        $this->_data[$key] = $value;
    }
}
