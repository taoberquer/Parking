<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    protected $fillable = [
        'status', 'created_at', 'place_number', 'user_id', 'parking_id'
    ];
}
