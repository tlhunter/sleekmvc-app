<?php
class View {
    static public function render($filename, $data) {
        $view_path = APP_DIR . "/view/$filename.php";
        if (file_exists($view_path)) {
            extract($data);
            return include($view_path);
        }
        return FALSE;
    }
}
