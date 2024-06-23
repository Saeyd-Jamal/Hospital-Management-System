<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PharmacyBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'buy_date',
        'payment_method',
        'total_price',
        'final_profit',
        'reservation_id'
    ];

    //scopes
    public function scopeToday(Builder $builder){
        $builder->where('buy_date',now()->format('Y-M-D'));
    }
    public function scopeReservations(Builder $builder){
        $builder->where('reservation_id','!=',null);
    }

    // relationship
    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(MedicinesStore::class,"bill_medicines",'bill_id','medicine_id')
                            ->withPivot(['price','profit','quantity'])
                            ->using(BillMedicine::class);
    }
    public function reservation() : BelongsTo
    {
        return $this->belongsTo(PatientReservation::class,'reservation_id');
    }
}
