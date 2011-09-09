<?php
class Cache {
    static protected $_instance     = NULL;
    static protected $cacheMethod   = NULL;
    static protected $cache         = NULL;

    protected function __construct() {
        self::$cacheMethod = Config::get('cache_method');

        switch(self::$cache) {
        case 'memcache':
            self::$cache = new Cache_Memcache(Config::get('cache_memcache_servers'), Config::get('cache_expiretime'));
            break;
        case 'apc':
            self::$cache = new Cache_APC(Config::get('cache_expiretime'));
            break;
        case 'file':
            self::$cache = new Cache_File(Config::get('cache_file_directory'), Config::get('cache_expiretime'));
            break;
        default:
            throw new Exception();
        }
    }

    public function getInstance() {

    }

    public function getCache() {
        return self::$cache;
    }
}
