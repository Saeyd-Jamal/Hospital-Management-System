<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientsExport implements FromCollection,WithHeadings
{
    public function headings() : array
    {
        return [
            'اسم المريض',
            'رقم الهوية',
            'رقم الهاتف',
            'العنوان',
            'تاريخ الميلاد',
            'الجنس',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Patient::select('name','patient_id','phone_number','address','date_of_birth','gender')->get();
    }
}
