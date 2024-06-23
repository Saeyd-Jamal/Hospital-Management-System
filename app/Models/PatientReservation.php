<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientReservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id','doctor_id','section_id','date','price','status','notes'
    ];


    // Relationship
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class,'patient_id','patient_id');
    }

    public function bill() : HasOne
    {
        return $this->hasOne(PharmacyBill::class,'reservation_id');
    }
}
