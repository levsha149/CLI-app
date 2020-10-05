<?php
namespace Src\Components;

use Src\Helpers\CommandRegistrator;
use Src\Helpers\Printer;

/**
 * main application class
 * Class App
 * @package Src\Components
 */
class App{
    protected $printer;
    protected $registry;

    /**
     * App constructor. We can use different printers and cli command registrators, if needed
     * @param Printer|null $printer
     * @param CommandRegistrator|null $registry
     */
    public function __construct(Printer $printer = null, CommandRegistrator $registry = null)
    {
        $this->printer = $printer ?? new Printer();
        $this->registry = $registry ?? new CommandRegistrator();
    }

    /**
     * @return Printer
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    public function registerCommand($name, $callable)
    {
        $this->registry->register($name, $callable);
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

        $command = $this->registry->getCommand($command_name);
        if ($command === null) {
            $this->getPrinter()->print("ERROR: Command " . $command_name . " not found!");
            exit;
        }

        call_user_func($command, $argv);
    }
}