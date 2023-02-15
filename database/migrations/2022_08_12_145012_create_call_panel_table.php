<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallPanelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_panel', function (Blueprint $table) {
            $table->id('IdCallPanel');
            $table->enum('status', ['a', 'b']);
            $table->integer('IdServiceUnits');
            $table->index(['IdServiceUnits']);
            $table->string('title');
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
        Schema::dropIfExists('call_panel');
    }
}
