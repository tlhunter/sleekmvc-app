<?php
class Autoload {
    static public function loader($className) {

        $filename = "app/" . str_replace('_', '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }

        $filename = "system/" . str_replace('_', '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }

        return FALSE;
    }
}

spl_autoload_register('Autoload::loader');