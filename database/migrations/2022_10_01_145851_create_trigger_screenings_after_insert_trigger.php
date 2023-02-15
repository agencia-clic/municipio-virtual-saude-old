<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerScreeningsAfterInsertTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER trigger_screenings_after_insert_trigger AFTER INSERT ON screenings FOR EACH ROW BEGIN
                INSERT INTO emergency_services_vital_data (created_at, updated_at, IdEmergencyServices, IdUsersResponsible, weight, temperature, heart_rate, height, respiratory_frequency, O2_saturation, blood_pressure, ecg, blood_glucose, flowchart, discriminator, rule_of_pain) VALUES (NOW(), NOW(), NEW.IdEmergencyServices, NEW.IdUsersResponsible, NEW.weight, NEW.temperature, NEW.heart_rate, NEW.height, NEW.respiratory_frequency, NEW.O2_saturation, NEW.blood_pressure, NEW.ecg, NEW.blood_glucose, NEW.flowchart, NEW.discriminator, NEW.rule_of_pain);
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
        Schema::dropIfExists('trigger_screenings_after_insert_trigger');
    }
}
