<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services', function (Blueprint $table) {
            $table->id('IdEmergencyServices');
            $table->enum('status', ['a', 'c', 'rf', 'rd', 'r', 'b'])->comment('a ativo - c cancelado - rf emcaminhado - libearado morte - r liberado ');// active - cancel - release forwarding - release death - release
            $table->integer('IdServiceUnits');
            $table->enum('types', ['acol', 'acol-s', 'atem-s', 'atem','bury', 'c', 'pp'])->comment('acol acolhimento - acol-s em adamento - atem atendimento - atem-s atendimento em andamento - conduta');
            $table->index(['IdServiceUnits']);
            $table->integer('IdUsers')->nullable();
            $table->integer('IdUsersResponsible');
            $table->integer('IdUsersResponsibleMedicare')->nullable();
            $table->integer('IdUsersResponsibleScreenings')->nullable();
            $table->string('users_description')->nullable();
            $table->string('users_date_birth_identified', 11)->nullable();
            $table->enum('users_sex', ['m', 'f'])->nullable();
            $table->enum('forwarding', ['y', 'n'])->default('n');
            $table->string('forwarding_uf', 2)->nullable();
            $table->string('forwarding_county')->nullable();
            $table->string('forwarding_number')->nullable();
            $table->enum('provenance', ['agen', 'amb', 'bom', 'liv', 'mic', 'out', 'poc', 'pom', 'rot', 'sam', 'tu'])->comment('Agente Penitenciário - Ambulância - Bombeiros - Livre Demanda - Microregião - Outros - Polícia Civil - Polícia Militar - Retorno (Mostrar Exame) - SAMU - Trasferencia de Unidade');
            $table->enum('character', ['ele', 'urg', 'trab', 'traj', 'otra', 'oles']);
            $table->enum('accident_work', ['y', 'n'])->default('n');
            $table->string('note')->nullable();
            $table->integer('IdServiceUnitsForwarding')->nullable();
            $table->text('forwarding_reason')->nullable();
            $table->text('discharge_reason')->nullable();
            $table->enum('identified_patient', ['y', 'n']);
            $table->text('cancellation_justification')->nullable()->comment('Justificativa do cancelamento');
            $table->string('escort_name')->nullable();
            $table->string('kinship')->nullable();
            $table->string('IdEmergencyServicesOld')->nullable();;
            $table->string('escort_phone')->nullable();
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
        Schema::dropIfExists('emergency_services');
    }
}