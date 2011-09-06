<?php
Class Model_People extends Model_Database {
    function getPeople() {
        $rows = $this->db->query("SELECT * FROM all_data");
        $data['people'] = $rows;
        View::render('people', $data);
    }
}

