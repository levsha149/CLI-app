<?php
namespace Src\Components;


class ArgumentParser
{
    public $command;

    public $arguments = [];

    public $parameters = [];

    public function __construct(array $argv)
    {
        $this->arguments = $argv;
        $this->command = isset($argv[1]) ? $argv[1] : null;

        $this->loadParameters($argv);
    }

    protected function loadParameters(array $arguments)
    {
        foreach ($arguments as $argument) {
            $pair = explode('=', $argument);
            if (count($pair) == 2) {
                $this->parameters[$pair[0]] = $pair[1];
            }
        }
    }

    public function hasParameter($parameter)
    {
        return isset($this->parameters[$parameter]);
    }


    public function getParameter($parameter)
    {
        return $this->hasParameter($parameter) ? $this->parameters[$parameter] : null;
    }
}