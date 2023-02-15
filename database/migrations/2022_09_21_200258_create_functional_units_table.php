<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionalUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functional_units', function (Blueprint $table) {
            $table->id('IdFunctionalUnits');
            $table->enum('status', ['a','b']);
            $table->integer('IdServiceUnits');
            $table->string('title');
            $table->string('initials');
            $table->integer('capacity')->nullable();
            $table->integer('IdBeds');
            $table->integer('IdClinics')->nullable();
            $table->string('sector')->nullable();
            $table->integer('IdTypeFunctionalUnits');
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
        Schema::dropIfExists('functional_units');
    }
}
