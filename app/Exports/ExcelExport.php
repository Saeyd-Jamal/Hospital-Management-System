<?php

namespace App\Exports;

use App\Models\LaboratoryTest;
use App\Models\MedicinesStore;
use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection,WithHeadings
{
    protected $model;
    protected $colmesNames;
    protected $colmesNamesHeading;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($model,$colmesNames,$colmesNamesHeading){
        $this->model = $model;
        $this->colmesNames = $colmesNames;
        $this->colmesNamesHeading = $colmesNamesHeading;
    }
    public function headings() : array
    {
        return $this->colmesNamesHeading;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->model::select($this->colmesNames)->get();
    }
}
