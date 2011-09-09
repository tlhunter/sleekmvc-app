<?php
class Cache_APC implements Cache_Base {
    protected $expireTime = 0;

    public function __construct($expireTime) {
        $this->expireTime = (int) $expireTime;
    }

    public function __set($key, $value) {
        return $this->set($key, $value);
    }

    public function __get($key) {
        return $this->get($key);
    }

    public function set($key, $value) {
        return apc_store($key, $value, $this->expireTime);
    }

    public function get($key) {
        return apc_fetch($key);
    }

    public function replace($key, $value) {
        apc_delete($key);
        return apc_store($key, $data, $this->expireTime);
    }

    public function delete($key) {
        return apc_delete($key);
    }
}
