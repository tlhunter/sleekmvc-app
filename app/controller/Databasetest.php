<?php
namespace App;

class Controller_Databasetest extends \Sleek\Controller_Base {
    function preAction() {
        $this->people = new Model_People; // This would be useful if multiple controller action's used it
    }

    function action_index() {
        $data['first_people_results'] = $this->people->getAllPeopleManual();
        $data['query1'] = $this->people->lastQueryPassThru();

        if (!$personId = $this->people->newPerson('Ted', 1)) {
            die("There was an error creating a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }

        $data['query2'] = $this->people->lastQueryPassThru();
        $data['second_people_results'] = $this->people->getAllPeopleManual();

        if (!$this->people->editPerson('Teddy', 2, $personId)) {
            die("There was an error editing a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }

        $data['query3'] = $this->people->lastQueryPassThru();
        $data['third_people_results'] = $this->people->getAllPeopleManual();

        if (!$this->people->kill($personId)) {
            die("There was an error deleting a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }

        $data['query4'] = $this->people->lastQueryPassThru();
        $data['fourth_people_results'] = $this->people->getAllPeopleManual();

        \Sleek\View::render('database-test', $data);
    }
}
