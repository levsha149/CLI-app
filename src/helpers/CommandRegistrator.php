<?php
namespace Src\Helpers;

/**
 * This class is responsible for console printing.
 * Class Printer
 * @package Src\Components
 */
class CommandRegistrator{
    protected $registry = [];

    public function register($name, $callable)
    {
        $this->registry[$name] = $callable;
    }

    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }
}