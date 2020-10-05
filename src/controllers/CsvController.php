<?php

namespace Src\Controllers;

class CsvController extends BaseController
{
    public function handle()
    {
        $filename = $this->hasParameter('file') ? $this->getParameter('file') : 'World';

        $this->getPrinter()->print(sprintf("Hello, %s!", $filename));
    }
}