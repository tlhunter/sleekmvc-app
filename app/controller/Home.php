<?php
class Controller_Home extends Controller_Base {
	
    function preAction() {
        // This function is run before your action is run. Think of it like a constructor.
        // You don't need to have it if you don't plan on using it.
        // Put any code in here you want to be run for every action in this controller.
        parent::preAction(); // keep this here so that the parent's preAction() is run.
    }

    // This page would load when we browse to /home/index or /home or /
	function action_index() {
		$data['title'] = 'Hello World!';
        $data['something'] = $this->request->get('something');

        if (!$this->session->random) {
            $this->session->random = rand(1, 1000);
        }
        $data['random'] = $this->session->random;

        $data2['title'] = 'Hallo Welt!';
        $data2['content'] = View::render('hello', $data, TRUE);

        View::render('layout/main', $data2);
	}
	
    // This page would load when we browse to /home/register
	function action_register($username = '', $email = '', $age = 0) {
		echo "register!";
        var_dump($username);
        var_dump($email);
        var_dump($age);
	}

    function postAction() {
        // This is run similar to a deconstructor, again it is not required to have it.
        parent::postAction();
    }
	
}
