<?php

use Src\Components\App;
use Src\Controllers\CsvController;

$app = new App();

/**
 * Here we can register new commands, passing name as first argument and respective controller,
 * that will be serving this command, as second argument of ->registerCommand().
 *
 * The command can be called from cli in form of "php converter {command_name} [parameter=value]"
 */

$app->registerController('csv', new CsvController($app));


/**
 * Console app is executed
 */
$app->run($argv);
