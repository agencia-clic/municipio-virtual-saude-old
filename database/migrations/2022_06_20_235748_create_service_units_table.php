<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServiceUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_units', function (Blueprint $table) {
            $table->id("IdServiceUnits");
            $table->string("name");
            $table->string("email");
            $table->string("code");
            $table->string("acronym");
            $table->enum('status', ['a','b']);
            $table->integer("IdUsers");
            $table->string('phone', 15);
            $table->integer('zip_code');
            $table->string('address');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('district');
            $table->string('city');
            $table->string('uf');
            $table->timestamps();
        });

        // make service unit defull
        if(env('APP_ENV') == 'local'):
            DB::table('service_units')->insert([
                [
                    'name' => 'Unidade de Atendimento Teste',
                    'status' => 'a',
                    'code' => '0001',
                    'acronym' => 'TESTE',
                    'email' => 'teste@agenciaclic.com.br',
                    'IdUsers' => 1,
                    'phone' => '(99) 9999-9999',
                    'zip_code' => '0000000',
                    'number' => '000',
                    'address' => 'teste teste teste',
                    'complement' => 'address teste',
                    'district' => 'teste',
                    'city' => 'Teste',
                    'uf' => 'TS',
                ],
                [
                    'name' => 'Unidade de Atendimento Teste 2',
                    'status' => 'a',
                    'code' => '0001',
                    'acronym' => 'TESTE2',
                    'email' => 'teste2@agenciaclic.com.br',
                    'IdUsers' => 1,
                    'phone' => '(99) 9999-9999',
                    'zip_code' => '0000000',
                    'number' => '000',
                    'address' => 'teste2 teste2 teste2',
                    'complement' => 'address teste2 ',
                    'district' => 'teste2',
                    'city' => 'Teste2',
                    'uf' => 'TS2',
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
        Schema::dropIfExists('service_units');
    }
}
