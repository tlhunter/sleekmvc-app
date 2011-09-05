<?php
abstract class Model_Database extends Model_Base {
    protected $db = NULL;

    function __construct() {
        $this->db = Database::getInstance();
    }

}
