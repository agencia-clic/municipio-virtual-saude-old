<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_medications', function (Blueprint $table) {
            $table->id('IdEmergencyServicesMedications');
            $table->integer('IdEmergencyServices');
            $table->integer('IdMedicationGroups');
            $table->integer('IdUsersResponsible');
            $table->integer('IdUsersResponsibleCheckEdite')->comment('responsavel trocar medicação')->nullable();
            $table->index(['IdMedicationGroups']);
            $table->enum('status', ['a', 'b', 'bf', 'bs', 'bn'])->commment('a: aberto bf: falta bs: subistituido bn:nego prescrição')->default('a');
            $table->enum('type', ['u', 'i', 'f'])->comment('dose u: unica i:intervalo f:frequência');
            $table->time('break')->comment('intervalo')->nullable();
            $table->integer('IdMedicines');
            $table->integer('IdMedicationAdministrations')->nullable();
            $table->integer('IdMedicationUnits')->nullable();
            $table->integer('IdMedicationDilutions')->nullable();
            $table->integer('infusao')->nullable();
            $table->integer('number_time_day')->comment('Number of times a day')->nullable();
            $table->text('guidance');
            $table->text('un_measure')->nullable();
            $table->float('amount', 10, 2)->default(0);
            $table->text('note_finalize')->nullable();
            $table->text('note_denied_medication')->nullable();
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
        Schema::dropIfExists('emergency_services_medications');
    }
}
