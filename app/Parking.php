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
        return Places::where('parking_id', '=', $this->id)
            ->orderBy('created_at', 'desc')
            ->get()->unique('user_id')
            ->where('status', '<>', 'abandoned');
    }

    public function getCountPlaces()
    {
        return $this->getPlaces()->count();
    }

    public function getUserPlace($id)
    {
        return $this->getUserPlaces($id)->first();
    }

    public function getUserPlaces($id)
    {
        return $this->hasMany('App\Places')->where('user_id', '=', $id)->orderBy('id', 'desc');
    }

    public static function getUserParkingsById($id)
    {
        $userPlaces = Places::where('user_id', '=', $id)->pluck('parking_id')->toArray();
        return Parking::find($userPlaces);
    }


    public static function refreshPlaces($parkingId)
    {
        $userIds = Places::where('parking_id', '=', $parkingId)
            ->orderBy('created_at', 'desc')
            ->get()->unique('user_id')
            ->where('status', '=', 'waiting')
            ->pluck('user_id')
            ->toArray();

        $parking = Parking::find($parkingId);

        foreach ($userIds as $userId) {
            Places::assignPlace(
                [
                'parking_id' => $parkingId,
                'user_id' => $userId,
                ]
            );
        }
    }
}
