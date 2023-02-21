<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class ServiceUnits extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'acronym',
        'IdUsers',
        'email',
        'status',
        'phone',
        'zip_code',
        'address',
        'number',
        'district',
        'city',
        'uf',
    ];

    protected $primaryKey = 'IdServiceUnits';

    public function list($filter)
    {
        $service_units = DB::table('service_units')->select('service_units.*', 'users.name as responsible')->leftjoin('users', 'service_units.IdUsers', '=', 'users.IdUsers');

        if($filter['IdServiceUnits']):
            $service_units = $service_units->where('IdServiceUnits', $filter['IdServiceUnits']);
        endif;

        if($filter['status']):
            $service_units = $service_units->where('status', $filter['status']);
        endif;

        if($filter['name']):
            $service_units = $service_units->where('name', "LIKE", "{$filter['name']}%");
        endif;

        if($filter['email']):
            $service_units = $service_units->where('email', $filter['email']);
        endif;

        return $service_units->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('service_units')->where('IdServiceUnits', $id)->first();
        endif;
    }
    
    //existe
    public function existe_email($email, $email_current)
    {
        return (!empty($email)) && $email != $email_current
            ?  DB::table('service_units')->where('email', $email)->doesntExist()
            : true;
    }
}
