<?php
namespace Src\Helpers;

/**
 * This class is responsible for console printing.
 * Class Printer
 * @package Src\Components
 */
class Printer{
    public function out($message)
    {
        print_r($message);
    }

    public function newline()
    {
        $this->out("\n");
    }

    public function print($message){
        $this->out($message);
        $this->newline();
    }
}