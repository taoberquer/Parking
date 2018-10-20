<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    protected $fillable = [
        'status', 'place_number', 'user_id', 'parking_id'
    ];

    public function getOwner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
