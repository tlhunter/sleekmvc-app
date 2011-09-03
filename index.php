<?php
define('SYSTEM_DIR', 'system/');
define('APP_DIR', 'app/');

require_once(SYSTEM_DIR . "Autoload.php");
Config::load('config');
new Bootstrap();
