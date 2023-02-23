<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->enum('sanguine', ['A+', 'A-', 'B+', 'AB+', 'AB-', 'O-', 'O+'])->nullable();
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
                'visible' => 'b',
                'email' => 'contato@agenciaclic.com.br',
                'password' => Hash::make(env('ADMIN_PASS')),
                'status' => 'a',
                'level' => 's'
            ],
            [
                'name' => 'Usuário Sistema',
                'cpf_cnpj' => '13667677057',
                'visible' => 'b',
                'email' => 'usuario.sistema@agenciaclic.com.br',
                'password' => Hash::make(env('ADMIN_PASS')),
                'status' => 'a',
                'level' => 'a'
            ]
        ]);

        // make service unit defull
        if(env('APP_ENV') == 'local'):

            // make users defull
            for ($i = 0; $i < 10; $i++):
                $user = User::factory()->make();
                $userData = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'cpf_cnpj' => $user->cpf_cnpj,
                    'mother' => $user->mother,
                    'status' =>$user->status,
                    'online' => 'f',
                    'active_attendance' => $user->active_attendance,
                    'visible' => 'y',
                    'level' => 'p',
                    'image' => $user->image,
                    'rg' => $user->rg,
                    'phone' => $user->phone,
                    'zip_code' => $user->zip_code,
                    'address' => $user->address,
                    'number' => $user->number,
                    'complement' => $user->complement,
                    'date_birth' => $user->date_birth,
                    'district' => $user->district,
                    'city' => $user->city,
                    'uf_rg' => $user->uf_rg,
                    'crm' => $user->crm,
                    'crn' => $user->crn,
                    'uf_crm' => $user->uf_crm,
                    'uf' => $user->uf,
                    'origin' => $user->origin,
                    'uf_naturalness' => $user->uf_naturalness,
                    'naturalness' => $user->naturalness,
                    'cell' => $user->cell,
                    'voter_registration' => $user->voter_registration,
                    'cns' => $user->cns,
                    'chart' => $user->chart,
                    'breed' => $user->breed,
                    'sex' => $user->sex,
                    'sanguine' => $user->sanguine,
                    'marital_status' => $user->marital_status,
                    'schooling' => $user->schooling,
                ];
            
                DB::table('users')->insert([$userData]);
            endfor;
        endif;


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
