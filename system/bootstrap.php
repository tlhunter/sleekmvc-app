<?php
include_once("app/config.php");
include_once("system/base.php");
include_once("system/base_model.php");
include_once("system/base_controller.php");
include_once("system/base_layout.php");

$controller = isset($_GET['controller']) ? $_GET['controller'] : SYS_HOME_CONTROLLER;
$method = isset($_GET['method']) ? $_GET['method'] : SYS_DEFAULT_METHOD;

$sleek = New SleekMVC();
if (DB_REQUIRED)
	$sleek->initDatabase(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($sleek->setController($controller)) {
	$sleek->setMethod($method);
	$sleek->execute();
}
