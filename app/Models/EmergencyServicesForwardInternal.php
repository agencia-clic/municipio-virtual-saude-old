<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesForwardInternal extends Model
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
        'IdUsersResponsibleExecution',
        'IdMedicalCare',
        'IdMedicalSpecialties',
        'status',
        'IdScreenings',
        'IdServiceUnits',
        'type',
        'note',
    ];

    protected $primaryKey = 'IdEmergencyServicesForwardInternal';
    protected $table = "emergency_services_forward_internal";

    public function list($IdEmergencyServices)
    {
        $emergency_services_forward_internal = EmergencyServicesForwardInternal::where('emergency_services_forward_internal.IdEmergencyServices', $IdEmergencyServices)->

        select(
            'emergency_services_forward_internal.*', 
            'users_responsible_medical_care.name as medical_care_responsible', 
            'users_responsible.name as responsible',
            'medical_specialties.title as specialties',
            'flowcharts.title as flowcharts'
        )->

        leftjoin('flowcharts', 'emergency_services_forward_internal.IdFlowcharts', '=', 'flowcharts.IdFlowcharts')->
        leftjoin('medical_specialties', 'emergency_services_forward_internal.IdMedicalSpecialties', '=', 'medical_specialties.IdMedicalSpecialties')->
        leftjoin('medical_care', 'emergency_services_forward_internal.IdMedicalCare', '=', 'medical_care.IdMedicalCare')->
        leftjoin('users as users_responsible_medical_care', 'medical_care.IdUsersResponsible', '=', 'users_responsible_medical_care.IdUsers')->
        leftjoin('users as users_responsible', 'emergency_services_forward_internal.IdUsersResponsible', '=', 'users_responsible.IdUsers');
        
        return array("data" => $emergency_services_forward_internal->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_forward_internal->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return EmergencyServicesForwardInternal::where('IdEmergencyServicesForwardInternal', $id)->first();
        endif;
    }
}
