<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;



class Patient extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'patient_id',
        'phone_number',
        'address',
        'date_of_birth',
        'gender',
        'image'
    ];

    // Relationships
    public function reservations(): HasMany
    {
        return $this->hasMany(PatientReservation::class);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if(!$this->image){
            return asset('img/defaultePatient.jpg');
        }
        if(Str::startsWith($this->image, ['http://', 'https://'])){
            return $this->image;
        }
        return asset('storage/'. $this->image);
    }
}
