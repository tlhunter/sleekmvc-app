<?php
namespace Sleek;

class DatabaseResult implements \Countable {

    protected $result;

    public function __construct(\mysqli_result $result) {
        $this->result = $result;
    }

    /**
     * Returns the next available row as an associative array
     *  while ($row = $result->row()) { echo $row['id']; }
     * @return array
     */
    public function row() {
        return $this->result->fetch_assoc();
    }

    /**
     * Returns the next available row as an enumerated array
     *  while ($row = $result->enum()) { echo $row[0]; }
     * @return array
     */
    public function enum() {
        return $this->result->fetch_row();
    }

    /**
     * Returns the next available row as an object
     *  while ($row = $result->object()) { echo $row->id; }
     * @return stdClass
     */
    public function object() {
        return $this->result->fetch_object();
    }

    /**
     * Returns the number of rows in this result
     * @return int
     */
    public function count() {
        return $this->result->num_rows();
    }
}
