<?php
namespace Src\Components;

use Src\Helpers\Printer;

/**
 * main application class
 * Class App
 * @package Src\Components
 */
class App{
    protected $printer;
    protected $registry = [];

    /**
     * App constructor.
     * @param Printer|null $printer
     */
    public function __construct(Printer $printer = null)
    {
        $this->printer = $printer ?? new Printer();
    }

    /**
     * @return Printer
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    /**
     * @param $name
     * @param $callableFunc
     */
    public function registerCommand($name, $callableFunc)
    {
        $this->registry[$name] = $callableFunc;
    }

    /**
     * @param $command
     * @return mixed|null
     */
    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

    /**
     * @param array $argv
     */
    public function run(array $argv = [])
    {
        $command_name = "help";

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->getPrinter()->print("ERROR: Command " . $command_name . " not found!");
            exit;
        }

        call_user_func($command, $argv);
    }
}