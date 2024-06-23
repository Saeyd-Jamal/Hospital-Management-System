<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Section extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'logo_image'
    ];

    // relationship

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if(!$this->logo_image){
            return 'https://via.placeholder.com/500/500';
        }
        if(Str::startsWith($this->logo_image, ['http://', 'https://'])){
            return $this->logo_image;
        }
        return asset('storage/'. $this->logo_image);
    }

}
