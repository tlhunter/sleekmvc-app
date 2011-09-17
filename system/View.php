<?php
namespace Sleek;

class View {
    static public function render($filename, $data = array(), $string = FALSE) {
        $view_path = APP_DIR . "view/$filename.php";
        if (file_exists($view_path)) {
            extract($data);
            if ($string) { ob_start(); }
            include($view_path);
            if ($string) { return ob_get_clean(); }
            return TRUE;
        }
        return FALSE;
    }
}
