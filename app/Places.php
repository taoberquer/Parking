<?php

namespace App;

use Carbon\Carbon;
use function count;
use function dd;
use Illuminate\Database\Eloquent\Model;
use function in_array;
use function var_dump;

class Places extends Model
{
    protected $fillable = [
        'status', 'place_number', 'user_id', 'parking_id'
    ];

    public function getOwner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getPlaceNumber($using_time)
    {
        if ($this->getStatus($using_time) == 'Réservé') {
            return $this->place_number;
        }

        if ($this->getStatus($using_time) == 'En attente') {
            return $this->getWaitingPlace() . ' (dans la file)';
        }

        return null;
    }

    public function getStatus($using_time)
    {
        if ($this->status == 'waiting') {
            return 'En attente';
        }

        $remainingTime = $this->created_at < Carbon::now()->subSeconds($using_time);

        if ($this->status == 'reserved' and !$remainingTime) {
            return 'Réservé';
        }

        return 'Expiré';
    }

    public function getRemainingTime($using_time)
    {
        if ($this->created_at < Carbon::now()->subSeconds($using_time) or $this->status != 'reserved') {
            return null;
        }
        $RemainingTimeInSeconds = $this->created_at->diffInSeconds(Carbon::now()->subSeconds($using_time));

        return gmdate('H:i:s', $RemainingTimeInSeconds);
    }

    protected function getWaitingPlace()
    {
        $places = Places::where('parking_id', '=', $this->parking_id)
            ->orderBy('created_at', 'desc')
            ->get()->unique('user_id')
            ->where('status', '=', 'waiting')
            ->where('created_at', '<', $this->created_at)
            ->pluck('user_id')
            ->toArray();

        return count($places) + 1;
    }

    public static function assignPlace(array $parameters)
    {
        $parking = Parking::find($parameters['parking_id']);
        $unavailablePlaceNumber = Places::getUnavailablePlaceNumber($parameters['parking_id']);
        $randomPlace = null;
        $status = 'waiting';

        if (count($unavailablePlaceNumber) < $parking->maximum_place) {
            do {
                $randomPlace = rand(1, $parking->maximum_place);
            } while (in_array($randomPlace, $unavailablePlaceNumber));

            $status = 'reserved';
        }

        $place = new Places([
            'status' => $status,
            'place_number' => $randomPlace,
            'user_id' => $parameters['user_id'],
            'parking_id' => $parameters['parking_id'],
        ]);

        $place->save();
    }

    protected static function getUnavailablePlaceNumber($parking_id)
    {
        $unavailablePlaceNumber = array();

        $parking = Parking::find($parking_id);

        $places = Places::where('parking_id', '=', $parking_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('user_id')
            ->pluck('created_at', 'place_number')
            ->toArray();

        foreach ($places as $index => $value) {
            if (!empty($index) and $value >= Carbon::now()->subSeconds($parking->using_time)) {
                $unavailablePlaceNumber[] = $index;
            }
        }
        return $unavailablePlaceNumber;
    }
}
