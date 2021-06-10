<?php

namespace App\Exports;
  
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class ExportExcel implements FromCollection
{
    public $collection;
    public function __construct($collection) {
        $this->collection = $collection;

    }
    public function collection()
    {
        return $this->collection;
    }
}