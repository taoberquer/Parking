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
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time()),
        ]);
    }
}
