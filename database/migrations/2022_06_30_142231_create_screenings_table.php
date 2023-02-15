<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->id('IdScreenings');
            $table->integer('IdServiceUnits');
            $table->integer('IdEmergencyServices');
            $table->integer('IdFlowcharts')->nullable();
            $table->integer('IdUsers')->nullable();
            $table->integer('IdUsersResponsible');
            $table->index(['IdServiceUnits']);
            $table->enum('type', ['a', 'e', 'l']);
            $table->enum('status', ['a', 'n'])->default('a');
            $table->string('temperature')->nullable();
            $table->string('weight', 5)->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('height', 5)->nullable();
            $table->string('respiratory_frequency', 5)->nullable();
            $table->string('O2_saturation')->nullable();
            $table->string('blood_pressure', 5)->nullable();
            $table->string('ecg', 45)->nullable();
            $table->string('blood_glucose', 11)->nullable();
            $table->string('flowchart')->nullable();
            $table->string('discriminator')->nullable();
            $table->integer('rule_of_pain')->nullable();
            $table->string('condition_hypertensive', 2)->nullable();
            $table->string('condition_diabetic', 2)->nullable();
            $table->string('condition_heart_disease', 2)->nullable();
            $table->string('condition_pregnant', 2)->nullable();
            $table->string('gestational_age', 2)->nullable();
            $table->text('complaints')->nullable();
            $table->enum('classification', [4, 3, 2, 1, 0])->nullable();//emergency - very urgent - urgent - little urgent - not urgent
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
        Schema::dropIfExists('screenings');
    }
}
