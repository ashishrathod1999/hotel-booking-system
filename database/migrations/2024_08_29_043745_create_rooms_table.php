<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_no')->unique();
            $table->enum('room_type', ['Deluxe', 'Luxury', 'Royal']);
            $table->boolean('bathtub')->default(false);
            $table->boolean('balcony')->default(false);
            $table->boolean('mini_bar')->default(false);
            $table->integer('max_occupancy');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
