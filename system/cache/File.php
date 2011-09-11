<?php
class Cache_File implements Cache_Base {
    protected $directory            = NULL;
    protected $cacheTime            = 0;

    public function __construct($expireTime, $directory) {
        $this->cacheDirectory       = $directory;
        $this->expireTime           = (int) $expireTime;
    }

    public function __set($key, $value) {
        return $this->set($key, $value);
    }

    public function __get($key) {
        return $this->get($key);
    }

    public function set($key, $value) {
        $filename = $this->getFileName($key);
        $dataSerialized = serialize($value);
        $fh = fopen($filename, 'w');
        if (!$fh) {
            return FALSE;
        }
        fwrite($fh, $dataSerialized);
        fclose($fh);
        return TRUE;
    }

    public function get($key) {
        $filename = $this->getFileName($key);
        $data = @file_get_contents($filename);
        if (!$data) {
            return NULL;
        }
        return unserialize($data);
    }

    public function replace($key, $value) {
        return $this->set($key, $value);
    }

    public function delete($key) {
        $filename = $this->getFileName($key);
        return @unlink($filename);
    }

    private function getFileName($key) {
        return $this->directory . md5($key) . '.json';
    }
}
