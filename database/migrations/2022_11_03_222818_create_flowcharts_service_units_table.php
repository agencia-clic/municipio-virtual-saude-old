<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowchartsServiceUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowcharts_service_units', function (Blueprint $table) {
            $table->id('IdFlowchartsServiceUnits');
            $table->integer('IdServiceUnits');
            $table->integer('IdFlowcharts');
            $table->enum('status', ['a','b']);
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
        Schema::dropIfExists('flowcharts_service_units');
    }
}