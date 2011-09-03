<?php
class Controller_Error extends Controller_Base {

    function action_404($c, $a, $ar) {
        echo "404: Tried to load controller {$c}, action {$a}.<br />";
    }

    static function action_500($errno = FALSE, $errstr = '', $errfile = '', $errline = 0, $errcontext = '') {
        echo "oops! $errno : $errstr\n";
        return TRUE;
    }
}
