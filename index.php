<?php
if (version_compare(PHP_VERSION, '5.3.0') < 0) {
    die("SleekMVC Requires PHP 5.3+");
}

define('SYSTEM_DIR',    'system/');
define('APP_DIR',       'app/');
define('VENDOR_DIR',    'vendor/');

require_once(SYSTEM_DIR . 'Autoload.php');
require_once(SYSTEM_DIR . 'Error.php');

\Sleek\Autoload::register();
\Sleek\Error::register();

new \Sleek\Core();
