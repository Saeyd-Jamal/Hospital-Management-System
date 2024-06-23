<?php

namespace App\Imports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PatientsImport implements ToModel,WithHeadingRow,SkipsOnError
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
        return new Patient([
            'name' => $row['asm_almryd'],
            'patient_id' => $row['rkm_alhoy'],
            'phone_number' => $row['rkm_alhatf'],
            'address' => $row['alaanoan'],
            'date_of_birth' => $row['tarykh_almylad'],
            'gender' => $row['algns'],
        ]);
    }
}
