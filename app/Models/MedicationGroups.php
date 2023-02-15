<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicationGroups extends Model
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
    ];

    protected $primaryKey = 'IdMedicationGroups';

    public function list($IdEmergencyServices)
    {
        $medication_groups = MedicationGroups::select('medication_groups.*', 'users_responsible.name as responsible')->
        leftjoin('users as users_responsible', 'medication_groups.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        where('medication_groups.IdEmergencyServices', $IdEmergencyServices);

        return array("data" => $medication_groups->paginate(env('PAGE_NUMBER')), "count" => $medication_groups->count());
    }

    public function list_check($IdEmergencyServices)
    {
        $medication_groups = MedicationGroups::select('medication_groups.*', 'users_responsible.name as responsible')->
        leftjoin('users as users_responsible', 'medication_groups.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        join('emergency_services_medications', 'medication_groups.IdMedicationGroups', '=', 'emergency_services_medications.IdMedicationGroups')->
        where('emergency_services_medications.status', "a")->
        where('medication_groups.IdEmergencyServices', $IdEmergencyServices)->groupBy('medication_groups.IdMedicationGroups');

        return array("data" => $medication_groups->paginate(env('PAGE_NUMBER')), "count" => $medication_groups->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medication_groups')->where('IdMedicationGroups', $id)->select('medication_groups.*', 'users_responsible.name as responsible')->
            leftjoin('users as users_responsible', 'medication_groups.IdUsersResponsible', '=', 'users_responsible.IdUsers')->first();
        endif;
    }

    public function medication_wait($status = "a")
    {
        return $this->hasOne(EmergencyServicesMedications::class, 'IdMedicationGroups')->where('status', $status)->count();
    }

    public function check_next()
    {
        return DB::table('view_emergency_services_medications_num_checkeds')->where('IdMedicationGroups', $this->IdMedicationGroups)->orderByRaw('CASE WHEN num_check = 0 THEN num_check END DESC, CASE WHEN next_run < now() THEN num_check END DESC')->first();
    }
}
