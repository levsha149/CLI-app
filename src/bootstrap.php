<?php

use Src\Components\App;
use Src\Controllers\CsvController;

$app = new App();

function D($data){
    print_r($data);
    exit;
}

/**
 * Here we can register new commands as controllers via registerController(command_name, controller_instance)
 * or as anonymous functions via registerCommand(command_name, callable_function) for quick hacks, if needed
 *
 * Any command can be called from cli in form of "php converter {command_name} [parameter=value]"
 */

$app->registerController('csv', new CsvController($app));

$app->registerCommand("help", function() use ($app){
    $app->printSignature();
});

/**
 * Console app is executed
 */
$app->run($argv);
