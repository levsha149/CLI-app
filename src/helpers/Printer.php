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

    /**
     * prints message to cli in red
     * @param $message
     */
    public function error($message){
        $this->out("\e[31m".$message."\e[0m");
        $this->newline();
    }

    /**
     * prints message to cli in green
     * @param $message
     */
    public function success($message){
        $this->out("\e[32m".$message."\e[0m");
        $this->newline();
    }

    /**
     * prints message to cli in yellow
     * @param $message
     */
    public function info($message){
        $this->out("\e[33m".$message."\e[0m");
        $this->newline();
    }
}