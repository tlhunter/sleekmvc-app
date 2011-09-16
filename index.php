<?php
define('SYSTEM_DIR',    'system/');
define('APP_DIR',       'app/');
define('VENDOR_DIR',    'app/vendor/');

require_once(SYSTEM_DIR . "Autoload.php");
require_once(SYSTEM_DIR . "Error.php");

\SleekMVC\Autoload::register();
\SleekMVC\Error::register();

new \SleekMVC\Core();
