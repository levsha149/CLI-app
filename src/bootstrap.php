<?php

use Src\Components\App;

$app = new App();

/**
 * Here we can register new commands, passing name as first argument and any callable function
 * which will be performed, as second argument of ->registerCommand().
 *
 * The command can be called from cli in form of "php converter {command_name}"
 */

$app->registerCommand('convert', function (array $argv) use ($app) {
    $name = isset ($argv[2]) ? $argv[2] : "World";
    $app->getPrinter()->print("Hello $name!!!");
});

/**
 * Console app is executed
 */
$app->run($argv);
