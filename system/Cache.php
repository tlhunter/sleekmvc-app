<?php
namespace SleekMVC;

class Cache {
    protected static $_instance         = NULL;

    private function __construct() {}
    private function __clone() {}

    /**
     * Returns a new cache (doesn't need to be the one defined in the config file). Cache doesn't keep a copy of this instance.
     * @param $type string
     * @return Cache_APC|Cache_File|Cache_Memcache
     */
    public static function factory($type) {
        return self::buildCache($type);
    }

    /**
     * Returns the "Default" cache, described in the config file
     * @return Cache_APC|Cache_File|Cache_Memcache
     */
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = self::buildCache(Config::get('cache_method'));
        }
        return self::$_instance;
    }

    protected static function buildCache($type) {
        switch($type) {
        case 'memcache':
            return new \SleekMVC\Cache\Memcache(Config::get('cache_expiretime'), Config::get('cache_memcache_servers'));
            break;
        case 'apc':
            return new \SleekMVC\Cache\APC(Config::get('cache_expiretime'));
            break;
        case 'file':
            return  new \SleekMVC\Cache\File(Config::get('cache_expiretime'), Config::get('cache_file_directory'));
            break;
        }
        return NULL;

    }
}
