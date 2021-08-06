<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'request_by',
        'request_id',
        'name',
        'order',
        'diamonds',
        'coins',
        'ml_id',
        'ign',
        'ref',
        'status',
        'payment_method',
        'profit',
    ];
    
}
