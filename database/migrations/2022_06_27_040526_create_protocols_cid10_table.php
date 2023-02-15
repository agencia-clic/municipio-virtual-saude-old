<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolsCid10Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols_cid10', function (Blueprint $table) {
            $table->id('IdProtocolsCid10');
            $table->integer('IdProtocols');
            $table->integer('IdCid10');
            $table->index(['IdProtocols', 'IdCid10']);
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
        Schema::dropIfExists('protocols_cid10');
    }
}
