<?php
require_once(SYSTEM_DIR . "/autoload.php");
require_once(APP_DIR . "/config.php");

$controller = isset($_GET['controller']) ? $_GET['controller'] : SYS_HOME_CONTROLLER;
$action = isset($_GET['action']) ? $_GET['action'] : SYS_DEFAULT_METHOD;
$action = 'action_' . $action;

$controller_action_arguments = isset($_GET['arg']) ? $_GET['arg'] : array();

$controllerClassName = "Controller_$controller";
$controller = new $controllerClassName;
if (method_exists($controller, $action)) {
    call_user_func_array(array($controller, $action), $controller_action_arguments);
} else {
    call_user_func_array(array('Controller_Error', 'action_404'), array($controllerClassName, $action, $controller_action_arguments));
}

