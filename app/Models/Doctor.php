<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Doctor extends Authenticatable
{
    use HasFactory,Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'doctor_id',
        'username',
        'password',
        'phone_number',
        'section_id',
        'image',
        'status',
        'last_active',
        'specialty'
    ];

    // relationship
    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class)->withDefault([
            'name' => "No Section",
        ]);
    }

    public function reservations() : HasMany
    {
        return $this->hasMany(PatientReservation::class);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if(!$this->image){
            return asset('img/defulteDoctorImage.jpg');
        }
        if(Str::startsWith($this->image, ['http://', 'https://'])){
            return $this->image;
        }
        return asset('storage/'. $this->image);
    }
}
