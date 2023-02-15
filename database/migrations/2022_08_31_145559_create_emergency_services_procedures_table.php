<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_procedures', function (Blueprint $table) {
            $table->id('IdEmergencyServicesProcedures');
            $table->enum('status', ['open', 'accepted', 'executed', 'refused']);
            $table->integer('IdEmergencyServices');
            $table->integer('IdProcedures');
            $table->integer('IdUsersResponsible');
            $table->integer('IdProceduresGroups');
            $table->index(['IdEmergencyServices']);
            $table->text('note')->nullable();
            $table->integer('IdUsersResponsibleRunProcedures')->nullable();
            $table->text('medical_report')->nullable();
            $table->dateTime('date_run')->nullable();
            $table->text('note_refused')->nullable();
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
        Schema::dropIfExists('emergency_services_procedures');
    }
}
