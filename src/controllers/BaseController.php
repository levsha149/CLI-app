<?php
/**
 * This is a base controller abstraction with basic methods of getting cli parameters and arguments passed to command
 */
namespace Src\Controllers;

use Src\Components\App;
use Src\Components\ArgumentParser;

abstract class BaseController{
    protected $app;

    protected $input;

    abstract public function handle();

    public function boot(App $app)
    {
        $this->app = $app;
    }

    public function run(ArgumentParser $input = null)
    {
        $this->input = $input ?? new ArgumentParser();
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
        return $this->hasParameter($parameter) ? $this->getParameter($parameter) : null;
    }

    protected function getApp()
    {
        return $this->app;
    }

    protected function getPrinter()
    {
        return $this->getApp()->getPrinter();
    }
}