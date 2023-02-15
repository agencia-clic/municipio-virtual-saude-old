<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesForwardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_forward', function (Blueprint $table) {
            $table->id('IdEmergencyServicesForward');
            $table->string('IdUsersResponsible');
            $table->integer('IdProcedures');
            $table->integer('IdEmergencyServices');
            $table->integer('IdSpecialtyCategories')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('emergency_services_forward');
    }
}
