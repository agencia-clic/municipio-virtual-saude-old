<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersServiceUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_service_units', function (Blueprint $table) {
            $table->id('IdUsersServiceUnits');
            $table->integer('IdUsers');
            $table->integer('IdServiceUnits');
            $table->timestamps();
        });

        // make users service unit defull
        if(env('APP_ENV') == 'local'):
            DB::table('users_service_units')->insert([
                [
                    'IdUsers' => 2,
                    'IdServiceUnits' => 1,
                ],
                [
                    'IdUsers' => 2,
                    'IdServiceUnits' => 2,
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
        Schema::dropIfExists('users_service_units');
    }
}
