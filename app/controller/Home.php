<?php
class Controller_Home extends Controller_Base {
	
	function action_index() {
		$data['title'] = 'Hello World!';
        View::render('hello', $data);
	}
	
	function action_register($username, $email, $age) {
		echo "register!";
        var_dump($username);
        var_dump($email);
        var_dump($age);
	}
	
}
