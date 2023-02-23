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
        $emergency_services_forward_internal = DB::table('view_emergency_services_forward_internal');
        return $emergency_services_forward_internal->paginate(env('PAGE_NUMBER'));
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
