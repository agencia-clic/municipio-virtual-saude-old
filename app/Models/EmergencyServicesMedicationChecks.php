<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesMedicationChecks extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServicesMedications',
        'IdUsersResponsible',
        'IdEmergencyServices',
        'type',
        'created_at',
    ];

    protected $primaryKey = 'IdEmergencyServicesMedicationChecks';


    public function list($IdEmergencyServices, $IdMedicationGroups){

        $emergency_services_medication_checks = EmergencyServicesMedicationChecks::
        
        select('emergency_services_medications.*', 'medication_units.title as units', 'medicines.title as medicines', 'medication_administrations.title as administrations', 'medication_dilutions.title as dilutions', 'users_responsible.name as responsible', 'users_responsible.name as responsible', 'users_responsible_run.name as responsible_run', 'emergency_services_medication_checks.created_at as check_created_at', 'emergency_services_medication_checks.IdUsersResponsible as IdUsersResponsibleRun')->

        join('emergency_services_medications', 'emergency_services_medication_checks.IdEmergencyServicesMedications', '=', 'emergency_services_medications.IdEmergencyServicesMedications')->
        join('medicines', 'emergency_services_medications.IdMedicines', '=', 'medicines.IdMedicines')->
        join('medication_units', 'medicines.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->
        leftjoin('users as users_responsible', 'emergency_services_medications.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        leftjoin('users as users_responsible_run', 'emergency_services_medication_checks.IdUsersResponsible', '=', 'users_responsible_run.IdUsers')->

        leftjoin('medication_administrations', 'emergency_services_medications.IdMedicationAdministrations', '=', 'medication_administrations.IdMedicationAdministrations')->
        leftjoin('medication_dilutions', 'emergency_services_medications.IdMedicationDilutions', '=', 'medication_dilutions.IdMedicationDilutions')->
        
        where('IdMedicationGroups', $IdMedicationGroups);

        return array("data" => $emergency_services_medication_checks->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_medication_checks->count());
    }

    public function users_diseases()
    {
        $emergency_services_medications = EmergencyServicesMedications::where('IdEmergencyServicesMedications', $this->IdEmergencyServicesMedications)->select('medicines.IdMedicationActivePrinciples', 'emergency_services.IdUsers', 'medicines.title')->
        join('medicines', 'emergency_services_medications.IdMedicines', '=', 'medicines.IdMedicines')->
        join('emergency_services', 'emergency_services_medications.IdEmergencyServices', '=', 'emergency_services.IdEmergencyServices')->first();

        return UsersDiseases::whereIn('IdMedicationActivePrinciples', explode(',', $emergency_services_medications->IdMedicationActivePrinciples))->where('IdUsers', $emergency_services_medications->IdUsers)->count();
    }
}
