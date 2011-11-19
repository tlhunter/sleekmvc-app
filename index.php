<?php
/**
 * This file is executed first, and the framework takes care of the rest.
 * Take a look at the .htaccess file sitting next to this one (it may be
 * hidden on your operating system). That file grabs user requests and
 * passes them into this index.php file.
 */

// SleekMVC requires at least PHP 5.3 (due to namespaces)
if (version_compare(PHP_VERSION, '5.3.0') < 0) {
    die("SleekMVC Requires PHP 5.3+");
}

// These settings tell the framework where to find files at.
define('SYSTEM_DIR',    'system/');
define('APP_DIR',       'app/');
define('VENDOR_DIR',    'vendor/');

// Grab the autoloader (which makes our lives MUCH easier)
require_once(SYSTEM_DIR . 'Autoload.php');

// Also enable the error class (we try to catch errors and show users pretty pages)
require_once(SYSTEM_DIR . 'Error.php');

// Enables the Autoloader
\Sleek\Autoload::register();

// Enables the error catching code
\Sleek\Error::register();

// Executes SleekMVC
new \Sleek\Core();
