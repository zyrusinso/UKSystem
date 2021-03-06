<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'request_by',
        'request_id',
        'name',
        'initial_rank',
        'target_rank',
        'status',
        'request',
        'handler',
        'tf',
        'payment',
        'ref',
        'payment_method',
        'profit'
    ]; 
}
