<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_entries', function (Blueprint $table) {
            $table->id('IdMedicationEntries');
            $table->enum('status', ['a', 'b'])->default('a');
            $table->enum('type', ['a', 'm'])->default('m');
            $table->integer('IdUsersResponsible');
            $table->integer('IdServiceUnits');
            $table->index(['IdServiceUnits']);
            $table->date('receipt_date');
            $table->text('text')->nullable();
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
        Schema::dropIfExists('medication_entries');
    }
}
