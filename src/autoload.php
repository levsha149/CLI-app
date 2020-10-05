<?php
require_once __DIR__ . '/helpers/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->registerNamespace('Classes',  __DIR__ . '/classes');
$autoloader->register();