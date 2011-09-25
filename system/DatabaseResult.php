<?php
namespace Sleek;

class DatabaseResult implements \Countable, \Iterator {

    /**
     * This is our result set (extending mysqli_result had some weird bugs)
     * @var \mysqli_result
     */
    protected $result       = NULL;

    /**
     * This is the number of rows being returned, calculatd once to be faster
     * @var int
     */
    protected $count        = 0;

    /**
     * This is the current row being looked at (works while iterating, now with ->fetch_*() functions)
     * @var int
     */
    protected $index        = 0;

    public function __construct(\mysqli_result $result) {
        $this->result = $result;
        $this->count = $this->result->num_rows;
        $this->index = 0;
    }

    // Object Oriented approach

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

    // Lets us run count($result) (implements Countable)

    /**
     * Returns the number of rows in this result
     * @return int
     */
    public function count() {
        return $this->count;
    }

    // Lets us do foreach($result AS $row) type stuff (implements Iterator)

    public function current() {
        $row = $this->result->fetch_assoc();
        $this->result->data_seek($this->index);
        return $row;
    }

    public function next() {
        if ($this->index < $this->count - 1) {
            $this->result->data_seek($this->index + 1);
        }
        $this->index++;
    }

    public function key() {
        return $this->index;
    }

    public function rewind() {
        $this->result->data_seek(0);
        $this->index = 0;
    }

    public function valid() {
        if ($this->index >= 0 && $this->index < $this->count) {
            return TRUE;
        }
        return FALSE;
    }

}
