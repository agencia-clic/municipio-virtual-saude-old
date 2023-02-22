<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class ProceduresGroups extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServices',
        'IdUsersResponsible',
    ];

    protected $primaryKey = 'IdProceduresGroups';

    public function list($IdEmergencyServices)
    {
        $procedures_groups = ProceduresGroups::select('procedures_groups.*', 'users_responsible.name as responsible')->
        leftjoin('users as users_responsible', 'procedures_groups.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        where('procedures_groups.IdEmergencyServices', $IdEmergencyServices);

        return $procedures_groups->paginate(env('PAGE_NUMBER'));
    }

    public function list_run($data)
    {
        $procedures_groups = ProceduresGroups::select('procedures_groups.*', 'users_responsible.name as responsible', 'users_patient.name as patient')->

        leftjoin('users as users_responsible', 'procedures_groups.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        join('emergency_services', 'procedures_groups.IdEmergencyServices', '=', 'emergency_services.IdEmergencyServices')->
        leftjoin('users as users_patient', 'emergency_services.IdUsers', '=', 'users_patient.IdUsers')->
        where('emergency_services.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->
        join('emergency_services_procedures', 'procedures_groups.IdProceduresGroups', '=', 'emergency_services_procedures.IdProceduresGroups')->
        groupBy('procedures_groups.IdProceduresGroups')->
        where('emergency_services.status', 'a');

        if(!empty($data['IdEmergencyServicesProcedures'])):
            $procedures_groups  = $procedures_groups->where('emergency_services_procedures.IdEmergencyServicesProcedures', $data['IdEmergencyServicesProcedures']);
        endif;

        if(!empty($data['status'])):
            $procedures_groups  = $procedures_groups->where('emergency_services_procedures.status', $data['status']);
        endif;

        if(!empty($data['name'])):
            $procedures_groups  = $procedures_groups->where('users_patient.name', 'LIKE', "{$data['name']}%");
        endif;

        if(!empty($data['cpf_cnpj'])):
            $procedures_groups  = $procedures_groups->where('users_patient.cpf_cnpj', 'LIKE', "{$data['cpf_cnpj']}%");
        endif;

        return $procedures_groups->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('procedures_groups')->where('IdProceduresGroups', $id)->first();
        endif;
    }

    //existe
    public function existe_email($email, $email_current)
    {
        return (!empty($email)) && $email != $email_current
            ?  DB::table('procedures_groups')->where('email', $email)->doesntExist()
            : true;
    }

    public function procedures_wait($status = "open")
    {
        return $this->hasOne(EmergencyServicesProcedures::class, 'IdProceduresGroups')->where('status', $status)->count();
    }
}
