<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class LaboratoryTest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_test',
        'description',
        'price',
        'file_test',
    ];

    // relationship
    public function laboratoryReservations() : BelongsToMany
    {
        return $this->belongsToMany(LaboratoryPatientReservation::class, 'laboratory_reservation_tests','test_id','laboratory_reservation_id')
                    ->as('laboratory_reservation')->using(LaboratoryReservationTest::class);;
    }
//file_test_url
    public function getFileTestUrlAttribute()
    {
        if(!$this->file_test){
            return '';
        }
        if(Str::startsWith($this->file_test, ['http://', 'https://'])){
            return $this->file_test;
        }
        return asset('storage/'. $this->file_test);
    }
}
