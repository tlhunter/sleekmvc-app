<?php
namespace SleekMVC\Cache;

class File implements Base {
    protected $directory            = NULL;
    protected $expireTime           = 0;

    public function __construct($expireTime, $directory) {
        $this->directory            = $directory;
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
        if (!file_exists($filename)) {
            return NULL;
        }
        $data = file_get_contents($filename);
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
        if (!file_exists($filename)) {
            return FALSE;
        }
        return @unlink($filename);
    }

    private function getFileName($key) {
        $key = (string) $key;
        return $this->directory . md5($key) . '.cache';
    }
}
