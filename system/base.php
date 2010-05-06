<?php
class SleekMVC {
	private $db;
	private $controller;
	private $controller_file;
	private $controller_class;
	private $controller_object;
	private $method;
	
	function __construct() {
		
	}
	
	function initDatabase($host, $user, $pass, $name) {
		include_once("system/database.php");
		$this->db = New db($host, $user, $pass, $name);
		$this->db->db_pconnect();
		$this->db->select_db($name);
	}
	
	function setController($controller) {
		$this->controller = $controller;
		$this->controller_file = "app/controller/$controller.php";
		if (file_exists($this->controller_file)) {
			require_once($this->controller_file);
			$this->controller_class = "{$this->controller}_ctrl";
			$this->controller_object = new $this->controller_class();
			return true;
		} else {
			require_once("app/controller/" . SYS_ERROR_CONTROLLER . ".php");
			return false;
		}
	}
	
	function setMethod($method) {
		if (method_exists($this->controller_class, $method)) {
			$this->method = $method;
			return TRUE;
		} else {
			$this->method = SYS_ERROR_METHOD;
			return FALSE;
		}
	}
	
	function execute() {
		call_user_func(
			array(
				$this->controller_class,
				$this->method
			)
		);
	}
}