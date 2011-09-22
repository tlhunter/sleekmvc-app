<?php
namespace Sleek;

class Database extends \MySQLi {
    /**
     * @var Database The singleton instance of our database class
     */
    static private $_instance   = NULL;

    /**
     * @var string The last query which was executed by this class
     */
    protected $lastQuery        = '';

    /**
     * Prefents the database class from being instantiated multiple times
     */
    private function __construct() {
        $settings = Config::get('database');
        return parent::__construct($settings['host'], $settings['user'], $settings['pass'], $settings['name']);
    }

    /**
     * Prevents the database class from being cloned
     * @return NULL
     */
    private function __clone() { }

    /**
     * Returns the singleton instance of the Database class
     * @return Database
     */
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    /**
     * Sets which database this database class will be using. If you switch it a lot it may confuse different models.
     * @param $database string
     * @return NULL
     */
    public function selectDatabase($database) {
        return $this->select_db($database);
    }

    /**
     * Executes a query which returns rows. Use it with SELECT statements.
     * @param $query string
     * @return int | FALSE
     */
    public function query($query) {
        $this->lastQuery = $query;
        $result = parent::query($query);
        if ($result) {
            return is_bool($result) ? $result : new DatabaseResult($result);
        }
        return FALSE;
    }

    /**
     * Executes a "Simple" query, that is, a query which doesn't return rows. Returns the affected rows.
     * Use this for INSERT, UPDATE, DELETE statements. With an INSERT, you'll likely also want to run lastId();
     * @param $query string
     * @return int | FALSE
     */
    public function querySimple($query) {
        $this->lastQuery = $query;
        $result = $this->query($query);
        if ($result) {
            return $this->affected_rows;
        }
        return FALSE;
    }

    /**
     * Returns the last auto incrememnt ID generated from an INSERT statement
     * @return int
     */
    public function lastId() {
        return $this->insert_id;
    }

    /**
     * Returns the last error message generated by MySQL
     * @return string
     */
    public function lastError() {
        return $this->error;
    }

    /**
     * Returns the SQL used in the last query (useful for debugging generated queries)
     * @return string
     */
    public function lastQuery() {
        return $this->lastQuery;
    }

    /**
     * Returns the number of affected rows from the last executed query
     * @return int
     */
    public function affectedRows() {
        return $this->affected_rows;
    }

    /**
     * This function adds a row to the table with the specified criteria, returning the newly created row's ID
     * @param $table string
     * @param $data array (associative array of column -> value)
     * @return int | FALSE
     */
    public function insert($table, $data) {
        $sql = "INSERT INTO $table SET ";
        $interim = array();
        foreach($data AS $key => $value) {
            $interim[] = "`$key` = '" . self::real_escape_string($value) . "'";
        }
        $data = implode($interim, ',');
        $sql .= $data;

        if ($this->executeRawQuery($sql)) {
            return $this->insert_id;
        } else {
            return FALSE;
        }
    }

    /**
     * This function deletes row(s) from a table depending on the criteria
     * @param $table string
     * @param $where array (associative array of column -> value, AND separated)
     * @return int | FALSE
     */
    public function delete($table, $where) {
        $sql = "DELETE FROM $table WHERE ";
        $interim = array();
        foreach($where AS $key => $value) {
            $interim[] = "`$key` = '" . self::real_escape_string($value) . "'";
        }
        $data = implode($interim, ' AND ');
        $sql .= $data;

        if ($this->executeRawQuery($sql)) {
            return $this->affected_rows;
        } else {
            return FALSE;
        }

    }

    /**
     * This function generates and executes a MySQL WHERE statement, returning the number of affected rows
     * @param $table string
     * @param $data array (associative array of column -> value)
     * @param $where array (associative array of column -> value, AND separated)
     * @return int | FALSE
     */
    public function update($table, $data, $where) {
        $sql = "UPDATE $table SET ";
        $interim = array();
        foreach($data AS $key => $value) {
            $interim[] = "`$key` = '" . self::real_escape_string($value) . "'";
        }
        $data = implode($interim, ',');
        $sql .= $data;

        if ($where) {
            $sql .= " WHERE ";
            $interim = array();
            foreach($where AS $key => $value) {
                $interim[] = "`$key` = '" . self::real_escape_string($value) . "'";
            }
            $data = implode($interim, ' AND ');
            $sql .= $data;
        }

        if ($this->executeRawQuery($sql)) {
            return $this->affected_rows;
        } else {
            return FALSE;
        }
    }

    /**
     * This function generates and executes a SQL SELECT statement, returning the results
     * @param $table string
     * @param $columns array
     * @param $where array (associative, column -> value)
     * @param $limit int
     * @param $offset int
     * @return DatabaseResult | False
     */
    public function select($table, $columns, $where = array(), $limit = NULL, $offset = NULL) {
        if ($limit !== NULL) {
            $limit = (int) $limit;
        }
        if ($offset !== NULL) {
            $offset = (int) $offset;
        }
        $sql = "SELECT ";
        if (is_array($columns)) {
            $interim = array();
            foreach($columns AS $column) {
                $interim[] = (string) $column;
            }
            $data = implode($interim, ', ');
            $sql .= $data;
        } else if (is_string($columns)) {
            $sql .= $columns;
        }

        $sql .= " FROM $table";

        if ($where) {
            $sql .= " WHERE ";
            $interim = array();
            foreach($where AS $key => $value) {
                $interim[] = "`$key` = '" . self::real_escape_string($value) . "'";
            }
            $data = implode($interim, ' AND ');
            $sql .= $data;
        }

        if ($limit) {
            $sql .= " LIMIT $limit";
            if ($offset) {
                $sql .= " OFFSET $offset";
            }
        }

        $result = $this->executeRawQuery($sql);
        if ($result) {
            return is_bool($result) ? $result : new DatabaseResult($result);
        }
        return FALSE;
    }

    /**
     * This function executes the provided query, sets the lastQuery in the class, and returns the result
     * Note that not all queries will return rows. This function is protected as other query functions should run it
     * @param @query string
     * @return Resource
     */
    protected function executeRawQuery($query) {
        $this->lastQuery = $query;
        return $this->query($query);
    }

}
