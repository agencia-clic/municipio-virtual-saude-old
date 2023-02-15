<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesVitalData extends Model
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
        'IdMedicalSpecialties',
        'weight',
        'heart_rate',
        'height',
        'respiratory_frequency',
        'O2_saturation',
        'blood_pressure',
        'ecg',
        'blood_glucose',
        'flowchart',
        'discriminator',
        'rule_of_pain',
    ];

    protected $primaryKey = 'IdEmergencyServicesVitalData';
    protected $table = 'emergency_services_vital_data';

    public function list($IdEmergencyServices)
    {
        $emergency_services_vital_data = EmergencyServicesVitalData::select('emergency_services_vital_data.*', 'users_responsible.name as responsible')->where('emergency_services_vital_data.IdEmergencyServices', $IdEmergencyServices)->
        leftjoin('users as users_responsible', 'emergency_services_vital_data.IdUsersResponsible', '=', 'users_responsible.IdUsers');
        
        return array("data" => $emergency_services_vital_data->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_vital_data->count());
    }

    public function list_current($IdEmergencyServices)
    {
        return EmergencyServicesVitalData::select('emergency_services_vital_data.*', 'users_responsible.name as responsible')->
        where('emergency_services_vital_data.IdEmergencyServices', $IdEmergencyServices)->
        leftjoin('users as users_responsible', 'emergency_services_vital_data.IdUsersResponsible', '=', 'users_responsible.IdUsers')->first();
    }
}
