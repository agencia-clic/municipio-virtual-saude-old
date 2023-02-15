<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call', function (Blueprint $table) {
            $table->id('IdCall');
            $table->integer('IdServiceUnits');
            $table->integer('IdEmergencyServices');
            $table->integer('IdUsersResponsible');
            $table->integer('IdUsers');
            $table->index(['IdServiceUnits']);
            $table->string('sala');
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
        Schema::dropIfExists('call');
    }
}
