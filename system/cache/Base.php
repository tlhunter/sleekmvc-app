<?php
interface Cache_Base {
    function set($key, $value);
    function get($key);
    function __set($key, $value);
    function __get($key);
    function replace($key, $value);
    function delete($key);

}
