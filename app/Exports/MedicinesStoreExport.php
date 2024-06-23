<?php

namespace App\Exports;

use App\Models\MedicinesStore;
use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MedicinesStoreExport implements FromCollection,WithHeadings
{
    public function headings() : array
    {
        return [
            'اسم الدواء',
            'وصف للدواء',
            'الشركة المنتجة',
            'تاريخ الانتهاء',
            'الكمية',
            'سعر البيع',
            'السعر الاساسي',
            'الربح',
        ];

    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MedicinesStore::select(['name','description','producing_company','end_date','quantity','price_sale','basic_price','profit'])->get();
    }
}
