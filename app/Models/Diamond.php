<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diamond extends Model
{
    protected $fillable = [
        'date',
        'request_by',
        'request_id',
        'name',
        'user_id',
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

    public function profileImage(){
        $imagePath = ($this->image)? $this->image : 'img/avatar.jpg';

        return '/storage/' .$imagePath;
    }

}
