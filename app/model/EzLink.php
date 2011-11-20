<?php
namespace App;

/**
 * Has all of the business logic for the EzLink website
 */
class Model_EzLink extends \Sleek\Model_Database {

    /**
     * This is a set of all possible EzLink characters. There are 64 of them.
     * They are translated to and from an integer, allowing a lot more data in a smaller space.
     * @var string
     */
    static $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    /**
     * The name of the database table containing click data
     * @var string
     */
    protected $click_table = 'clicks';

    /**
     * The name of the databaes table containing url data
     * @var string
     */
    protected $url_table = 'url';

    /**
     * Counts the number of clicks in the database
     * @return int
     */
    public function countClicks() {
        $result = $this->db->query("SELECT SUM(count) AS count FROM {$this->click_table}");
        if (count($result)) {
            $data = $result->row();
            return $data['count'];
        }
        return 0;
    }

    /**
     * Counts the number of urls in the database
     * @return int
     */
    public function countUrls() {
        $result = $this->db->query("SELECT COUNT(*) AS count FROM {$this->url_table}");
        if (count($result)) {
            $data = $result->row();
            return $data['count'];
        }
        return 0;
    }

    /**
     * Inserts the provided URL into the database and returns the result
     * @param string $url
     * @return bool|int
     */
    public function insertUrl($url) {
        if ($this->db->insert($this->url_table, array('url' => $url))) {
            return $this->db->lastId();
        } else {
            return FALSE;
        }
    }

    /**
     * Gets a URL from the database with the provided numerical ID
     * @param int $id
     * @return string|bool
     */
    public function getUrlById($id) {
        $result = $this->db->select($this->url_table, array('url'), array('id' => $id), 1);
        if (count($result)) {
            $row = $result->row();
            return $row['url'];
        }
        return FALSE;
    }

    /**
     * Increments a URLs click count by one. It will run an UPDATE or an INSERT to do this.
     * @param int $id
     * @param string $year
     * @param string $month
     * @return int|bool
     */
    public function clickUrl($id, $year, $month) {
		$sql = "SELECT * FROM clicks WHERE url_id = $id AND year = '$year' AND month = '$month' LIMIT 1";
		$result = $this->db->query($sql);
		if (count($result)) {
			$sql = "UPDATE clicks SET count = count + 1 WHERE url_id = $id AND year = '$year' AND month = '$month' LIMIT 1";
			return $this->db->querySimple($sql);
		} else {
			$sql = "INSERT INTO clicks SET count = 1, url_id = $id, year = '$year', month = '$month'";
			return $this->db->querySimple($sql);
		}
    }

    /**
     * Executes SQL and returns an image resource (PNG)
     * @return \resource
     */
    public function getStatisticsImage() {
        $result = $this->db->query("SELECT COUNT(*) AS count, MONTH(added) AS month, YEAR(added) AS year FROM url GROUP BY CONCAT(MONTH(added), YEAR(added)) ORDER BY year DESC, month DESC");
        $data = array();
        $maxv = 0;
        foreach($result AS $row) {
            $count = (int) $row['count'];
            if ($count > $maxv) {
                $maxv = $count;
            }
            $data[ $row['year'] . '-' . $row['month'] ] = $count;
        }

        $columns        = 13;
        $width          = 550;
        $height         = 200;
        $padding        = 5;

        $column_width   = $width / $columns;

        $year           = date('Y') - 1;
        $month          = date('n');

        $image          = imagecreate($width, $height + 20);
        $gray           = imagecolorallocate($image, 0xcc, 0xcc, 0xcc);
        $gray_lite      = imagecolorallocate($image, 0xee, 0xee, 0xee);
        $gray_dark      = imagecolorallocate($image, 0x7f, 0x7f, 0x7f);
        $white          = imagecolorallocate($image, 0xff, 0xff, 0xff);

        imagefilledrectangle($image, 0, 0, $width, $height + 20, $white);

        for ($i = 0; $i < 12; $i++) {
            $month++;
            if ($month > 12) {
                $month = 1;
                $year++;
            }
            $val = $data[$year . '-' . $month];
            $column_height = ($height / 100) * (( $val / $maxv) * 100) * 2;

            $x1 = $i * $column_width;
            $y1 = $height - $column_height;
            $x2 = (($i + 1) * $column_width) - $padding;
            $y2 = $height;

            imagefilledrectangle($image, $x1, $y1, $x2, $y2, $gray);

            imageline($image, $x1, $y1, $x1, $y2, $gray_lite);
            imageline($image, $x1, $y2, $x2, $y2, $gray_lite);
            imageline($image, $x2, $y1, $x2, $y2, $gray_dark);
            imagettftext($image, 10, 0, $x1, $height + 15, $gray_dark, APP_DIR . 'font/DroidSans.ttf', $month . '/' . substr($year, 2, 2));
            imagettftext($image, 10, 0, $x1 + 6, $y1 + 12, $gray_dark, APP_DIR . 'font/DroidSans.ttf', $val);
        }

        return $image;
    }

    /**
     * Converts an EzLink code to an integer
     * @static
     * @param string $string
     * @return int
     */
    static function codeToInteger($string) {
        $string = strrev($string) . '';
        $total = 0.0;
        for ($i = 0; $i < strlen($string); $i++) {
            $base = pow(64,$i);
            $thischar = substr($string, $i, 1);
            $myval = strpos(self::$characters, $thischar);
            $total += $base * $myval;
        }
        return $total;
    }

    /**
     * Converts an integer into an EzLink code
     * @static
     * @param int $number
     * @return string
     */
    static function integerToCode($number) {
        $number = (float) $number;
        $holder = array();
        $i = 0;
        while ($number > 63) {
            $quotient = floor($number / 64);
            $remainder = $number % 64;
            $holder[$i] = $remainder;
            $number = $quotient;
            $i++;
        }
        $holder[$i] = $number;
        $output = "";
        for ($i = sizeof($holder) - 1; $i >= 0; $i--) {
            $output .= substr(self::$characters, $holder[$i], 1);
        }
        return $output;
    }

}
