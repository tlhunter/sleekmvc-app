<?php
class SleekMVC {
	private $db;
	private $controller;
	private $method;
	
	function __construct($controller, $method) {
		$this->controller = $controller;
		$this->method = $method;
		if (DB_REQUIRED) {
			include_once("app/system/database.php");
			$this->db = New db(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
			$this->db->db_pconnect();
			$this->db->select_db(DB_DATABASE);
		} else {
			$this->db = FALSE;
		}
		
		$controller_file = "app/controller/$controller.php";

		if (file_exists($controller_file)) {
			require_once($controller_file);
			$controller_class = "{$this->controller}_ctrl";
			$controller_object = new $controller_class();
			call_user_func(
				array(
					$controller_class,
					$this->method
					)
				);

		} else {
			require_once("app/controller/404.php");
			#die();
		}

		# instantiate class
		# check if method exists
		# if not run a 404
	}
}