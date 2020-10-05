<?php
/**
 * This is a base controller abstraction with basic methods of getting cli parameters and arguments passed to command
 */

namespace Src\Controllers;

use Src\Components\App;
use Src\Components\Input;

abstract class BaseController
{
    protected $app;

    protected $input;

    abstract public function handle();

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function run(Input $input = null)
    {
        $this->input = $input ?? new Input();
        $this->handle();
    }

    protected function getArguments()
    {
        return $this->input->arguments;
    }

    protected function getParameters()
    {
        return $this->input->parameters;
    }

    protected function hasParameter($parameter)
    {
        return $this->input->hasParameter($parameter);
    }

    protected function getParameter($parameter)
    {
        return $this->hasParameter($parameter) ? $this->input->getParameter($parameter) : null;
    }

    protected function getApp()
    {
        return $this->app;
    }

    protected function getPrinter()
    {
        return $this->getApp()->getPrinter();
    }

    /**
     * prints error message to cli and stops the program
     * @param $message
     */
    protected function fail($message){
        $this->getPrinter()->error($message);
        exit;
    }
}