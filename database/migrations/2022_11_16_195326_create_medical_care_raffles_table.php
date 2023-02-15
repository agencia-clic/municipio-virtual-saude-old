<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCareRafflesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_care_raffles', function (Blueprint $table) {
            $table->id('IdMedicalCareRaffles');
            $table->enum('status', ['a', 'b']);
            $table->integer('IdUsers');
            $table->integer('IdEmergencyServices');
            $table->integer('IdServiceUnits');
            $table->integer('IdFlowcharts');
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
        Schema::dropIfExists('medical_care_raffles');
    }
}