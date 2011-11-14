<?php
namespace App;
/**
 * This People  model looks almost pointless with it being so simple. Keep in mind that it should
 * do logic and error handling stuff. Also, the PassThru functions here are bad practice, and some
 * better error handling should be done.
 */
Class Model_People extends \Sleek\Model_Database {
    /**
     * This is the name of the table we're working with in this model. Using this variable
     * is not a convention used by SleekMVC, but is merely an example of adding our own
     * class variables to make our lives easier
     * @var string
     */
    protected $tableName = 'people';

    /**
     * This is an example of executing a raw query
     * @return \FALSE|\Sleek\DatabaseResult
     */
    public function getAllPeopleManual() {
        return $this->db->query("SELECT * FROM {$this->tableName}");
    }

    /**
     * This is an example of selecting things the easy way
     * @return \FALSE|\Sleek\DatabaseResult
     */
    public function getAllPeopleSimple() {
        return $this->db->select($this->tableName, '*');
    }

    /**
     * This is an example of an INSERT command
     * @param string $name
     * @param int $state
     * @return \FALSE|int
     */
    public function newPerson($name, $state = 3) {
        return $this->db->insert($this->tableName, array('name' => $name, 'state_id' => $state));
    }

    /**
     * This is an example of an UPDATE command
     * @param string $newName
     * @param int $newState
     * @param int $existingId
     * @return \FALSE|int
     */
    public function editPerson($newName, $newState, $existingId) {
        return $this->db->update($this->tableName, array('name' => $newName, 'state_id' => $newState), array('id' => $existingId));
    }

    /**
     * This is an example of a DELETE command
     * @param int $personToKill
     * @return \FALSE|int
     */
    public function kill($personToKill) {
        return $this->db->delete($this->tableName, array('id' => $personToKill));
    }

    /**
     * This is a cheater function for grabbing the last error from the database class
     * @return string
     */
    public function lastErrorPassThru() {
        return $this->db->lastError();
    }

    /**
     * This is a cheater function for grabbing the last executed query string from the database class
     * @return string
     */
    public function lastQueryPassThru() {
        return $this->db->lastQuery();
    }
}

