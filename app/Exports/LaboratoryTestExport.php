<?php

namespace App\Exports;

use App\Models\LaboratoryTest;
use App\Models\MedicinesStore;
use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaboratoryTestExport implements FromCollection,WithHeadings
{
    public function headings() : array
    {
        return [
            'اسم الفحص',
            'الوصف',
            'السعر',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LaboratoryTest::select('name_test','description','price')->get();
    }
}
