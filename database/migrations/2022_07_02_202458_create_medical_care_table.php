<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_care', function (Blueprint $table) {
            $table->id('IdMedicalCare');
            $table->enum('status', ['a', 'b']);
            $table->integer('IdEmergencyServices');
            $table->integer('IdUsers')->nullable();
            $table->integer('IdUsersResponsible');
            $table->text('anamnesis')->nullable();
            $table->text('guidelines')->nullable();
            $table->enum('bodily_injury', ['y', 'n'])->default('n')->nullable();
            $table->enum('aggression', ['y', 'n'])->default('n')->nullable();
            $table->enum('firearm_aggression', ['y', 'n'])->default('n')->nullable();
            $table->enum('weapon_flaps', ['y', 'n'])->default('n')->nullable();
            $table->enum('self_extermination', ['y', 'n'])->default('n')->nullable();
            $table->enum('sexual_violence', ['y', 'n'])->default('n')->nullable();
            $table->enum('forensic_examination', ['y', 'n'])->default('n')->nullable();
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
        Schema::dropIfExists('medical_care');
    }
}
