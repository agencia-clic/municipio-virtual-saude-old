<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesProcedures extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServices',
        'IdProcedures',
        'IdUsersResponsible',
        'IdProceduresGroups',
        'note',
        'status',
        'IdUsersResponsibleRunProcedures',
        'medical_report',
        'date_run',
        'note_refused',
    ];

    protected $primaryKey = 'IdEmergencyServicesProcedures';

    public function list($IdEmergencyServices, $IdProceduresGroups)
    {
        $emergency_services_procedures = EmergencyServicesProcedures::select('emergency_services_procedures.*', 'procedures.title as procedures', 'procedures.code', 'users_responsible.name as responsible', 'users_responsible_run.name as responsible_run')->
        join('procedures', 'emergency_services_procedures.IdProcedures', '=', 'procedures.IdProcedures')->
        join('users as users_responsible', 'emergency_services_procedures.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        leftjoin('users as users_responsible_run', 'emergency_services_procedures.IdUsersResponsibleRunProcedures', '=', 'users_responsible_run.IdUsers')->
        where('emergency_services_procedures.IdEmergencyServices', $IdEmergencyServices);

        $emergency_services_procedures = $emergency_services_procedures->where('IdProceduresGroups', $IdProceduresGroups);

        return $emergency_services_procedures->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('emergency_services_procedures')->where('IdEmergencyServicesProcedures', $id)->first();
        endif;
    }

    //existe
    public function existe_email($email, $email_current)
    {
        return (!empty($email)) && $email != $email_current
            ?  DB::table('emergency_services_procedures')->where('email', $email)->doesntExist()
            : true;
    }
}
