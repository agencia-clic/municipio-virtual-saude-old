<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_groups', function (Blueprint $table) {
            $table->id('IdMedicationGroups');
            $table->enum('status', ['a','b'])->default('a');
            $table->integer('IdEmergencyServices');
            $table->integer('IdUsersResponsible');
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
        Schema::dropIfExists('medication_groups');
    }
}