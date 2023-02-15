<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class UsersMedicalSpecialties extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdUsers',
        'IdMedicalSpecialties',
        'status',
    ];

    protected $primaryKey = 'IdUsersMedicalSpecialties';

    public function list($IdUsers)
    {
        $users_medical_specialties = UsersMedicalSpecialties::select('users_medical_specialties.*', 'medical_specialties.title as specialties', 'medical_specialties.code')->join('medical_specialties', 'users_medical_specialties.IdMedicalSpecialties', '=', 'medical_specialties.IdMedicalSpecialties')->where('users_medical_specialties.IdUsers', $IdUsers);

        return array("data" => $users_medical_specialties->paginate(env('PAGE_NUMBER')), "count" => $users_medical_specialties->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('users_medical_specialties')->where('IdUsersMedicalSpecialties', $id)->first();
        endif;
    }

    //existe
    public function existe_email($email, $email_current)
    {
        return (!empty($email)) && $email != $email_current
            ?  DB::table('users_medical_specialties')->where('email', $email)->doesntExist()
            : true;
    }
}
