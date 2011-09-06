<?php
class DatabaseResult implements Countable /*implements Iterator */ {
    protected $result = NULL;
    // This class will be used for iterating over database results
    public function __construct($databaseResult) {
        $this->result = $databaseResult;

    }

    public function row() { // Associative Array (personal favorite)
        return mysql_fetch_assoc($this->result);
    }

    public function enum() { // Enumerated Array (who would want this?!)
        return mysql_fetch_row($this->result);
    }

    public function object() { // Object (std class)
        return mysql_fetch_object($this->result);
    }

    public function count() {
        return mysql_num_rows($this->result);
    }

}
