<?php
class Controller_Databasetest extends Controller_Base {
    function preAction() {
        $this->people = new Model_People; // This would be useful if multiple controller action's used it
    }

    function action_index() {
        echo "<h1>All People (Manually Selected)</h1>\n";
        $peopleManual = $this->people->getAllPeopleManual();
        echo $this->people->lastQueryPassThru(), "<br />\n";
        echo "<pre>";
        while ($person = $peopleManual->row()) {
            var_dump($person);
        }
        echo "</pre>";

        echo "<h1>All People (Simple Selected)</h1>\n";
        $peopleSimple = $this->people->getAllPeopleSimple();
        echo $this->people->lastQueryPassThru(), "<br />\n";
        echo "<pre>";
        while ($person = $peopleSimple->row()) {
            var_dump($person);
        }
        echo "</pre>";

        echo "<h1>Adding a new person</h1>\n";
        if (!$personId = $this->people->newPerson('Ted', 1)) {
            die("There was an error creating a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }
        echo $this->people->lastQueryPassThru(), "<br />\n";

        echo "<h1>Listing People</h1>\n";
        $peopleSimple = $this->people->getAllPeopleSimple();
        echo $this->people->lastQueryPassThru(), "<br />\n";
        echo "<pre>";
        while ($person = $peopleSimple->row()) {
            var_dump($person);
        }
        echo "</pre>";

        echo "<h1>Editing an existing person</h1>\n";
        if (!$this->people->editPerson('Teddy', 2, $personId)) {
            die("There was an error editing a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }
        echo $this->people->lastQueryPassThru(), "<br />\n";

        echo "<h1>Listing People</h1>\n";
        $peopleSimple = $this->people->getAllPeopleSimple();
        echo $this->people->lastQueryPassThru(), "<br />\n";
        echo "<pre>";
        while ($person = $peopleSimple->row()) {
            var_dump($person);
        }
        echo "</pre>";

        echo "<h1>Deleting a person</h1>\n";
        if (!$this->people->kill($personId)) {
            die("There was an error deleting a person:<br />" . $this->people->lastErrorPassThru() . "<br />" . $this->people->lastQueryPassThru());
        }
        echo $this->people->lastQueryPassThru(), "<br />\n";

        echo "<h1>Listing People</h1>\n";
        $peopleSimple = $this->people->getAllPeopleSimple();
        echo $this->people->lastQueryPassThru(), "<br />\n";
        echo "<pre>";
        while ($person = $peopleSimple->row()) {
            var_dump($person);
        }
        echo "</pre>";
    }
}
