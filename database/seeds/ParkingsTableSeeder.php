<?php

use Illuminate\Database\Seeder;

class ParkingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parkings')->insert([
            'name' => 'Gambetta',
            'maximum_place' => 50,
            'using_time' => 500,
        ]);
    }
}
