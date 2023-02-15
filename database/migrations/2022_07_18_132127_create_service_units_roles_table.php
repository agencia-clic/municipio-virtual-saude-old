<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceUnitsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_units_roles', function (Blueprint $table) {
            $table->id('IdServiceUnitsRoles');
            $table->integer('IdServiceUnits');
            $table->integer('IdUsers');
            $table->integer('IdUsersServiceUnits');
            $table->index(['IdUsersServiceUnits']);
            $table->string('route');
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
        Schema::dropIfExists('service_units_roles');
    }
}