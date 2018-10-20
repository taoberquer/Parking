<?php

namespace App;

use function date;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = [
        'name', 'maximum_place', 'using_time'
    ];

    public function getPlaces()
    {
        return $this->hasMany('App\Places')
            ->where('created_at', '>=', date('Y-m-d H:i:s', time() - $this->using_time))
            ->where('status', '=', 'reserved');
    }

    public function getCountPlaces()
    {
        return $this->getPlaces()->count();
    }
}
