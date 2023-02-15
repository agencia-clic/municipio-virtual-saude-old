<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolsMedicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols_medication', function (Blueprint $table) {
            $table->id('IdProtocolsMedication');
            $table->integer('IdProtocols');
            $table->integer('IdMedicines');
            $table->index(['IdProtocols', 'IdMedicines']);
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
        Schema::dropIfExists('protocols_medication');
    }
}
