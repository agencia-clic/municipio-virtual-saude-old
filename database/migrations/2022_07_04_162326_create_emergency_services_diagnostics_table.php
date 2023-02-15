<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_diagnostics', function (Blueprint $table) {
            $table->id('IdEmergencyServicesDiagnostics');
            $table->integer('IdEmergencyServices');
            $table->integer('IdUsers');
            $table->integer('IdMedicalCare')->nullable();
            $table->integer('IdUsersResponsible');
            $table->integer('IdCid10');
            $table->enum('status', ['a', 'b']);
            $table->enum('traffic_accident',['y', 'n'])->default('n');
            $table->enum('work_related',['y', 'n'])->default('n');
            $table->enum('violent_attack',['y', 'n'])->default('n');
            $table->enum('notifiable_disease',['y', 'n'])->default('n');
            $table->enum('diagnostics',['p', 'd'])->default('p');
            $table->enum('main_diagnosis',['y', 'n'])->default('n');
            $table->enum('respiratory_symptomatic',['y', 'n'])->default('n');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('emergency_services_diagnostics');
    }
}
