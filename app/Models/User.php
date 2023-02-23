<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cookie;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'social_name',
        'email',
        'cpf_cnpj',
        'password',
        'level',
        'status',
        'cell',
        'phone',
        'crm',
        'cns',
        'uf_crm',
        'rg',
        'uf_rg',
        'date_birth',
        'zip_code',
        'address',
        'number',
        'district',
        'city',
        'uf',
        'uf_naturalness',
        'api_token',
        'naturalness',
        'origin',
    ];

    protected $primaryKey = 'IdUsers';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function list($filter)
    {
        $users = DB::table('users')->where('level', '<>', 'p');

        if(auth()->user()->level != "s"):
            $users->where('level', '<>', 's');
        endif;

        if((!empty($filter['module'])) AND $filter['module']):
            $users->whereNotNull('crm');
        else:
            $users->whereNull('crm');
        endif;

        if((!empty($filter['IdUsers'])) and $filter['IdUsers']):
            $users->where('IdUsers', $filter['IdUsers']);
        endif;

        if((!empty($filter['level']) and $filter['level'])):
            $users->where('level', $filter['level']);
        endif;

        if((!empty($filter['status'])) AND $filter['status']):
            $users->where('status', $filter['status']);
        endif;

        if((!empty($filter['name'])) AND $filter['name']):
            $users->where('name', 'LIKE', "{$filter['name']}%");
        endif;

        if((!empty($filter['cpf_cnpj'])) AND $filter['cpf_cnpj']):
            $users->where('cpf_cnpj', 'LIKE', preg_replace('/[^0-9]/', '', $filter['cpf_cnpj'])."%");
        endif;

        return $users->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('users')->where('IdUsers', $id)->first();
        endif;
    }

    //existe
    public function existe_cpf($cpf_cnpj, $cpf_current)
    {
        return (!empty($cpf_cnpj)) && $cpf_cnpj != $cpf_current
            ?  DB::table('users')->where('cpf_cnpj', $cpf_cnpj)->doesntExist()
            : true;
    }

    //existe
    public function existe_email($email, $email_current)
    {
        return (!empty($email)) && $email != $email_current
            ?  DB::table('users')->where('email', $email)->doesntExist()
            : true;
    }

    //query
    public function query_select($res)
    {
        $users = User::where('visible', 'y')->limit(env('PAGE_NUMBER'));

        if(!empty(array_key_exists('id', $res))):
            return array('data' => $users->where('IdUsers', $res['id'])->get(), 'count' => $users->count());
        endif;

        if(!empty($res['user_letter'])):
            $users->where('name', 'LIKE', "{$res['user_letter']}%");
        endif;

        if(!empty($res['user_name'])):
            $users->where('name', 'LIKE', "%{$res['user_name']}%");
        endif;

        if(!empty($res['user_mother'])):
            $users->where('mother', 'LIKE', "%{$res['user_mother']}%");
        endif;

        if(!empty($res['user_date_birth'])):
            $users->where('date_birth', date('Y-m-d', strtotime($res['user_date_birth'])));
        endif;

        if(!empty($res['user_cpf_cnpj'])):
            $users->where('cpf_cnpj', 'LIKE', preg_replace('/[^0-9]/', '', $res['user_cpf_cnpj'])."%");
        endif;

        if(!empty($res['user_phone'])):
            $users->where('phone', 'LIKE', preg_replace('/[^0-9]/', '', $res['user_phone'])."%");
        endif;

        if(!empty($res['user_email'])):
            $users->where('phone', 'LIKE', "{$res['user_email']}%");
        endif;

        if(!empty($res['user_cns'])):
            $users->where('cns', 'LIKE', "{$res['user_cns']}%");
        endif;

        return array('data' => $users->get(), 'count' => $users->count());
    }

    public function units()
    {
        $units = $this->hasOne(UsersServiceUnits::class, 'IdUsers')->select('service_units.name', 'service_units.acronym', 'service_units.IdServiceUnits')->join('service_units', 'users_service_units.IdServiceUnits', '=', 'service_units.IdServiceUnits');
        return (object) array('data' => $units->get(), 'count' => $units->count());    
    }

    public function units_current()
    {
        $unit = $this->hasOne(UsersServiceUnits::class, 'IdUsers')->select('service_units.name', 'service_units.acronym', 'service_units.IdServiceUnits', 'IdUsersServiceUnits')->join('service_units', 'users_service_units.IdServiceUnits', '=', 'service_units.IdServiceUnits');

        if(Cookie::has('IdServiceUnits')):
            $unit->where('users_service_units.IdServiceUnits', Cookie::get('IdServiceUnits'));
        endif;

        return $unit->first();
    }

    //specialties care count
    public function specialties_care_count()
    {
        return $this->hasOne(UsersMedicalSpecialties::class, 'IdUsers')->
        where('medical_specialties.status', 'a')->
        join('medical_specialties', 'users_medical_specialties.IdMedicalSpecialties', '=', 'medical_specialties.IdMedicalSpecialties')->count();
    }

    public function specialty_users($IdUsers)
    {
        if(!empty($IdUsers)):
            return UsersMedicalSpecialties::where('IdUsers', $IdUsers)->select('medical_specialties.title')->
            join('medical_specialties', 'users_medical_specialties.IdMedicalSpecialties', '=', 'medical_specialties.IdMedicalSpecialties')->
            get(); 
        endif;
    }

    //specialties care count
    public function specialties_care_array()
    {
        $specialties_care = $this->hasOne(UsersMedicalSpecialties::class, 'IdUsers')->select('IdMedicalSpecialties')->get();
        $data = array();

        if(!empty($specialties_care)):
            foreach ($specialties_care as $val):
                $data[] = $val['IdMedicalSpecialties'];
            endforeach;
        endif;

        return $data;
    }
}
