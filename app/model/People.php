<?php
namespace App;
/**
 * This People  model looks almost pointless with it being so simple. Keep in mind that it should
 * do logic and error handling stuff. Also, the PassThru functions here are bad practice, and some
 * better error handling should be done.
 */
Class Model_People extends \Sleek\Model_Database {
    protected $tableName = 'people';

    public function getAllPeopleManual() {
        return $this->db->query("SELECT * FROM {$this->tableName}");
    }

    public function getAllPeopleSimple() {
        return $this->db->select($this->tableName, '*');
    }

    public function newPerson($name, $state = 3) {
        return $this->db->insert($this->tableName, array('name' => $name, 'state_id' => $state));
    }

    public function editPerson($newName, $newState, $existingId) {
        return $this->db->update($this->tableName, array('name' => $newName, 'state_id' => $newState), array('id' => $existingId));
    }

    public function kill($personToKill) {
        return $this->db->delete($this->tableName, array('id' => $personToKill));
    }

    public function lastErrorPassThru() {
        return $this->db->lastError();
    }

    public function lastQueryPassThru() {
        return $this->db->lastQuery();
    }
}

