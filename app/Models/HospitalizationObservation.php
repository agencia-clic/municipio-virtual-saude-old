<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class HospitalizationObservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'type',
        'IdEmergencyServices',
        'IdUsersResponsible',
        'IdServiceUnits',
        'IdUsers',
        'IdRoomsBeds',
        'IdRooms',
        'note',
    ];

    protected $primaryKey = 'IdHospitalizationObservation';
    protected $table = 'hospitalization_observation';

    public function list()
    {
        $hospitalization_observation = HospitalizationObservation::where('hospitalization_observation.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->where('hospitalization_observation.status', 'a')->where('type', 'h')->
        select(
            'hospitalization_observation.*', 
            'rooms.title as rooms', 
            'rooms_beds.title as rooms_beds', 
            'users_responsible.name as responsible_doctor',
            'admit_patient_requests.IdUsersResponsible as IdUsersResponsibleDoctor',
            'users_patient.name as patient', 'users_patient.date_birth as date_birth_patient',
            'emergency_services.created_at as created_at_services',
            'users_responsible_medical_care.name as users_responsible_care',
            'emergency_services_diagnostics.date as date_diagnostics',
            'cid10.title as cid10', 'cid10.code as code_cid10'
        )->

        join('emergency_services', 'hospitalization_observation.IdEmergencyServices', '=', 'emergency_services.IdEmergencyServices')->
        join('admit_patient_requests', 'emergency_services.IdEmergencyServices', '=', 'admit_patient_requests.IdEmergencyServices')->
        leftjoin('users as users_responsible', 'admit_patient_requests.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        join('users as users_patient', 'admit_patient_requests.IdUsers', '=', 'users_patient.IdUsers')->
        leftjoin('rooms', 'hospitalization_observation.IdRooms', '=', 'rooms.IdRooms')->
        leftjoin('medical_care', 'hospitalization_observation.IdEmergencyServices', '=', 'medical_care.IdEmergencyServices')->
        leftjoin('users as users_responsible_medical_care', 'medical_care.IdUsersResponsible', '=', 'users_responsible_medical_care.IdUsers')->
        leftjoin('emergency_services_diagnostics', 'emergency_services.IdEmergencyServices', '=', 'emergency_services_diagnostics.IdEmergencyServices')->
        leftjoin('cid10', 'emergency_services_diagnostics.IdCid10', '=', 'cid10.IdCid10')->
        leftjoin('rooms_beds', 'hospitalization_observation.IdRoomsBeds', '=', 'rooms_beds.IdRoomsBeds')->groupBy('hospitalization_observation.IdHospitalizationObservation');

        return array("data" => $hospitalization_observation->paginate(env('PAGE_NUMBER')), "count" => $hospitalization_observation->count());
    }

    public function list_observation($data)
    {
        $hospitalization_observation = HospitalizationObservation::where('hospitalization_observation.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->where('hospitalization_observation.status', 'a')->whereIn('type', $data['type'])->
        select(
            'hospitalization_observation.*',
            'users_responsible.name as responsible_doctor',
            'hospitalization_observation.IdUsersResponsible as IdUsersResponsibleDoctor',
            'users_patient.name as patient', 'users_patient.date_birth as date_birth_patient',
            'emergency_services.created_at as created_at_services',
            'users_responsible_medical_care.name as users_responsible_care',
            'emergency_services_conducts.note_observation'
        )->
        join('emergency_services', 'hospitalization_observation.IdEmergencyServices', '=', 'emergency_services.IdEmergencyServices')->
        leftjoin('medical_care', 'hospitalization_observation.IdEmergencyServices', '=', 'medical_care.IdEmergencyServices')->
        join('users as users_patient', 'emergency_services.IdUsers', '=', 'users_patient.IdUsers')->
        leftjoin('users as users_responsible', 'hospitalization_observation.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        leftjoin('users as users_responsible_medical_care', 'medical_care.IdUsersResponsible', '=', 'users_responsible_medical_care.IdUsers')->
        leftjoin('emergency_services_conducts', 'emergency_services.IdEmergencyServices', '=', 'emergency_services_conducts.IdEmergencyServices')->
        groupBy('hospitalization_observation.IdHospitalizationObservation');

        return array("data" => $hospitalization_observation->paginate(env('PAGE_NUMBER')), "count" => $hospitalization_observation->count());
    }

    public function check_next()
    {
        return DB::table('view_emergency_services_medications_num_checkeds')->where('IdEmergencyServices', $this->IdEmergencyServices)->orderByRaw('CASE WHEN num_check = 0 THEN num_check END DESC, CASE WHEN next_run < now() THEN num_check END DESC')->first();
    }
}