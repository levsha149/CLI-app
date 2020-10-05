<?php

namespace Src\Controllers;

class CsvController extends BaseController
{
    public function handle()
    {
        if(!$this->hasParameter('file') || !$filename = $this->getParameter('file')){
            $this->fail("please specify file name in 'input' folder to proceed");
        }

        $this->getPrinter()->print(sprintf("Hello, %s!", $filename));
    }
}