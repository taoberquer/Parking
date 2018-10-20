<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = [
        'name', 'maximum_place', 'using_time'
    ];

    public function getPlaces()
    {
        return $this->hasMany('App\Places');
    }

    public function getCountPlaces()
    {
        return $this->countPlaces()->count();
    }

    protected function countPlaces()
    {
        return $this->hasOne('App\Places')->selectRaw('parking_id, count(*) as count')->groupBy('parking_id');
    }
}
