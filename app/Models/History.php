<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'request_by',
        'request_id',
        'name',
        'initial_rank',
        'target_rank',
        'request',
        'handler',
        'tf',
        'payment',
        'order',
        'diamonds',
        'coins',
        'ml_id',
        'ign',
        'name_of_skin',
        'type_of_skin',
        'ml_to_follow',
        'follow_status',
        'schedule',
        'ref',
        'status',
        'payment_method',
        'profit',
    ];

}
