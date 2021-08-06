<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Normal extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'request_by',
        'name',
        'name_of_skin',
        'type_of_skin',
        'status',
        'ml_to_follow',
        'follow_status',
        'schedule',
        'payment',
        'ref',
        'payment_method',
        'profit',
    ];
}
