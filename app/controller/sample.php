<?php

class controllerName_ctrl extends BaseCtrl {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$query = "SELECT * FROM table";
		$result = $db->query($query);
		$numrows = $db->num_rows($result);

		while($row = $db->fetch) {
			echo $row['something'] . '<br>' . $row['somerow'] . '<br>';
		}

		echo $numrows . 'Returned from ' . $query;
	}
}