<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['waiting', 'reserved']);
            $table->integer('place_number');
            $table->integer('owner')->unsigned();
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');
            $table->integer('parking')->unsigned();
            $table->foreign('parking')->references('id')->on('parkings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
