<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('IdRooms');
            $table->integer('IdServiceUnits');
            $table->enum('status', ['a', 'b']);
            $table->string('title');
            $table->string('initials');
            $table->integer('IdAccommodations');
            $table->integer('IdFunctionalUnits');
            $table->integer('capacity')->nullable();
            $table->enum('determining_sex', ['m','f','i'])->comment('masculino - feminino - indiferente');
            $table->enum('international_exclusive', ['y', 'n'])->comment('masculino - feminino - indiferente');
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
        Schema::dropIfExists('rooms');
    }
}
