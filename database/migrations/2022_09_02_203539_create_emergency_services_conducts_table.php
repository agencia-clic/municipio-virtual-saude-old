<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyServicesConductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_services_conducts', function (Blueprint $table) {
            $table->id('IdEmergencyServicesConducts');
            $table->integer('IdEmergencyServices');
            $table->string('admit_patient')->nullable();
            $table->string('to_forward')->nullable();
            $table->string('procedures')->nullable();
            $table->string('unit_transfer')->nullable();
            $table->string('observation')->nullable();
            $table->text('note_observation')->nullable();
            $table->string('patient_discharge')->nullable();
            $table->string('declaration_presence')->nullable();
            $table->string('medical_certificate')->nullable();
            $table->string('prescription')->nullable();
            $table->integer('IdUsersResponsibleInternment')->nullable();
            $table->string('social_security')->comment('Vínculo com a Previdência')->nullable();
            $table->string('main_signs')->comment('Principais Sinais e Sintomas Clínicos:')->nullable();
            $table->string('justify_hospitalization')->comment('Condições que justificam a internação:')->nullable();
            $table->string('main_results')->comment('Principais Resultados de Provas Diagnósticas(Resultado dos exames realizados):')->nullable();
            $table->integer('IdCid10Main')->comment('CID10 principal')->nullable();
            $table->integer('IdCid10Secondary')->comment('CID10 principal')->nullable();
            $table->integer('IdCid10AssociatedCauses')->comment('CID10 Causas Associadas')->nullable();
            $table->string('traffic_accident')->comment('Acidente de Trânsito')->nullable();
            $table->string('acid_work')->comment('Acid. de Trabalho Típico')->nullable();
            $table->string('acid_work_path')->comment('Acid. de Trabalho Trajeto')->nullable();
            $table->string('insurance_company_cnpj')->comment('CNPJ Seguradora:')->nullable();
            $table->string('no_ticket')->comment('')->nullable();
            $table->string('serie')->comment('')->nullable();
            $table->string('insurance_cnpj')->comment('CNPJ Empresa')->nullable();
            $table->string('cnae_company')->comment('CNAE Empresa')->nullable();
            $table->string('cbor')->comment('CBOR')->nullable();
            $table->string('description_nature_njury')->comment('Descrição Natureza da Lesão')->nullable();
            $table->date('date_initial_diagnosis')->nullable();
            $table->string('medical_opinion')->comment('Parecer Médico')->nullable();
            $table->enum('type_patient_discharge', ['m', 'ap', 'c', 'e', 'i', 'o', 'p', 'en'])->comment('melhorado - a pedido - curado - evasão - inalterado - obito - piorado - encaminhado para outro hospital')->nullable();
            $table->string('note_patient_discharge')->nullable();
            $table->string('unit_transfer_reason_reason')->nullable();
            $table->enum('type_observation', ['h','o','r'])->comment('internação - observação - reavaliação')->nullable();
            $table->integer('IdServiceUnitsUnitTransfer')->nullable();
            $table->dateTime('date_time_patient_discharge')->nullable();
            $table->dateTime('date_time_comparison_statement')->nullable();
            $table->time('up_until_comparison_statement')->nullable();
            $table->text('note_comparison_statement')->nullable();
            $table->date('date_medical_certificate')->nullable();
            $table->text('medical_report')->nullable();
            $table->integer('number_days_medical_certificate')->nullable();
            $table->enum('period_medical_certificate', ['m','t','n'])->comment('manhã - tarde - noite')->nullable();
            $table->integer('IdCid10MedicalCertificate')->nullable();
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
        Schema::dropIfExists('emergency_services_conducts');
    }
}
