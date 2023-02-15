<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_diseases', function (Blueprint $table) {
            $table->id('IdUsersDiseases');
            $table->Integer('IdUsers');
            $table->Integer('IdMedicationActivePrinciples')->nullable();
            $table->index(['IdUsers']);
            $table->enum('type', ['a', 'b'])->default('a');
            $table->enum('type_allergies', ['m', 'o'])->default('m')->nullable();
            $table->string('text')->nullable();
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
        Schema::dropIfExists('user_diseases');
    }
}
