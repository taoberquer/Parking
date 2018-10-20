<?php

use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert([
            'status' => 'waiting',
            'place_number' => 5,
            'owner' => 1,
            'parking' => 1,
        ]);
    }
}
