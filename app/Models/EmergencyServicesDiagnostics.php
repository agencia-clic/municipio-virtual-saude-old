<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesDiagnostics extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdUsers',
        'status',
        'IdEmergencyServices',
        'IdMedicalCare',
        'IdUsersResponsible',
        'IdCid10',
        'traffic_accident',
        'work_related',
        'violent_attack',
        'notifiable_disease',
        'diagnostics',
        'main_diagnosis',
        'respiratory_symptomatic',
        'date',
    ];

    protected $primaryKey = 'IdEmergencyServicesDiagnostics';

    public function list($IdEmergencyServices)
    {
        $emergency_services_diagnostics = EmergencyServicesDiagnostics::where('emergency_services_diagnostics.IdEmergencyServices', $IdEmergencyServices)->
        select('emergency_services_diagnostics.*', 'cid10.title', 'users.name as responsible', 'cid10.code')->
        leftjoin('users', 'emergency_services_diagnostics.IdUsersResponsible', '=', 'users.IdUsers')->
        leftjoin('cid10', 'emergency_services_diagnostics.IdCid10', '=', 'cid10.IdCid10');
        
        return array("data" => $emergency_services_diagnostics->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_diagnostics->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return EmergencyServicesDiagnostics::where('IdEmergencyServicesDiagnostics', $id)->select('emergency_services_diagnostics.*', 'cid10.title', 'cid10.code')->leftjoin('cid10', 'emergency_services_diagnostics.IdCid10', '=', 'cid10.IdCid10')->first();
        endif;
    }
}
