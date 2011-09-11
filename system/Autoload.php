<?php
class Autoload {
    /**
     * The list of directories to check for our classes, application > system
     * @var array
     */
    static protected $fallback = array('app', 'system');

    /**
     * Handles PHP autoloading thanks to spl_autoload_register()
     * @param string $className The name of the class to be loaded
     * @return bool Whether or not the class was located
     */
    static public function loader($className) {
        foreach(self::$fallback AS $path) {
            $filename = $path . '/' . lcfirst(str_replace('_', '/', $className)) . '.php';
            if (file_exists($filename)) {
                include_once($filename);
                if (class_exists($className) || interface_exists($className)) {
                    return TRUE;
                }
            }
        }
        throw new ExceptionClassNotFound($className);
    }
}

spl_autoload_register('Autoload::loader');

class ExceptionClassNotFound extends Exception {};

ini_set('unserialize_callback_func', 'Autoload::loader');
