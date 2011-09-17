<?php
namespace Sleek;

class Autoload {

    /**
     * Handles PHP autoloading thanks to spl_autoload_register()
     * @param string $className The name of the class to be loaded
     * @return bool Whether or not the class was located
     */
    static public function loader($className) {
        list($namespace, $classNameParts) = explode('\\', $className);
        $rootDir = '';
        if (!$classNameParts) { # no namespace
            $rootDir = VENDOR_DIR;
            $filename = $rootDir . $namespace . '.php';
        } else {
            $classNameParts = explode('_', $classNameParts);
            if ($namespace == 'Sleek') {
                $rootDir = SYSTEM_DIR;
            } else if ($namespace == 'App') {
                $rootDir = APP_DIR;
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

        throw new Exception_ClassNotFound($className);
    }

    static public function register() {
        spl_autoload_register('\Sleek\Autoload::loader');
        ini_set('unserialize_callback_func', '\Sleek\Autoload::loader');
    }
}
