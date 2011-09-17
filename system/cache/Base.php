<?php
namespace Sleek;

interface Cache_Base {
    /**
     * Sets data $cache->set($key, $value)
     * @param $key string
     * @param $value mixed
     */
    public function set($key, $value);

    /**
     * Gets data $cache->get($key)
     * @param $key string
     */
    public function get($key);

    /**
     * Sets data $cache->key = $value
     */
    public function __set($key, $value);

    /**
     * Gets data $value = $cache->key
     */
    public function __get($key);

    /**
     * Replaces data with a new value $cache->replace($key, $value)
     * @param $key string
     * @param $value mixed
     */
    public function replace($key, $value);

    /**
     * Deletes a key from the cache $cache->delete($key)
     * @param $key string
     */
    public function delete($key);
}
