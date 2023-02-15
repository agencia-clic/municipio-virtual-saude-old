<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationEntriesRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_entries_registrations', function (Blueprint $table) {
            $table->id('IdMedicationEntriesRegistrations');
            $table->integer('IdMedicines');
            $table->enum('status', ['a','b'])->default('b');
            $table->integer('IdMedicationEntries')->nullable();
            $table->index(['IdMedicationEntries']);
            $table->string('lote')->nullable();
            $table->date('date_venc');
            $table->text('code')->nullable();
            $table->integer('amount');
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
        Schema::dropIfExists('medication_entries_registrations');
    }
}
