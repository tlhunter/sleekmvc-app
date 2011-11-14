<?php
namespace App;

/**
 * This controller is executed when you visit /databasetest/*
 */
class Controller_Databasetest extends \Sleek\Controller_Base {
    /**
     * @var Model_People
     */
    protected $people;

    /**
     * This function just instantiates a people model. If we had multiple actions which all use
     * a people model it would be useful, but for this example it's just for show.
     * @return void
     */
    public function preAction() {
        $this->people = new Model_People;
    }

    /**
     * url: /databasetest or /databasetest/index
     * @return void
     */
    public function action_index() {
        $data['first_people_results'] = $this->people->getAllPeopleManual();
        $data['query1'] = $this->people->lastQueryPassThru();

        if (!$personId = $this->people->newPerson('Ted', 1)) {
            // Die'ing is bad. You'd probably want to display an error using a view.
            die("There was an error creating a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }

        $data['query2'] = $this->people->lastQueryPassThru();
        $data['second_people_results'] = $this->people->getAllPeopleManual();

        if (!$this->people->editPerson('Teddy', 2, $personId)) {
            // Die'ing is bad. You'd probably want to display an error using a view.
            die("There was an error editing a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }

        $data['query3'] = $this->people->lastQueryPassThru();
        $data['third_people_results'] = $this->people->getAllPeopleManual();

        if (!$this->people->kill($personId)) {
            // Die'ing is bad. You'd probably want to display an error using a view.
            die("There was an error deleting a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }

        $data['query4'] = $this->people->lastQueryPassThru();
        $data['fourth_people_results'] = $this->people->getAllPeopleManual();

        $this->response->view('database-test', $data);
    }
}
