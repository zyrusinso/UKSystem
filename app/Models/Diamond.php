<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diamond extends Model
{
    protected $fillable = [
        'date',
        'requested_by',
        'name',
        'order_value',
        'diamonds_value',
        'coins_value',
        'ml_id',
        'ign',
        'ref',
        'status',
        'payment_method',
        'profit_value',
    ];

    public function search(){
        return $this->Model;
    }
}
