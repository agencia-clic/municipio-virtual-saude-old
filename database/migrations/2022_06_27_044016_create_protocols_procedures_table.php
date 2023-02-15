<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolsProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols_procedures', function (Blueprint $table) {
            $table->id('IdProtocolsProcedures');
            $table->integer('IdProtocols');
            $table->integer('IdProcedures');
            $table->index(['IdProtocols', 'IdProcedures']);
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
        Schema::dropIfExists('protocols_procedures');
    }
}
