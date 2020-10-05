<?php

namespace Src\Parsers;

class CsvParser extends BaseParser
{
    protected static $extension = 'csv';

    /**
     * gets array of transition callables from /src/transitions folder
     * @return array
     */
    public function getTransitions() : array
    {
        return require_once __DIR__."/../transitions/".self::$extension.".php";
    }

    /**
     * Parses csv content into array
     * @param $filename
     * @return array
     * @throws \Exception
     */
    public function parse($filename)
    {
        $path = $this->getSourcePath($filename);

        if(!$this->checkExtension($filename)){
            throw new \Exception('File "'.$filename.'" has extension that is incompatible with '.get_called_class().'!');
        }

        if(!$this->checkFile($path)){
            throw new \Exception('File "'.$filename.'" is not found in input folder!');
        }


        $rows = [];

        $file = fopen($path, 'r');

        while (($line = fgetcsv($file)) !== FALSE) {
            //$line is an array of the csv elements

            $rows[] = str_getcsv($line[0], $this->detectDelimiter($filename));
        }
        fclose($file);

        $result = $this->convertRows($rows);

        return $result;
    }

    /**
     * @param $filename
     * @return bool|false|int|string
     */
    private function detectDelimiter($filename)
    {
        $path = $this->getSourcePath($filename);
        if($this->checkFile($path) && $this->checkExtension($path)){
            $delimiters = [";" => 0, "," => 0, "\t" => 0, "|" => 0];

            $handle = fopen($this->getSourcePath($filename), "r");
            $firstLine = fgets($handle);
            fclose($handle);
            foreach ($delimiters as $delimiter => &$count) {
                $count = count(str_getcsv($firstLine, $delimiter));
            }

            return array_search(max($delimiters), $delimiters);
        }

        return false;
    }

    /**
     * @param $rows
     * @return mixed
     */
    public function convertRows($rows)
    {
        //first, get transition rules for given type of file
        $transitions = $this->getTransitions();

       foreach($rows as &$row){
           foreach($row as &$cell){
              $this->convertCell($cell, $transitions);
           }
       }

        return $rows;
    }

    /**
     * Checks every cell of CSV row by type and applies appropriate transition
     * @param $value
     * @param $transitions
     */
    protected function convertCell(&$value, $transitions){

        if(is_numeric($value)){
            //if number
            $transition = $transitions['numeric'] ?? null;
            $this->performTransition($value, $transition);

        }elseif(strtotime($value) != false){
            //if date
            $transition = $transitions['date'] ?? null;
            $value = strtotime($value);
            $this->performTransition($value, $transition);


        }elseif(is_string($value)){
            //if any other string
            $transition = $transitions['string'] ?? null;
            $this->performTransition($value, $transition);

        }
    }

    /**
     * @param $value
     * @param $transition
     */
    private function performTransition(&$value, $transition){
        if(!empty($transition)){
            if(is_array($transition)){
                foreach($transition as $rule){
                    if(is_callable($rule)){
                        $value = $rule($value);
                    }

                }
            }elseif(is_callable($transition)){
                $value = $transition($value);
            }
        }
    }

    /**
     * @param $filename
     * @return bool
     * @throws \Exception
     */
    public function convert($filename){

        $rows = $this->parse($filename);
        $targetPath = $this->getTargetPath('output_'.$filename);

        $fp = fopen($targetPath, 'w');

        foreach ($rows as $fields) {
            fputcsv($fp, $fields);
        }

        return $this->checkFile($targetPath);
    }
}