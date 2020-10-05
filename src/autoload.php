<?php
require_once __DIR__ . '/helpers/Autoloader.php';

$autoloader = new Autoloader();

/**
 * register namespaces here
 */
$autoloader->registerNamespace('Components', __DIR__ . '/components');


/**
 * register function call
 */
$autoloader->register();