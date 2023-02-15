<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_files', function (Blueprint $table) {
            $table->id('IdEmergencyServicesFiles');
            $table->integer('IdEmergencyServices');
            $table->integer('IdUsersResponsible');
            $table->index(['IdEmergencyServices']);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('path');
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
        Schema::dropIfExists('emergency_services_files');
    }
}
