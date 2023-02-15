<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceUnitsForwardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_units_forwarding', function (Blueprint $table) {
            $table->id('IdServiceUnitsForwarding');
            $table->integer('IdServiceUnits');
            $table->integer('IdServiceUnitsReceive');
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
        Schema::dropIfExists('service_units_forwarding');
    }
}
