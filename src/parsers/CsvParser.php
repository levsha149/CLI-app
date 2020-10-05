<?php

namespace Src\Parsers;

class CsvParser extends BaseParser
{
    protected static $extension = 'csv';

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

        //we suppose that first line always contains keys of CSV values
        $result = $this->getResultArray($rows);

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
    public function getResultArray($rows)
    {
        //TODO: here should be the logic of conversion for label row and data rows of target CSV file

        return $rows;
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