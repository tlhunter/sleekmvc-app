<?php
include_once("app/config.php");

if (DB_REQUIRED) {
	include_once("app/system/database.php");
	$db = New db(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	$db->db_pconnect();
	$db->select_db(DB_DATABASE);
}

include_once("app/system/base_model.php");
include_once("app/system/base_view.php");
include_once("app/system/base_controller.php");
include_once("app/system/base_layout.php");

$controller = isset($_GET['controller']) ? $_GET['controller'] : SYS_HOME_CONTROLLER;
$method = isset($_GET['method']) ? $_GET['method'] : SYS_DEFAULT_METHOD;

$controller_file = "app/controller/$controller.php";

if (file_exists($controller_file)) {
	require_once($controller_file);
} else {
	require_once("app/controller/404.php");
	die();
}

# instantiate class
# check if method exists
# if not run a 404