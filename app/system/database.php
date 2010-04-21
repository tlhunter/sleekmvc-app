<?php
class db {
	protected $server;
	protected $user;
	protected $pass;
	protected $database;
	protected $query_num;
	
	function __construct($server, $user, $pass, $database = NULL) {
		$this->server = $server;
		$this->user = $user;
		$this->pass = $pass;
		if (isset($database)) {
			$this->database = $database;
		}
	}

	function connect() {
		$result = mysql_connect($this->server, $this->user, $this->pass);
		if (!$result) {
			echo 'Connection to database server at: '.$this->server.' failed.';
			return false;
		}
		return $result;
	}

	function db_pconnect() {
		$result = mysql_pconnect($this->server, $this->user, $this->pass);
		if (!$result) {
			echo 'Connection to database server at: '.$this->server.' failed.';
			return false;
		}
		return $result;
	}

	function select_db($database) {
		$this->database = $database;
		if (!mysql_select_db($this->database)) {
			echo 'Selection of database: '.$this->database.' failed.';
			return false;
		}
		return true;
	}

	function query($query) {
		$result = mysql_query($query) or die("Query failed: $query<br><br>" . mysql_error());
		return $result;
	}
	
	function insert($table, $data) {
		# return mysql_insert_id()
	}
	
	function select($table, $data) {
		# if data is an integer, assume it's our PK
		# if data is an array, it's our SELECT fields
		# if data is an associative array, it's our WHERE clauses
	}
	
	function update($table, $data, $id) {
		# if id is set, it's in our where clause
		# if id isn't set, update everything? dangerous?
	}
	
	function delete($table, $data) {
		# if data is an integer, assume it's our PK
		# if data is an associative array, it's our WHERE clauses
	}

	function fetch(&$result) {
		return mysql_fetch_assoc($result);
	}

	function query_num() {
		return $this->query_num;
	}
	
	function insert_id($result) {
		return mysql_insert_id($result);
	}

	function num_rows($result) {
		return mysql_num_rows($result);
	}
};