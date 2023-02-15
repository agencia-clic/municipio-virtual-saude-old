<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesMedicationChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_medication_checks', function (Blueprint $table) {
            $table->enum('type', ['a', 'c'])->comment('Aguaradar - checar')->default('c');
            $table->id('IdEmergencyServicesMedicationChecks');
            $table->integer('IdEmergencyServicesMedications');
            $table->integer('IdUsersResponsible');
            $table->integer('IdEmergencyServices');
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
        Schema::dropIfExists('emergency_services_medication_checks');
    }
}
