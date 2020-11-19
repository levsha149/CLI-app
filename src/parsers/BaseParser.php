<?php
namespace Src\Parsers;

abstract class BaseParser{
    protected static $extension;

    /**
     * parses file content into associative array
     * @param string $filename
     * @return mixed
     */
    abstract public function parse(string $filename);

    /**
     * performs data transition logic
     * @param $rows
     * @return mixed
     */
    abstract public function convertRows($rows);

    /**
     * main conversion function, should be called from controller
     * @param string $filename
     * @return mixed
     */
    abstract public function convert(string $filename);

    /**
     * gets an array of rules of conversion of different data types in CSV file
     * @return mixed
     */
    abstract public function getTransitions();

    /**
     * BaseParser constructor. Ensures that property $extension is set in all child classes
     * @throws \Exception
     */
    public function __construct()
    {
        if (!isset(static::$extension) || empty(static::$extension))
        {
            throw new \Exception('Child class '.get_called_class().' failed to define static "extension" property');
        }
    }

    /**
     * checks if file have correct extension
     * @param string $filename
     * @return bool
     */
    protected function checkExtension(string $filename){
        $file_parts = explode('.',$filename);

        if(count($file_parts) < 2 || end($file_parts) != static::$extension){
            return false;
        }

        return true;
    }

    /**
     * checks if file physically present in input folder
     * @param string $filename
     * @return bool
     */
    protected function checkFile(string $filename){
        return is_file($filename);
    }

    /**
     * returns source file path
     * @param string $filename
     * @return string
     */
    protected function getSourcePath(string $filename){
        return __DIR__."/../../input/".$filename;
    }

    /**
     * returns target file path
     * @param string $filename
     * @return string
     */
    protected function getTargetPath(string $filename){
        return __DIR__."/../../output/".$filename;
    }
}