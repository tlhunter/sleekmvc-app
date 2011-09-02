<?php
class Autoload {

    static protected $cascade = array('app', 'system');

    static public function loader($className) {
        foreach(self::$cascade AS $path) {
            $filename = $path . '/' . lcfirst(str_replace('_', '/', $className)) . '.php';
            if (file_exists($filename)) {
                include_once($filename);
                if (class_exists($className)) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
}

spl_autoload_register('Autoload::loader');
