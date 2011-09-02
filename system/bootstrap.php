<?php
require_once("system/autoload.php");
require_once("app/config.php");

$controller = isset($_GET['controller']) ? $_GET['controller'] : SYS_HOME_CONTROLLER;
$action = isset($_GET['action']) ? $_GET['action'] : SYS_DEFAULT_METHOD;

$controller_action_arguments = $_GET['arg'];

$controllerClassName = "Controller_$controller";
$controller = new $controllerClassName;
call_user_func_array(array($controller, $action), $controller_action_arguments);

if (DB_REQUIRED)
	$sleek->initDatabase(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
