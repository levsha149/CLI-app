<?php
namespace Src\Components;

/**
 * main application class
 * Class App
 * @package Src\Components
 */
class App{
    protected $printer;

    public function __construct(Printer $printer = null)
    {
        $this->printer = $printer ?? new Printer();
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function runCommand(array $argv)
    {
        $name = "World";
        if (isset($argv[1])) {
            $name = $argv[1];
        }

        $this->getPrinter()->print("Hello $name!!!");
    }
}