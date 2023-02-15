<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesPrescriptions extends Model
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
        'IdMedicationPrescriptions',
        'IdMedicationUnits',
        'IdMedicationAdministrations',
        'type',
        'note',
        'amount',
    ];

    protected $primaryKey = 'IdEmergencyServicesPrescriptions';

    public function list($IdEmergencyServices)
    {
        $emergency_services_prescriptions = EmergencyServicesPrescriptions::where('emergency_services_prescriptions.IdEmergencyServices', $IdEmergencyServices)->
        select('emergency_services_prescriptions.*', 'medication_prescriptions.title as prescriptions', 'medication_administrations.title as administrations', 'medication_units.title as units')->
        leftjoin('medication_units', 'emergency_services_prescriptions.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->
        leftjoin('medication_administrations', 'emergency_services_prescriptions.IdMedicationAdministrations', '=', 'medication_administrations.IdMedicationAdministrations')->
        leftjoin('medication_prescriptions', 'emergency_services_prescriptions.IdMedicationPrescriptions', '=', 'medication_prescriptions.IdMedicationPrescriptions');
        
        return array("data" => $emergency_services_prescriptions->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_prescriptions->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return EmergencyServicesPrescriptions::where('IdEmergencyServicesPrescriptions', $id)->select('emergency_services_prescriptions.*', 'medication_prescriptions.title')->leftjoin('medication_prescriptions', 'emergency_services_prescriptions.IdMedicationPrescriptions', '=', 'medication_prescriptions.IdMedicationPrescriptions')->first();
        endif;
    }
}
