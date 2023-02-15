<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalizationObservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitalization_observation', function (Blueprint $table) {
            $table->id('IdHospitalizationObservation');
            $table->enum('status', ['a', 'b'])->default('a');
            $table->enum('type', ['h', 'o', 'r'])->comment('internação - observação - reavaliação')->default('h');
            $table->integer('IdEmergencyServices');
            $table->integer('IdUsersResponsible');
            $table->integer('IdUsers');
            $table->integer('IdServiceUnits');
            $table->integer('IdRoomsBeds')->nullable();
            $table->integer('IdRooms')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('hospitalization_observation');
    }
}
