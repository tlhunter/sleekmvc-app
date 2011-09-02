<?php
class Controller_Sample extends Controller_Base {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		echo "hi";
		$query = "SELECT * FROM table";
		$result = $this->db->query($query);
		$numrows = $this->db->num_rows($result);

		while($row = $this->db->fetch) {
			echo $row['something'] . '<br>' . $row['somerow'] . '<br>';
		}

		echo $numrows . 'Returned from ' . $query;
		
		
	}
	
	function register() {
		echo "register!";
	}
	
	function error_404() {
		echo "This don't exist!";
	}
}
