<?php
namespace Src\Components;

use Src\Controllers\BaseController;
use Src\Helpers\Registrator;
use Src\Helpers\Printer;

/**
 * main application class
 * Class App
 * @package Src\Components
 */
class App{
    protected $printer;
    protected $registrator;
    protected $signature;

    /**
     * App constructor. We can use different printers and cli command registrators, if needed
     * @param Printer|null $printer
     * @param Registrator|null $registrator
     */
    public function __construct(Printer $printer = null, Registrator $registrator = null)
    {
        $this->printer = $printer ?? new Printer();
        $this->registrator = $registrator ?? new Registrator();
        $this->setSignature("converter {command_name} [ parameter=value ]");

        $this->registerCommand("help", function() {
            $this->printSignature();
        });
    }

    /**
     * @return Printer
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    /**
     * registers new controller
     * @param $name
     * @param BaseController $controller
     */
    public function registerController($name, BaseController $controller)
    {
        $this->registrator->registerController($name, $controller);
    }

    /**
     * registers new command
     * @param $name
     * @param $callable
     */
    public function registerCommand($name, $callable)
    {
        $this->registrator->registerCommand($name, $callable);
    }

    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * prints command signature to cli
     */
    public function printSignature()
    {
        $this->getPrinter()->print(sprintf("Command syntax: %s", $this->getSignature()));
    }

    /**
     * sets a command signature, registered in bootstrap file
     * @param $app_signature
     */
    public function setSignature($app_signature)
    {
        $this->signature = $app_signature;
    }

    /**
     * @param array $argv
     */
    public function run(array $argv = [])
    {
        //by default show some help info to the user
        $command_name = 'help';

        $input = new ArgumentParser($argv);

         //show command signature if user mistyped in cli
        if (count($input->arguments) < 2) {
            $this->printSignature();
            exit;
        }

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        try {
            call_user_func($this->registrator->getCallable($command_name), $input);
        } catch (\Exception $e) {
            $this->getPrinter()->display("ERROR: " . $e->getMessage());
            exit;
        }
    }
}