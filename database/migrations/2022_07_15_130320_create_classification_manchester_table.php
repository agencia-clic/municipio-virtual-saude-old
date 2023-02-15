<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationManchesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classification_manchester', function (Blueprint $table) {
            $table->id('IdClassificationManchester');
            $table->integer('IdTopics');
            $table->integer('IdTopicsChecks');
            $table->integer('IdEmergencyServices');
            $table->integer('IdUsersResponsible');
            $table->integer('IdUsers');
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
        Schema::dropIfExists('classification_manchester');
    }
}
