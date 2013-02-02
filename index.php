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

// Configure the router class. Add more routes here, above the default one (they're matched in order)
// Both :controller and :action are magical, any others are not.
// Paranthesis mean that what is inside is optional.
// Strings starting with : are pattern match groups.

// Here's an example route, where you can browse to /users/100
// www.example.com/root/users/100
// This will run Controller_Home::action_view_user(array('user_id'=>'100'));
\Sleek\Request::addRoute('/users/:user_id', array(
    'controller' => 'home',
    'action' => 'view_user',

    'user_id' => NULL
));

// This is a "catch all" route; in many cases it will be all you need.

// www.example.com/root/
// www.example.com/root/controllerName
// www.example.com/root/controllerName/actionName
// www.example.com/root/controllerName/actionName/something
\Sleek\Request::addRoute('(/:controller(/:action(/:id)))', array(
    'controller' => 'home',
    'action' => 'index',

    'id' => NULL
));

// Executes SleekMVC
new \Sleek\Core();
