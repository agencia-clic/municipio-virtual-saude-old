<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesMaterials extends Model
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
        'IdMaterials',
        'status',
        'note',
        'amount',
    ];

    protected $primaryKey = 'IdEmergencyServicesMaterials';

    public function list($IdEmergencyServices)
    {
        $emergency_services_materials = DB::table('emergency_services_materials')->
        select('emergency_services_materials.*', 'materials.title as materials', 'materials.code', 'users_responsible.name as responsible')->
        leftjoin('materials', 'emergency_services_materials.IdMaterials', '=', 'materials.IdMaterials')->
        join('users as users_responsible', 'emergency_services_materials.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        where('emergency_services_materials.IdEmergencyServices', $IdEmergencyServices);

        return array("data" => $emergency_services_materials->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_materials->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('emergency_services_materials')->where('IdEmergencyServicesMaterials', $id)->first();
        endif;
    }
}
