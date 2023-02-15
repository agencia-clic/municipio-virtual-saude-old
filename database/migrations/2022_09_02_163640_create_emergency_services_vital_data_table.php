<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesVitalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_vital_data', function (Blueprint $table) {
            $table->id('IdEmergencyServicesVitalData');
            $table->integer('IdUsersResponsible');
            $table->integer('IdEmergencyServices');
            $table->string('temperature')->nullable();
            $table->string('weight', 5)->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('height', 5)->nullable();
            $table->string('respiratory_frequency', 5)->nullable();
            $table->string('O2_saturation')->nullable();
            $table->string('blood_pressure', 5)->nullable();
            $table->string('ecg', 45)->nullable();
            $table->string('blood_glucose', 11)->nullable();
            $table->string('flowchart')->nullable();
            $table->string('discriminator')->nullable();
            $table->integer('rule_of_pain')->nullable();
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
        Schema::dropIfExists('emergency_services_vital_data');
    }
}
