<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesConducts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServices',
        'admit_patient',
        'to_forward',
        'procedures',
        'observation',
        'patient_discharge',
        'declaration_presence',
        'medical_certificate',
        'prescription',
        'IdUsersResponsibleInternment',
        'social_security',
        'main_signs',
        'justify_hospitalization',
        'main_results',
        'IdCid10Main',
        'IdCid10Secondary',
        'IdCid10AssociatedCauses',
        'traffic_accident',
        'acid_work',
        'acid_work_path',
        'insurance_company_cnpj',
        'cnae_company',
        'cbor',
        'description_nature_njury',
        'medical_opinion',
        'date_initial_diagnosis',
        'type_observation',
    ];

    protected $primaryKey = 'IdEmergencyServicesConducts';

    public function list($IdEmergencyServices)
    {
        $emergency_services_conducts = EmergencyServicesConducts::where('IdEmergencyServices', $IdEmergencyServices)->first();

        if(!empty($emergency_services_conducts)):
            return $emergency_services_conducts;
        endif;

        EmergencyServicesConducts::create([
            'IdEmergencyServices' => $IdEmergencyServices
        ]);

        return EmergencyServicesConducts::where('IdEmergencyServices', $IdEmergencyServices)->first();
    }

    public function admit_patient_($IdEmergencyServices)
    {
        return AdmitPatientRequests::where('IdEmergencyServices', $IdEmergencyServices)->orderBy('IdAdmitPatientRequests', 'DESC')->first();
    }
}
