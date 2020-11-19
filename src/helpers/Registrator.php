<?php
namespace Src\Helpers;

use Src\Controllers\BaseController;

/**
 * This class handles commands and controllers relations and registration.
 * Each command is served by it's respective controller, i.e. command "csv" will be served by "CsvController".
 * We can change this logic later or add other different Registrators if needed
 *
 * Class Printer
 * @package Src\Components
 */
class Registrator{
    protected $commands = [];
    protected $controllers = [];

    /**
     * @param $name
     * @param $callable
     */
    public function registerCommand($name, $callable)
    {
        $this->commands[$name] = $callable;
    }

    /**
     * @param $command_name
     * @param BaseController $controller
     */
    public function registerController($command_name, BaseController $controller)
    {
        $this->controllers = [ $command_name => $controller ];
    }

    /**
     * @param $command
     * @return mixed|null
     */
    public function getCommand($command)
    {
        return isset($this->commands[$command]) ? $this->commands[$command] : null;
    }

    /**
     * @param $command
     * @return mixed|null
     */
    public function getController($command)
    {
        return isset($this->controllers[$command]) ? $this->controllers[$command] : null;
    }

    /**
     * @param string $command_name
     * @return array|mixed|null
     * @throws \Exception
     */
    public function getCallable(string $command_name)
    {
        $controller = $this->getController($command_name);

        if ($controller instanceof BaseController) {
            return [ $controller, 'run' ];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            throw new \Exception("The command \"$command_name\" is not found.");
        }

        return $command;
    }
}