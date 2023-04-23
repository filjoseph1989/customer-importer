<?php

namespace App\Imports;

interface DataImporterInterface
{
    public function import(array $data);
}