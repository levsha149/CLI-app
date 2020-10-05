<?php

namespace Src\Controllers;

use Src\Parsers\CsvParser;

class CsvController extends BaseController
{
    public function handle()
    {
        if(!$this->hasParameter('file') || !$filename = $this->getParameter('file')){
            $this->fail("please specify full file name in 'file' parameter to proceed!");
        }

        $parser = new CsvParser();
        $converted = $parser->convert($filename);

        if($converted){
            $this->getPrinter()->success(
                'file '.$filename.' was successfully converted to "output_'.$filename.'" file! Please check output folder.'
            );
        }else{
            $this->getPrinter()->error('Some error happened during conversion!');
        }

    }
}