<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewEmergencyServicesMedicationsNumCheckedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

    /**
     * Run the migrations.
     *
     * @return string
     */
    private function createView(): string
    {
        $this->down();

        return "
        CREATE VIEW view_emergency_services_medications_num_checkeds AS 
        SELECT
            emergency_services_medications.IdEmergencyServices,
            emergency_services_medications.IdMedicationGroups,
            (SELECT COUNT(IdEmergencyServicesMedicationChecks) FROM emergency_services_medication_checks WHERE emergency_services_medication_checks.IdEmergencyServicesMedications = emergency_services_medications.IdEmergencyServicesMedications) as num_check,
                
            (SELECT DATE_ADD(emergency_services_medication_checks.created_at, INTERVAL TIME_TO_SEC(emergency_services_medications.break) second) FROM emergency_services_medication_checks WHERE emergency_services_medication_checks.IdEmergencyServicesMedications = emergency_services_medications.IdEmergencyServicesMedications ORDER BY IdEmergencyServicesMedicationChecks DESC LIMIT 1) as next_run
        FROM 
            emergency_services_medications
        WHERE 
            emergency_services_medications.status = 'a'
        ";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('DROP VIEW IF EXISTS view_emergency_services_medications_num_checkeds');
    }
}
