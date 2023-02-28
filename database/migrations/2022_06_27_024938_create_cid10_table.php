<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCid10Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid10', function (Blueprint $table) {
            $table->id('IdCid10');
            $table->enum('status', ['a', 'b']);
            $table->string('title');
            $table->string('code')->unique();
            $table->timestamps();
        });

        // make Cid10 defull
        if(env('APP_ENV') === 'local'):
            DB::table('cid10')->insert([
                [
                    'code' => '001057',
                    'title' => 'bAlgumas doenças infecciosas e parasitárias',
                    'status' => 'a',
                ],
                [
                    'code' => '001',
                    'title' => 'Cólera',
                    'status' => 'a',
                ],
                [
                    'code' => '002',
                    'title' => 'Febres tifóide e paratifóide',
                    'status' => 'a',
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
        Schema::dropIfExists('cid10');
    }
}
