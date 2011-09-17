<?php
namespace Sleek;

class DatabaseResult implements \Countable {
    /**
     * This is the database query result resource
     * @var Resource
     */
    protected $result = NULL;

    /**
     * Create this class by passing in a database result
     */
    public function __construct($databaseResult) {
        $this->result = $databaseResult;
    }

    /**
     * Returns the next available row as an associative array
     *  while ($row = $result->row()) { echo $row['id']; }
     * @return array
     */
    public function row() {
        return mysql_fetch_assoc($this->result);
    }

    /**
     * Returns the next available row as an enumerated array
     *  while ($row = $result->enum()) { echo $row[0]; }
     * @return array
     */
    public function enum() {
        return mysql_fetch_row($this->result);
    }

    /**
     * Returns the next available row as an object
     *  while ($row = $result->object()) { echo $row->id; }
     * @return stdClass
     */
    public function object() {
        return mysql_fetch_object($this->result);
    }

    /**
     * Returns the number of rows in this result
     * @return int
     */
    public function count() {
        return mysql_num_rows($this->result);
    }
}
