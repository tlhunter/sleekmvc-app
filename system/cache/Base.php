<?php
interface Cache_Base {
    /**
     * Sets data $cache->set($key, $value)
     * @param $key string
     * @param $value mixed
     */
    function set($key, $value);

    /**
     * Gets data $cache->get($key)
     * @param $key string
     */
    function get($key);

    /**
     * Sets data $cache->key = $value
     */
    function __set($key, $value);

    /**
     * Gets data $value = $cache->key
     */
    function __get($key);

    /**
     * Replaces data with a new value $cache->replace($key, $value)
     * @param $key string
     * @param $value mixed
     */
    function replace($key, $value);

    /**
     * Deletes a key from the cache $cache->delete($key)
     * @param $key string
     */
    function delete($key);
}
