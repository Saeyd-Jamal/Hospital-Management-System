<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BillMedicine extends Pivot
{
    use HasFactory;
    protected $table = 'bill_medicines';
    public $incremmenting = true;

    protected $fillable = [
        'quantity', 'medicine_id', 'bill_id','price','profit'
    ];
}
