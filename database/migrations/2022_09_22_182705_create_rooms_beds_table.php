<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_beds', function (Blueprint $table) {
            $table->id('IdRoomsBeds');
            $table->integer('IdServiceUnits');
            $table->enum('status', ['o','l', 'd', 'b'])->comment('ocupado - limpeza - disponivel - block');
            $table->integer('IdRooms');
            $table->string('title');
            $table->string('code')->nullable();
            $table->text('note')->nullable();
            $table->integer('IdUsers')->nullable();
            $table->text('note_users')->nullable();
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
        Schema::dropIfExists('rooms_beds');
    }
}
