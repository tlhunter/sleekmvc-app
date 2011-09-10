<?php
class Controller_Home extends Controller_Base {
	
    function preAction() {
        // This function is run before your action is run. Think of it like a constructor.
        // You don't need to have it if you don't plan on using it.
        // Put any code in here you want to be run for every action in this controller.
        $this->cache = Cache::getInstance();
    }

    // This page would load when we browse to /home/index or /home or /
	function action_index() {
		$data['title'] = 'Hello World!';
        $data['something'] = $this->request->get('something');

        if (!$this->session->random) {
            $this->session->random = rand(1, 1000);
        }
        if (!$this->cache->cachedValue) {
            $this->cache->cachedValue = time();
        }

        $data['random'] = $this->session->random;
        $data['cachedDate'] = $this->cache->cachedValue;

        $data2['title'] = 'Hallo Welt!';
        $data2['content'] = View::render('hello', $data, TRUE);

        View::render('layout/main', $data2);
	}
	
    // This page would load when we browse to /home/register
	function action_register($username = '', $email = '', $age = 0) {
		echo "register!";
        $people = new Model_People;
        if ($id = $people->newPerson('test')) {
            echo "New person was created! Their id is $id.";
        } else {
            echo "Error creating person. Error is {$people->lastError()}.";
        }
	}

    // This pag would load when we browse to /home/people
    function action_people() {
        $people = new Model_People;
        $peopleList = $people->getPeople();
        $data['people'] = $peopleList;
        View::render('people', $data);
    }


    function postAction() {
        // This is run similar to a deconstructor, again it is not required to have it.
    }
	
}
