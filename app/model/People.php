<?php
Class Model_People extends Model_Database {
    function getPeople() {
        $rows = $this->db->query("SELECT * FROM all_data");
        while ($row = mysql_fetch_assoc($rows)) {
            echo "row: ";
            var_dump($row);
        }
    }
}

