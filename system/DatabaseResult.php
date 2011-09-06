<?php
class DatabaseResult /*implements Iterator */{
    protected $result = NULL;
    // This class will be used for iterating over database results
    public function __construct($databaseResult) {
        $this->result = $databaseResult;

    }

    function row() { // Associative Array (personal favorite)
        return mysql_fetch_assoc($this->result);
    }

    function enum() { // Enumerated Array (who would want this?!)
        return mysql_fetch_row($this->result);
    }

    function object() { // Object (std class)
        return mysql_fetch_object($this->result);
    }

}
