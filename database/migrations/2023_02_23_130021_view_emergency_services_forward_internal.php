<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ViewEmergencyServicesForwardInternal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW view_emergency_services_forward_internal AS
            SELECT
                emergency_services_forward_internal.IdEmergencyServicesForwardInternal, emergency_services_forward_internal.IdEmergencyServices, emergency_services_forward_internal.type as internal_type, emergency_services_forward_internal.IdUsersResponsibleExecution, emergency_services_forward_internal.created_at,
                users.name, users.IdUsers,
                users_execution.name as responsible_execution,
                users.date_birth as users_date_birth,
                screenings.classification, screenings.complaints,
                IF(screenings.condition_pregnant = 'ON', 1, 0) AS is_pregnant
            FROM 
                emergency_services_forward_internal
                JOIN emergency_services ON emergency_services_forward_internal.IdEmergencyServices = emergency_services.IdEmergencyServices
                JOIN users ON emergency_services.IdUsers = users.IdUsers
                JOIN screenings ON emergency_services_forward_internal.IdScreenings = screenings.IdScreenings
                LEFT JOIN users as users_execution ON emergency_services_forward_internal.IdUsersResponsibleExecution = users.IdUsers
            WHERE 
                emergency_services_forward_internal.status = 'a'
            ORDER BY 
                screenings.classification DESC, 
                is_pregnant DESC, 
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, users.date_birth, CURDATE()) > 60 THEN 0
                    ELSE 1
                END ASC, 
                TIMESTAMPDIFF(YEAR, users.date_birth, CURDATE()) ASC;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_emergency_services_forward_internal");
    }
}
