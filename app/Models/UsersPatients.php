<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cookie;
use DB;

class UsersPatients extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'cpf_cnpj',
        'level',
        'status',
        'cell',
        'phone',
        'crm',
        'crn',
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
        'naturalness',
        'origin',
        'mother',
        'complement',
        'voter_registration',
        'cns',
        'breed',
        'sex',
        'sanguine',
        'marital_status',
        'schooling',
        'occupation',
    ];

    protected $primaryKey = 'IdUsers';
    protected $table = "users";

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

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('users')->where('IdUsers', $id)->first();
        endif;
    }

    public function list($filter)
    {
        $users = DB::table('users')->whereExists(function ($query) {
            $query->select(DB::raw(1))->from('emergency_services')->where('emergency_services.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->whereColumn('emergency_services.IdUsers', 'users.IdUsers');
        });

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
}
