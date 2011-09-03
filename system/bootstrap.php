<?php
require_once(SYSTEM_DIR . "Autoload.php");
require_once(SYSTEM_DIR . "Error.php");
require_once(APP_DIR . "controller/Error.php");

Config::load('config');

$controller = isset($_GET['controller']) ? $_GET['controller'] : Config::get('default_controller');
$action = 'action_' . (isset($_GET['action']) ? $_GET['action'] : Config::get('default_action'));

$controller_action_arguments = isset($_GET['arg']) ? $_GET['arg'] : array();

$controllerClassName = "Controller_$controller";
$controller = new $controllerClassName;
if (method_exists($controller, $action)) {
    call_user_func_array(
        array(
            $controller,
            $action
        ),
        $controller_action_arguments
    );
} else {
    call_user_func_array(
        array(
            'Controller_' . Config::get('error_controller'),
            'action_404'
        ),
        array(
            $controllerClassName,
            $action,
            $controller_action_arguments
        )
    );
}

