<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServices extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdServiceUnits',
        'IdMedicalSpecialties',
        'IdEmergencyServicesOld',
        'IdUsersResponsible',
        'IdServiceUnitsForwarding',
        'forwarding_reason',
        'types',
        'IdUsers',
        'users_description',
        'users_date_birth_identified',
        'identified_patient',
        'users_sex',
        'forwarding',
        'forwarding_uf',
        'forwarding_county',
        'forwarding_number',
        'provenance',
        'character',
        'accident_work',
        'note',
        'escort_name',
        'kinship',
        'escort_phone'
    ];

    protected $primaryKey = 'IdEmergencyServices';

    public function list($filter)
    {
        $emergency_services = EmergencyServices::
        where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->

        select('emergency_services.*', 'users.name as users_name', 'users.cpf_cnpj as users_cpf_cnpj', 'users_responsible.name as responsible', 'users_screenings.name as users_screenings_name')->
        leftjoin('users', 'emergency_services.IdUsers', '=', 'users.IdUsers')->
        leftjoin('users as users_responsible', 'emergency_services.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        leftjoin('users as users_screenings', 'emergency_services.IdUsersResponsibleScreenings', '=', 'users_screenings.IdUsers')->orderByDesc('IdEmergencyServices');

        if(!empty($filter['IdEmergencyServices'])):
            $emergency_services = $emergency_services->where('IdEmergencyServices', $filter['IdEmergencyServices']);
        endif;

        if(!empty($filter['IdUsers'])):
            $emergency_services = $emergency_services->where('emergency_services.IdUsers', $filter['IdUsers']);
        endif;

        if(!empty($filter['status'])):
            $emergency_services = $emergency_services->where('emergency_services.status', $filter['status']);
        endif;

        if(!empty($filter['types'])):
            $emergency_services = $emergency_services->where('types', $filter['types']);
        endif;

        if(!empty($filter['name'])):
            $emergency_services = $emergency_services->where('users.name', 'LIKE', "%{$filter['title']}%");
        endif;

        if(!empty($filter['cpf_cnpj'])):
            $emergency_services = $emergency_services->where('cpf_cnpj', 'LIKE', preg_replace('/[^0-9]/', '', $filter['cpf_cnpj'])."%");
        endif;

        return $emergency_services->paginate(env('PAGE_NUMBER'));
    }

    public function list_historic($filter)
    {
        $emergency_services = EmergencyServices::

        select('emergency_services.*', 'service_units.name as units', 'users.name as users_name', 'users.date_birth as users_date_birth', 'users.cpf_cnpj as users_cpf_cnpj', 'users_responsible.name as responsible')->
        leftjoin('users', 'emergency_services.IdUsers', '=', 'users.IdUsers')->
        leftjoin('service_units', 'emergency_services.IdServiceUnits', '=', 'service_units.IdServiceUnits')->
        leftjoin('users as users_responsible', 'emergency_services.IdUsersResponsible', '=', 'users_responsible.IdUsers')->orderByDesc('IdEmergencyServices');

        if(!empty($filter['IdEmergencyServices'])):
            $emergency_services = $emergency_services->where('IdEmergencyServices', $filter['IdEmergencyServices']);
        endif;

        if(!empty($filter['IdUsers'])):
            $emergency_services = $emergency_services->where('emergency_services.IdUsers', $filter['IdUsers']);
        endif;

        if(!empty($filter['status'])):
            $emergency_services = $emergency_services->where('emergency_services.status', $filter['status']);
        endif;

        if(!empty($filter['types'])):
            $emergency_services = $emergency_services->where('types', $filter['types']);
        endif;

        if(!empty($filter['name'])):
            $emergency_services = $emergency_services->where('users.name', 'LIKE', "%{$filter['title']}%");
        endif;

        if(!empty($filter['cpf_cnpj'])):
            $emergency_services = $emergency_services->where('cpf_cnpj', 'LIKE', preg_replace('/[^0-9]/', '', $filter['cpf_cnpj'])."%");
        endif;

        return  $emergency_services->get();
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return EmergencyServices::select(
                'emergency_services.*',
                'users.name as users_name', 
                'users.date_birth as users_date_birth',
                'users.cpf_cnpj as users_cpf_cnpj'
            )->
            leftjoin('users', 'emergency_services.IdUsers', '=', 'users.IdUsers')->where('IdEmergencyServices', $id)->first();
        endif;
    }

    public function list_select()
    {
        return EmergencyServices::where('status', 'a')->get();
    }

    public function last_screenings()
    {
        return $this->hasOne(Screenings::class, 'IdEmergencyServices')->select('screenings.created_at', 'screenings.classification', 'screenings.complaints')->orderByDesc('IdScreenings')->first();   
    }

    public function last_medical_care()
    {
        return $this->hasOne(MedicalCare::class, 'IdEmergencyServices')->select('medical_care.created_at', 'medical_care.guidelines')->orderByDesc('IdMedicalCare')->first();   
    }

    public function screenings()
    {
        return $this->hasOne(Screenings::class, 'IdEmergencyServices')->orderByDesc('IdScreenings')->select('screenings.*', 'users.name as responsible')->
        leftjoin('users', 'screenings.IdUsersResponsible', '=', 'users.IdUsers')->get();
    }

    public function conducts()
    {
        return EmergencyServicesConducts::where('IdEmergencyServices', $this->IdEmergencyServices)->get();
    }

    public function call()
    {
        return $this->hasOne(Call::class, 'IdEmergencyServices')->select('call.*', 'users.name as responsible')->leftJoin('users', 'call.IdUsersResponsible', '=', 'users.IdUsers')->latest()->first();
    }

    public function diagnostics()
    {
        //emergency services diagnostics
        return $emergency_services_diagnostics = EmergencyServicesDiagnostics::select('emergency_services_diagnostics.*', 'cid10.title as cid10', 'cid10.code')->where('IdEmergencyServices', $this->IdEmergencyServices)->orderBy('IdEmergencyServicesDiagnostics')->
        leftjoin('cid10', 'emergency_services_diagnostics.IdCid10', '=', 'cid10.IdCid10')->
        first();
    }

    public function vital_data()
    {
       return (new EmergencyServicesVitalData())->list($this->IdEmergencyServices);
    }

    public function medication_groups()
    {
        return MedicationGroups::select('medication_groups.*', 'users_responsible.name as responsible')->
        leftjoin('users as users_responsible', 'medication_groups.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        where('medication_groups.IdEmergencyServices', $this->IdEmergencyServices)->get();
    }

    public function medical_care()
    {
        return $this->hasOne(MedicalCare::class, 'IdEmergencyServices')->select('medical_care.*', 'users.name as responsible')->leftjoin('users', 'medical_care.IdUsersResponsible', '=', 'users.IdUsers')->get();
    }
}
