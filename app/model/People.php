<?php
Class Model_People extends Model_Database {
    function getPeople() {
        return $this->db->query("SELECT * FROM all_data");
    }
}

