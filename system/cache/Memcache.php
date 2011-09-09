<?php
class Cache_Memcache implements Cache_Base {
    protected $servers              = array();
    protected $connectedServers     = array();
    protected $memcache             = NULL;
    protected $expireTime           = 0;

    function __construct($servers, $expireTime) {
        $this->memcache             = new Memcache;
        $this->servers              = $servers;
        $this->expireTime           = (int) $expireTime;
    }

    protected function connect() {
        foreach ($this->servers as $server) {
            list($server, $port) = explode($server, ':');
            if ($this->memcache->addServer($server, $port)) {
                $this->connectedServers[] = $server;
            }
        }
        if (!$this->servers) {
            throw new Exception;
        }
    }

    public function __set($key, $value) {
        return $this->set($key, $value);
    }

    public function __get($key) {
        return $this->get($key);
    }

    public function set($key, $value) {
        return $this->memcache->set($key, $value, 0, $this->expireTime);
    }

    public function get($key) {
        return $this->memcache->get($key);
    }

    public function replace($key, $value) {
        return $this->memcache->replace($key, $value, 0, $this->expireTime);
    }

    public function delete($key) {
        return $this->memcache->delete($key, 0);
    }

}
