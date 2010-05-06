<?php

class sample_ctrl extends BaseCtrl {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		/*
		$query = "SELECT * FROM table";
		$result = $this->db->query($query);
		$numrows = $this->db->num_rows($result);

		while($row = $this->db->fetch) {
			echo $row['something'] . '<br>' . $row['somerow'] . '<br>';
		}

		echo $numrows . 'Returned from ' . $query;
		*/
		echo "hi";
	}
	
	function register() {
		echo "register!";
	}
}