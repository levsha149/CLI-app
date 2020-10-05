<?php
namespace Src\Parsers;

abstract class BaseParser{
    protected static $extension;

    abstract public function parse($filename);

    abstract public function getResultArray($rows);

    public abstract function convert($filename);

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
     * @return bool
     */
    protected function checkExtension($filename){
        $file_parts = explode('.',$filename);

        if(count($file_parts) < 2 || end($file_parts) != static::$extension){
            return false;
        }

        return true;
    }

    /**
     * checks if file physically present in input folder
     * @return bool
     */
    protected function checkFile($filename){
        return is_file($filename);
    }

    protected function getSourcePath($filename){
        return __DIR__."/../../input/".$filename;
    }

    protected function getTargetPath($filename){
        return __DIR__."/../../output/".$filename;
    }
}