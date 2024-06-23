<?php

namespace App\Imports;

use App\Models\MedicinesStore;
use App\Models\Patient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicinesStoreImport implements ToModel,WithHeadingRow,SkipsOnError
{
    use SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MedicinesStore([
            'name' => $row['asm_aldoaaa'],
            'description' => $row['osf_lldoaaa'],
            'producing_company' => $row['alshrk_almntg'],
            'end_date' => $row['tarykh_alanthaaa'],
            'quantity' => $row['alkmy'],
            'price_sale' => $row['saar_albyaa'],
            'basic_price' => $row['alsaar_alasasy'],
            'profit' => $row['alrbh']
        ]);
    }
}
