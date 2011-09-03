<?php
class Controller_Home extends Controller_Base {
	
	function action_index() {
		$data['title'] = 'Hello World!';
        $data['something'] = $this->request->GET('something');

        $data2['title'] = 'Hallo Welt!';
        $data2['content'] = View::render('hello', $data, TRUE);

        View::render('layout/main', $data2);
	}
	
	function action_register($username = '', $email = '', $age = 0) {
		echo "register!";
        var_dump($username);
        var_dump($email);
        var_dump($age);
	}
	
}
