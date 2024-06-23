<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class MedicinesStore extends Model
{
    use HasFactory;
    protected $table = "medicines_store";
    protected $fillable = [
        'name',
        'description',
        'producing_company',
        'end_date',
        'medicine_image',
        'quantity',
        'price_sale',
        'basic_price',
        'profit'
    ];

    // relationship
    public function pharmacyBills() : BelongsToMany
    {
        return $this->belongsToMany(PharmacyBill::class,"bill_medicines",'medicine_id','bill_id')->withPivot(['price','profit','quantity']);
    }

    public function getImageUrlAttribute()
    {
        if(!$this->medicine_image){
            return asset('img/defulteDoctorImage.jpg');
        }
        if(Str::startsWith($this->medicine_image, ['http://', 'https://'])){
            return $this->medicine_image;
        }
        return asset('storage/'. $this->medicine_image);
    }
}
