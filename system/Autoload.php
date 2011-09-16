<?php
namespace SleekMVC;

class Autoload {
    /**
     * The list of directories to check for our classes, application > system
     * @var array
     */
    static protected $fallback = array(
        FALSE       => 'app',
        ''          => 'app/vendor',
        'SleekMVC'  => 'system'
    );

    /**
     * Handles PHP autoloading thanks to spl_autoload_register()
     * @param string $className The name of the class to be loaded
     * @return bool Whether or not the class was located
     */
    static public function loader($className) {
        $classNameParts = explode('\\', $className);
        foreach(self::$fallback AS $namespace => $path) {
            $filename = $path . '/' . lcfirst(str_replace('\\', '/', $className)) . '.php';
            if (file_exists($filename)) {
                include_once($filename);
                if (class_exists($className) || interface_exists($className)) {
                    return TRUE;
                }
            }
        }
        throw new Exception\ClassNotFound($className);
    }

    static public function register() {
        spl_autoload_register('\SleekMVC\Autoload::loader');
        ini_set('unserialize_callback_func', '\SleekMVC\Autoload::loader');
    }
}
