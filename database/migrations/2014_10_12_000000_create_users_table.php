<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('IdUsers');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('cpf_cnpj')->unique()->nullable();
            $table->string('mother')->nullable();
            $table->enum('status', ['a', 'b'])->default('a');
            $table->enum('online', ['o', 'f'])->default('f');
            $table->enum('active_attendance', ['a', 'b'])->nullable()->default('b');
            $table->enum('visible', ['y', 'b'])->default('y');
            $table->enum('level', ['a', 's', 'u', 'p'])->default('p');
            $table->index(['level']);
            $table->string('image')->nullable();
            $table->string('rg')->nullable();
            $table->string('phone')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('uf_rg', 5)->nullable();
            $table->string('crm', 45)->nullable();
            $table->string('crn', 45)->nullable();
            $table->string('uf_crm', 5)->nullable();
            $table->string('uf')->nullable();
            $table->string('origin')->nullable();
            $table->string('uf_naturalness',5)->nullable();
            $table->string('naturalness')->nullable();
            $table->string('cell')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('voter_registration')->nullable();
            $table->string('cns', 15)->nullable();
            $table->string('chart', 11)->nullable();
            $table->enum('breed', ['B', 'N', 'P', 'A', 'I', 'O'])->nullable();
            $table->enum('sex', ['f', 'm', 'o'])->nullable();
            $table->enum('sanguine', ['A+', 'A-', 'B+', 'AB+', 'AB-', 'O-', 'O+', 'n'])->nullable();
            $table->enum('marital_status', ['c', 's', 'v'])->nullable();
            $table->enum('schooling', ['ca', 'c', 'ef', 'efc', 't', 'si', 's'])->nullable();
            $table->string('occupation')->nullable();
            $table->text('rules')->nullable();
            $table->string('password')->nullable();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
        });

        // make users defull
        DB::table('users')->insert([
            [
                'name' => 'Agência clic',
                'cpf_cnpj' => '14414603000144',
                'email' => 'contato@agenciaclic.com.br',
                'password' => Hash::make('QNU#ARDxfwbak@b8jBuSzNJN%3Km594n%zm3G^Pwp#@i9^S4j4aeZ$dwhw$v!vezMQku&R!ZuRZ8*m%MHfPt7PU#cp'),
                'status' => 'a',
                'level' => 's'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
