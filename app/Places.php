<?php

namespace App;

use Carbon\Carbon;
use function dd;
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

        return gmdate('d \J\o\u\r\(\s\) H:i:s', $RemainingTimeInSeconds);
    }
}
