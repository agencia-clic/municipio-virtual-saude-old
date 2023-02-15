<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\EmergencyServicesForwardInternal;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicalCare extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServices',
        'IdUsers',
        'IdUsersResponsible',
        'type',
        'anamnesis',
        'diagnostics',
        'procedures',
        'medicate_patient',
        'anamnesis_text',
        'guidelines',
        'bodily_injury',
        'aggression',
        'firearm_aggression',
        'weapon_flaps',
        'self_extermination',
        'sexual_violence',
        'forensic_examination',
    ];
    
    protected $primaryKey = 'IdMedicalCare';
    protected $table = "medical_care";

    public function list($filter)
    {
        $medical_care = MedicalCare::select('medical_care.*', 'users_responsible.name as responsible')
        ->leftjoin('users as users_responsible', 'medical_care.IdUsersResponsible', '=', 'users_responsible.IdUsers');

        if(!empty($filter['IdMedicalCare'])):
            $medical_care = $medical_care->where('IdMedicalCare', $filter['IdMedicalCare']);
        endif;

        if(!empty($filter['IdEmergencyServices'])):
            $medical_care = $medical_care->where('IdEmergencyServices', $filter['IdEmergencyServices']);
        endif;

        if(!empty($filter['status'])):
            $medical_care = $medical_care->where('status', $filter['status']);
        endif;

        if(!empty($filter['title'])):
            $medical_care = $medical_care->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $medical_care->paginate(env('PAGE_NUMBER')), "count" => $medical_care->count());
    }

    public function list_care($filter)
    {
        $emergency_services = DB::table('views_medical_care')->select('views_medical_care.*')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);
        $emergency_services_forward_internal = EmergencyServicesForwardInternal::where('status', 'a')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);

        if(!empty($filter['status'])):
            $emergency_services = $emergency_services->where('views_medical_care.status', $filter['status']);
        endif;

        if(!empty($filter['IdFlowcharts'])):
            $emergency_services_forward_internal = $emergency_services_forward_internal->where('IdFlowcharts', $filter['IdFlowcharts']);
        endif;

        $specialty_users = auth()->user()->specialty_users(auth()->user()->IdUsers);

        $IdMedicalSpecialties = array();
        if(!empty($specialty_users)):
            foreach($specialty_users as $val):
                $IdMedicalSpecialties[] = $val->IdMedicalSpecialties;
            endforeach;

            $emergency_services_forward_internal = $emergency_services_forward_internal->orWhereIn('IdMedicalSpecialties', $IdMedicalSpecialties);
        endif;

        $emergency_services_forward_internal = $emergency_services_forward_internal->get();

        $IdEmergencyServices = array();
        $IdEmergencyServicesForwardInternal = array();
        if(!empty($emergency_services_forward_internal)):
            foreach($emergency_services_forward_internal as $val):
                $IdEmergencyServices[] = $val->IdEmergencyServices;
                $IdEmergencyServicesForwardInternal[$val->IdEmergencyServices] = $val;
            endforeach;
            $emergency_services = $emergency_services->whereIn('IdEmergencyServices', $IdEmergencyServices);
        endif;

        return array("data" => $emergency_services->paginate(env('PAGE_NUMBER')), "emergency_services_forward_internal" => $IdEmergencyServicesForwardInternal, "count" => $emergency_services->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medical_care')->where('IdMedicalCare', $id)->select('medical_care.*', 'users_responsible.name as responsible')->leftjoin('users as users_responsible', 'medical_care.IdUsersResponsible', '=', 'users_responsible.IdUsers')->first();
        endif;
    }

    public function list_select()
    {
        return MedicalCare::where('status', 'a')->get();
    }
}
