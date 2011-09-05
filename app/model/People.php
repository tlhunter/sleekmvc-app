<?php
Class Model_People extends Model_Database {
    function getPeople() {
        $rows = $this->db->query("SELECT * FROM all_data");
        foreach($rows AS $row) {
            echo "row: ";
            var_dump($row);
        }
    }
}

