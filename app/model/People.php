<?php
Class Model_People extends Model_Database {
    function getPeople() {
        return $this->db->query("SELECT * FROM all_data");
    }

    function newPerson($name) {
        return $this->db->insert('people', array('name' => $name, 'state_id' => 3));
    }

    function lastError() {
        return $this->db->lastError();
    }
}

