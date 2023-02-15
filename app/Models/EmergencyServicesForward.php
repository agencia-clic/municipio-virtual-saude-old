<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesForward extends Model
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
        'IdProcedures',
        'IdSpecialtyCategories',
        'note',
    ];

    protected $primaryKey = 'IdEmergencyServicesForward';
    protected $table = "emergency_services_forward";

    public function list($IdEmergencyServices)
    {
        $emergency_services_forward = EmergencyServicesForward::where('emergency_services_forward.IdEmergencyServices', $IdEmergencyServices)->


        select('emergency_services_forward.*', 

        'specialty_categories.title as specialty', 'specialty_categories.categorie', 

        'procedures.title as procedures', 'procedures.code', 'users_responsible.name as responsible')->

        leftjoin('users as users_responsible', 'emergency_services_forward.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        leftjoin('procedures', 'emergency_services_forward.IdProcedures', '=', 'procedures.IdProcedures')->
        leftjoin('specialty_categories', 'emergency_services_forward.IdSpecialtyCategories', '=', 'specialty_categories.IdSpecialtyCategories');
        
        return array("data" => $emergency_services_forward->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_forward->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return EmergencyServicesForward::where('IdEmergencyServicesForward', $id)->select('emergency_services_forward.*', 'specialty_categories.title as specialty', 'specialty_categories.title as categories', 'procedures.title as procedures', 'procedures.code', 'users_responsible.name as responsible')->
            leftjoin('users as users_responsible', 'emergency_services_forward.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
            leftjoin('procedures', 'emergency_services_forward.IdProcedures', '=', 'procedures.IdProcedures')->
            leftjoin('specialty_categories', 'emergency_services_forward.IdSpecialtyCategories', '=', 'specialty_categories.IdSpecialtyCategories')->first();
        endif;
    }
}
