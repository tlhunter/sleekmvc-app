<?php
class Cache {
    static protected $cache         = NULL;

    private function __construct() {}
    private function __clone() {}

    /**
     * Returns a new cache (doesn't need to be the one defined in the config file). Cache doesn't keep a copy of this instance.
     * @param $type string
     * @return Cache_APC|Cache_File|Cache_Memcache
     */
    public function factory($type) {
        return self::buildCache($type);
    }

    /**
     * Returns the "Default" cache, described in the config file
     * @return Cache_APC|Cache_File|Cache_Memcache
     */
    public function getCache() {
        if (!self::$cache) {
            self::$cache = buildCache(Config::get('cache_method'));
        }
        return self::$cache;
    }

    protected function buildCache($type) {
        switch($type) {
        case 'memcache':
            return new Cache_Memcache(Config::get('cache_memcache_servers'), Config::get('cache_expiretime'));
            break;
        case 'apc':
            return new Cache_APC(Config::get('cache_expiretime'));
            break;
        case 'file':
            return  new Cache_File(Config::get('cache_file_directory'), Config::get('cache_expiretime'));
            break;
        }
        return NULL;

    }
}
