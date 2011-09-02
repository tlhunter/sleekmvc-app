<?php
class Controller_Error extends Controller_Base {

    function action_404($c, $a, $ar) {
        echo "404: Tried to load controller {$c}, action {$a}.<br />";
    }

    function action_500($c, $a, $ar) {
        echo "500";
    }
}
