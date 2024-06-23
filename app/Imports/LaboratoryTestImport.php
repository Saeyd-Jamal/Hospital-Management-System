<?php

namespace App\Imports;

use App\Models\LaboratoryTest;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LaboratoryTestImport implements ToModel,WithHeadingRow,SkipsOnError
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
        return new LaboratoryTest([
            'name_test' => $row['asm_alfhs'],
            'description' => $row['alosf'],
            'price' => $row['alsaar'],
        ]);
    }
}
