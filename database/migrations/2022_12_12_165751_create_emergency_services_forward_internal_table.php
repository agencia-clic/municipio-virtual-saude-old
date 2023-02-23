<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesForwardInternalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_forward_internal', function (Blueprint $table) {
            $table->id('IdEmergencyServicesForwardInternal');
            $table->integer('IdMedicalSpecialties');
            $table->integer('IdServiceUnits');
            $table->integer('IdEmergencyServices')->nullable();
            $table->integer('IdUsersResponsible');
            $table->integer('IdMedicalCare')->nullable();
            $table->enum('status', ['a', 'b', 'e']);
            $table->enum('type', ['r', 'c', 't'])->comment('r - reavaliação // c - consulta // t - triagem');
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
        Schema::dropIfExists('emergency_services_forward_internal');
    }
}
