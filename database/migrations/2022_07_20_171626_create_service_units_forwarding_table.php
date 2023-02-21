<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceUnitsForwardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_units_forwarding', function (Blueprint $table) {
            $table->id('IdServiceUnitsForwarding');
            $table->integer('IdServiceUnits');
            $table->integer('IdServiceUnitsReceive');
            $table->timestamps();
        });

        // make users service unit defull
        if(env('APP_ENV') == 'local'):
            DB::table('service_units_forwarding')->insert([
                [
                    'IdServiceUnits' => 2,
                    'IdServiceUnitsReceive' => 1,
                ]
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
        Schema::dropIfExists('service_units_forwarding');
    }
}
