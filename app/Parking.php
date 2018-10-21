<?php

namespace App;

use function date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function var_dump;

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

    public function getPlacesAndWaiting()
    {
        return $this->hasMany('App\Places')
            ->where('created_at', '>=', date('Y-m-d H:i:s', time() - $this->using_time));
    }

    public function getCountPlaces()
    {
        return $this->getPlaces()->count();
    }

    public function getUserPlace($id)
    {
        return $this->hasMany('App\Places')->where('user_id', '=', $id)->orderBy('id', 'desc')->first();
    }

    public static function getUserParkingsById($id)
    {
        $userPlaces = Places::where('user_id', '=', $id)->pluck('parking_id')->toArray();
        return Parking::find($userPlaces);
    }
}
