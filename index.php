<?php
define('SYSTEM_DIR', 'system/');
define('APP_DIR', 'app/');

require_once(SYSTEM_DIR . "Autoload.php");
require_once(SYSTEM_DIR . "Error.php");
new Core();
