<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerEmergencyServicesAfterUpdateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER trigger_emergency_services_after_update_trigger AFTER UPDATE ON emergency_services FOR EACH ROW BEGIN

                IF(NEW.status = 'b') THEN 
                    UPDATE hospitalization_observation SET status='b' WHERE IdEmergencyServices = NEW.IdEmergencyServices;
                    UPDATE medical_care SET status='b' WHERE IdEmergencyServices = NEW.IdEmergencyServices;
                    UPDATE rooms_beds SET status='b', IdUsers=NULL, note_users='' WHERE IdUsers = NEW.IdUsers;
                    UPDATE admit_patient_requests SET status='g' WHERE status <> 'h' AND IdEmergencyServices = NEW.IdEmergencyServices;
                    UPDATE emergency_services_procedures SET status='refused' WHERE status <> 'executed' AND IdEmergencyServices = NEW.IdEmergencyServices;
                    UPDATE emergency_services_medications SET status='b' WHERE status='a' AND IdEmergencyServices = NEW.IdEmergencyServices;
                    UPDATE medical_care_raffles SET status='b' WHERE status='a' AND IdEmergencyServices = NEW.IdEmergencyServices;
                END IF;

            END 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger_emergency_services_after_update_trigger');
    }
}
