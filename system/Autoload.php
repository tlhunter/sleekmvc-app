<?php
namespace SleekMVC;

class Autoload {

    /**
     * Handles PHP autoloading thanks to spl_autoload_register()
     * @param string $className The name of the class to be loaded
     * @return bool Whether or not the class was located
     */
    static public function loader($className) {
        $classNameParts = explode('\\', $className);
        $rootDir = '';
        $namespaced = TRUE;
        if (count($classNameParts) === 1) { # no namespace
            $rootDir = VENDOR_DIR;
            $namespaced = FALSE;
            $filename = $rootDir . $className . '.php';
        } else {
            if ($classNameParts[0] == 'SleekMVC') {
                $rootDir = SYSTEM_DIR;
                array_shift($classNameParts);
            } else if ($classNameParts[0] == 'App') {
                $rootDir = APP_DIR;
                array_shift($classNameParts);
            } else {
                $rootDir = VENDOR_DIR;
            }

            $filename = $rootDir;

            for($i = 0; $i < count($classNameParts) - 1; $i++) {
                $filename .= lcfirst($classNameParts[$i]) . '/';
            }
            $filename .= $classNameParts[$i++] . '.php';
        }

        if (file_exists($filename)) {
            include_once($filename);
            if (class_exists($className) || interface_exists($className)) {
                return TRUE;
            }
        }

        throw new Exception\ClassNotFound($className);
    }

    static public function register() {
        spl_autoload_register('\SleekMVC\Autoload::loader');
        ini_set('unserialize_callback_func', '\SleekMVC\Autoload::loader');
    }
}
