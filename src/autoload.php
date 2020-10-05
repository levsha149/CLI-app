<?php
require_once __DIR__ . '/helpers/Autoloader.php';

$autoloader = new Autoloader();

/**
 * register namespaces here
 */
$autoloader->registerNamespace('Classes',  __DIR__ . '/classes');


/**
 * register function call
 */
$autoloader->register();