<?php
Class Model_People extends Model_Database {
    protected $tableName = 'people';

    function getAllPeopleManual() {
        return $this->db->query("SELECT * FROM {$this->tableName}");
    }

    function getAllPeopleSimple() {
        return $this->db->select($this->tableName, '*');
    }

    function newPerson($name, $state = 3) {
        return $this->db->insert($this->tableName, array('name' => $name, 'state_id' => $state));
    }

    function editPerson($newName, $newState, $existingId) {
        return $this->db->update($this->tableName, array('name' => $newName, 'state_id' => $newState), array('id' => $existingId));
    }

    function kill($personToKill) {
        return $this->db->delete($this->tableName, array('id' => $personToKill));
    }

    function lastErrorPassThru() {
        return $this->db->lastError();
    }

    function lastQueryPassThru() {
        return $this->db->lastQuery();
    }
}

