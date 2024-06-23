<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LaboratoryPatientReservation extends Model
{
    use HasFactory;
    protected $table = 'laboratory_patient_reservations';
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'total_price',
        'test_date',
        'reservation_id'
    ];

    // relationship
    public function LaboratoryTests() : BelongsToMany
    {
        return $this->belongsToMany(LaboratoryTest::class,  'laboratory_reservation_tests','laboratory_reservation_id','test_id')
                    ->as('laboratory_tests');
    }

    public function reservation() : BelongsTo
    {
        return $this->belongsTo(PatientReservation::class,'reservation_id');
    }
}
