<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
require __DIR__ . '/src/autoload.php';

use Components\TestClass;

$obj = new TestClass();