<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_materials', function (Blueprint $table) {
            $table->id('IdEmergencyServicesMaterials');
            $table->integer('IdUsersResponsible');
            $table->integer('IdEmergencyServices');
            $table->index(['IdEmergencyServices']);
            $table->integer('IdMaterials');
            $table->text('note')->nullable();
            $table->float('amount', 10, 2)->default(0);
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
        Schema::dropIfExists('emergency_services_materials');
    }
}
