<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsBedsHistoricTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_beds_historic', function (Blueprint $table) {
            $table->id('IdRoomsBedsHistoric');
            $table->integer('IdServiceUnits');
            $table->integer('IdRooms');
            $table->integer('IdRoomsBeds');
            $table->enum('status', ['o','l', 'd', 'b'])->comment('ocupado - limpeza - disponivel - block');
            $table->integer('IdUsers')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('rooms_beds_historic');
    }
}