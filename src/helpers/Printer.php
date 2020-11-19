<?php
namespace Src\Helpers;

/**
 * This class is responsible for console printing.
 * Class Printer
 * @package Src\Components
 */
class Printer{

    /**
     * general cli output function
     * @param $message
     */
    public function out(string $message)
    {
        print_r($message);
    }

    public function newline()
    {
        $this->out("\n");
    }

    /**
     * console output with new line after it
     * @param string $message
     */
    public function print(string $message){
        $this->out($message);
        $this->newline();
    }

    /**
     * prints message to cli in red
     * @param string $message
     */
    public function error(string $message){
        $this->out("\e[31m".$message."\e[0m");
        $this->newline();
    }

    /**
     * prints message to cli in green
     * @param string $message
     */
    public function success(string $message){
        $this->out("\e[32m".$message."\e[0m");
        $this->newline();
    }

    /**
     * prints message to cli in yellow
     * @param string $message
     */
    public function info(string $message){
        $this->out("\e[33m".$message."\e[0m");
        $this->newline();
    }
}