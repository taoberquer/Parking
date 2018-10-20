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
            'user_id' => 1,
            'parking_id' => 1,
        ]);
    }
}
