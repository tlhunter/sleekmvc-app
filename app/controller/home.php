<?php
class home_ctrl extends BaseCtrl {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$data['message'] = 'Test Message';
		$this->load->view('basic', $data);
		
		
	}
	
	function register() {
		echo "register!";
	}
	
	function error_404() {
		echo "This don't exist!";
	}
}