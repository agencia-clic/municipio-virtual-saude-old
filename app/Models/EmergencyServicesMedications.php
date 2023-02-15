<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesMedications extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServices',
        'IdMedicines',
        'IdUsersResponsible',
        'IdMedicationGroups',
        'status',
        'type',
        'break',
        'IdMedicines',
        'IdMedicationAdministrations',
        'IdMedicationUnits',
        'IdMedicationDilutions',
        'infusao',
        'number_time_day',
        'guidance',
        'amount',
        'un_measure',
    ];

    protected $primaryKey = 'IdEmergencyServicesMedications';

    public function list($IdEmergencyServices, $IdMedicationGroups, $data = [])
    {
        $emergency_services_medications = EmergencyServicesMedications::select('emergency_services_medications.*', 'medication_units.title as units', 'medicines.title as medicines', 'medication_administrations.title as administrations', 'medication_dilutions.title as dilutions')->
        join('medicines', 'emergency_services_medications.IdMedicines', '=', 'medicines.IdMedicines')->
        join('medication_units', 'medicines.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->

        leftjoin('medication_administrations', 'emergency_services_medications.IdMedicationAdministrations', '=', 'medication_administrations.IdMedicationAdministrations')->
        leftjoin('medication_dilutions', 'emergency_services_medications.IdMedicationDilutions', '=', 'medication_dilutions.IdMedicationDilutions')->
        where('emergency_services_medications.IdEmergencyServices', $IdEmergencyServices);

        $emergency_services_medications = $emergency_services_medications->where('IdMedicationGroups', $IdMedicationGroups);

        if(!empty($data['status'])):
            $emergency_services_medications->where('emergency_services_medications.status', $data['status']);
        endif;

        return array("data" => $emergency_services_medications->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_medications->count());
    }

    public function checks_next_date()
    {
        $emergency_services_medication_checks = $this->hasOne(EmergencyServicesMedicationChecks::class, 'IdEmergencyServicesMedications')->
        select(DB::raw('(SELECT DATE_ADD(emergency_services_medication_checks.created_at, INTERVAL TIME_TO_SEC(emergency_services_medications.break) second)) as next_run'))->
        join('emergency_services_medications', 'emergency_services_medication_checks.IdEmergencyServicesMedications', '=', 'emergency_services_medications.IdEmergencyServicesMedications')->limit(1)->
        orderby('IdEmergencyServicesMedicationChecks', 'DESC')->first();
        return $emergency_services_medication_checks->next_run ?? null;
    }

    public function users_diseases()
    {
        $emergency_services_medications = EmergencyServicesMedications::where('IdEmergencyServicesMedications', $this->IdEmergencyServicesMedications)->select('medicines.IdMedicationActivePrinciples', 'emergency_services.IdUsers', 'medicines.title')->
        join('medicines', 'emergency_services_medications.IdMedicines', '=', 'medicines.IdMedicines')->
        join('emergency_services', 'emergency_services_medications.IdEmergencyServices', '=', 'emergency_services.IdEmergencyServices')->first();
        return UsersDiseases::whereIn('IdMedicationActivePrinciples', explode(',', $emergency_services_medications->IdMedicationActivePrinciples))->where('IdUsers', $emergency_services_medications->IdUsers)->count();
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return EmergencyServicesMedications::select('emergency_services_medications.*', 'medication_units.title as units', 'medicines.title as medicines', 'medication_administrations.title as administrations', 'medication_dilutions.title as dilutions', 'users_responsible.name as responsible')->
            join('medicines', 'emergency_services_medications.IdMedicines', '=', 'medicines.IdMedicines')->
            join('medication_units', 'medicines.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->

            leftjoin('users as users_responsible', 'emergency_services_medications.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
            leftjoin('medication_administrations', 'emergency_services_medications.IdMedicationAdministrations', '=', 'medication_administrations.IdMedicationAdministrations')->
            leftjoin('medication_dilutions', 'emergency_services_medications.IdMedicationDilutions', '=', 'medication_dilutions.IdMedicationDilutions')->first();
        endif;
    }
}
