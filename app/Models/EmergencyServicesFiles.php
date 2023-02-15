<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class EmergencyServicesFiles extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServices',
        'title',
        'IdUsersResponsible',
        'description',
        'path',
    ];

    protected $primaryKey = 'IdEmergencyServicesFiles';

    public function list($id)
    {
        $emergency_services_files = EmergencyServicesFiles::where('IdEmergencyServices', $id)->
        select('emergency_services_files.*', 'users_responsible.name as responsible')->
        leftjoin('users as users_responsible', 'emergency_services_files.IdUsersResponsible', '=', 'users_responsible.IdUsers');

        return array("data" => $emergency_services_files->paginate(env('PAGE_NUMBER')), "count" => $emergency_services_files->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('emergency_services_files')->where('IdEmergencyServicesFiles', $id)->first();
        endif;
    }
}
