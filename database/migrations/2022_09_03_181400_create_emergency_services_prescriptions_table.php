<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_prescriptions', function (Blueprint $table) {
            $table->id('IdEmergencyServicesPrescriptions');
            $table->integer('IdEmergencyServices');
            $table->index(['IdEmergencyServices']);
            $table->integer('IdUsersResponsible');
            $table->integer('IdMedicationPrescriptions')->nullable();
            $table->integer('IdMedicationUnits')->nullable();
            $table->integer('IdMedicationAdministrations')->nullable();
            $table->enum('type', ['n', 't', 'c'])->nullable();
            $table->text('note');
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('emergency_services_prescriptions');
    }
}