<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMedicalSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_specialties', function (Blueprint $table) {
            $table->id('IdMedicalSpecialties');
            $table->enum('status', ['a', 'b'])->default('a');
            $table->string('code');
            $table->string('title');
            $table->enum('service', ['y', 'n'])->default('n');
            $table->timestamps();
        });

        // Check if the APP_ENV environment variable is set to "local"
        if (env('APP_ENV') === 'local'):
            // Insert two records with status "b" and service "y"
            DB::table('medical_specialties')->insert([
                [
                    'status' => 'a',
                    'code' => '225125',
                    'title' => 'Médico Clínico',
                    'service' => 'y',
                ],
                [
                    'status' => 'a',
                    'code' => '225270',
                    'title' => 'Médico Ortopedista',
                    'service' => 'y',
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
        Schema::dropIfExists('medical_specialties');
    }
}