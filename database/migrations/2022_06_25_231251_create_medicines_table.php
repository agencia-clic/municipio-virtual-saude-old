<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id("IdMedicines");
            $table->enum('status', ['a', 'b']);
            $table->text('IdMedicationAdministrations');
            $table->text('IdMedicationUnits');
            $table->text('IdMedicationDilutions')->nullable();
            $table->text('IdMedicationInfusao')->nullable();
            $table->text('IdMedicationActivePrinciples')->nullable();
            $table->float('amount')->nullable()->default(0);
            $table->text('title');
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
        Schema::dropIfExists('medicines');
    }
}
