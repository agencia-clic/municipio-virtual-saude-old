<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmitPatientRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admit_patient_requests', function (Blueprint $table) {
            $table->id('IdAdmitPatientRequests');
            $table->integer('IdServiceUnits');
            $table->index(['IdServiceUnits', 'status']);
            $table->integer('IdUsers');
            $table->integer('IdUsersResponsible');
            $table->integer('IdUsersResponsibleAdmit');
            $table->integer('IdEmergencyServices');
            $table->integer('IdEmergencyServicesConducts');
            $table->enum('status', ['w', 'a','n', 'g', 'h'])->comment('aguardando - aprovado - negado - desistir - internado')->default('w');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admit_patient_requests');
    }
}
