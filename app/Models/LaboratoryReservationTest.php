<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LaboratoryReservationTest extends Pivot
{
    use HasFactory;

    protected $table = 'laboratory_reservation_tests';
    public $incremmenting = true;
    protected $fillable = [
        'laboratory_reservation_id',
        'test_id',
        'quantity',
        'test_price',
        'noots',
        'file',
    ];
}
