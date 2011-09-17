<?php
namespace SleekMVC\Model;
/**
 * All model's dealing with database connectivity should extend from this base class
 */
abstract class Database extends Base {
    /**
     * @var Database
     */
    protected $db = NULL;

    /**
     * Grabs a reference to the Database class and makes it accessible in child classes as $this->db
     * This is just done out of convenience, child classes could just do it the long way seen below.
     */
    function __construct() {
        $this->db = \SleekMVC\Database::getInstance();
    }

}
