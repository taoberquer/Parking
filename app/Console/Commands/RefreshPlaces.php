<?php

namespace App\Console\Commands;

use App\Parking;
use Illuminate\Console\Command;

class RefreshPlaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'places:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Met à jour les places en attentes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parkings = Parking::all();

        foreach ($parkings as $parking) {
            Parking::refreshPlaces($parking->id);
        }
    }
}
