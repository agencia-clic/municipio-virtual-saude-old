<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersMedicalSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_medical_specialties', function (Blueprint $table) {
            $table->id('IdUsersMedicalSpecialties');
            $table->integer('IdUsers');
            $table->integer('IdMedicalSpecialties');
            $table->timestamps();
        });

        // Check if the APP_ENV environment variable is set to "local"
        if (env('APP_ENV') === 'local'):
            // Insert two records with status "b" and service "y"
            DB::table('users_medical_specialties')->insert([
                [
                    'IdUsers' => 2,
                    'IdMedicalSpecialties' => 1,
                ],
                [
                    'IdUsers' => 2,
                    'IdMedicalSpecialties' => 2,
                ],
            ]);
        endif;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_medical_specialties');
    }
}
