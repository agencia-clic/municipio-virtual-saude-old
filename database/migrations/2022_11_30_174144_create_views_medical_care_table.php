<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsMedicalCareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        \DB::unprepared("
            CREATE VIEW views_medical_care AS

            SELECT
                emergency_services.*,
                Max(screenings.IdScreenings) AS last_screenings,
                screenings.condition_pregnant,
                screenings.classification,
                screenings.IdFlowcharts,
                screenings.complaints,
                screenings.IdUsersResponsible as IdUsersResponsibleScreeningsCare,
                users.date_birth,
                users.name as users_name,
                users_responsible_service.name as responsible_service,
                users.cpf_cnpj as users_cpf_cnpj,
                (SELECT COUNT(IdMedicalCare) FROM medical_care where medical_care.IdEmergencyServices = emergency_services.IdEmergencyServices) as medical_care_count
            FROM
                emergency_services
                LEFT JOIN users ON users.IdUsers = emergency_services.IdUsers
                LEFT JOIN medical_care_raffles ON medical_care_raffles.IdEmergencyServices = emergency_services.IdEmergencyServices
                LEFT JOIN users as users_responsible_service ON users_responsible_service.IdUsers = medical_care_raffles.IdUsers
                LEFT JOIN screenings ON screenings.IdEmergencyServices = emergency_services.IdEmergencyServices AND screenings.IdUsers = emergency_services.IdUsers
            WHERE
                emergency_services.status='a' and
                emergency_services.types = 'atem'

            GROUP BY
                emergency_services.IdEmergencyServices
            ORDER BY
                screenings.classification,
                users.date_birth DESC,
                    CASE condition_pregnant 
                        WHEN NULL THEN 0 
                        WHEN NOT NULL THEN 1
                        END 
            DESC
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('DROP VIEW IF EXISTS views_medical_care');
    }
}
