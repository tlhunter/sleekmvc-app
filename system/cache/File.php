<?php
class Cache_File implements Cache_Base {
    protected $directory            = NULL;
    protected $cacheTime            = 0;
    public function __construct($directory, $cacheTime) {
        $this->cacheDirectory       = $directory;
        $this->expireTime           = (int) $expireTime;
    }

}
