<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Screenings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServices',
        'IdFlowcharts',
        'IdServiceUnits',
        'IdUsers',
        'IdUsersResponsible',
        'IdMedicalSpecialties',
        'type',
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
        'condition_hypertensive',
        'condition_diabetic',
        'condition_heart_disease',
        'condition_pregnant',
        'gestational_age',
        'complaints',
        'IdServiceUnitsForwarding',
        'forwarding_reason',
        'discharge_reason',
        'classification',
        'IdUsersResponsibleScreenings',
        'breathing_type',
        'allergic_reactions',
    ];

    protected $primaryKey = 'IdScreenings';

    public function list($filter)
    {
        $screenings = DB::table('screenings')->select('screenings.*', 'medical_specialties.title as specialties', 'users_responsible.name as responsible')
        ->leftjoin('users as users_responsible', 'screenings.IdUsersResponsible', '=', 'users_responsible.IdUsers')
        ->leftjoin('medical_specialties', 'screenings.IdMedicalSpecialties', '=', 'medical_specialties.IdMedicalSpecialties');

        if(!empty($filter['IdScreenings'])):
            $screenings = $screenings->where('IdScreenings', $filter['IdScreenings']);
        endif;

        if(!empty($filter['IdEmergencyServices'])):
            $screenings = $screenings->where('IdEmergencyServices', $filter['IdEmergencyServices']);
        endif;

        if(!empty($filter['status'])):
            $screenings = $screenings->where('status', $filter['status']);
        endif;

        if(!empty($filter['title'])):
            $screenings = $screenings->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return $screenings->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('screenings')->where('IdScreenings', $id)->select('screenings.*', 'users_responsible.name as responsible')->leftjoin('users as users_responsible', 'screenings.IdUsersResponsible', '=', 'users_responsible.IdUsers')->first();
        endif;
    }

    public function list_select()
    {
        return Screenings::where('status', 'a')->get();
    }
}
