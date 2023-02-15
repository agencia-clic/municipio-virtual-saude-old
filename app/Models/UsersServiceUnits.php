<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class UsersServiceUnits extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdUsers',
        'IdServiceUnits',
        'status',
    ];

    protected $primaryKey = 'IdUsersServiceUnits';

    public function list($IdUsers)
    {
        $users_service_units = UsersServiceUnits::select('users_service_units.*', 'service_units.name as units')->join('service_units', 'users_service_units.IdServiceUnits', '=', 'service_units.IdServiceUnits')->where('users_service_units.IdUsers', $IdUsers);

        return array("data" => $users_service_units->paginate(env('PAGE_NUMBER')), "count" => $users_service_units->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return UsersServiceUnits::where('IdUsersServiceUnits', $id)->first();
        endif;
    }

    public function roles()
    {
        $data = array();
        foreach ($this->hasOne(ServiceUnitsRoles::class, 'IdUsersServiceUnits')->select('route')->get()->toArray() as $val):
            $data[] = $val['route'];
        endforeach;
        return $data;
    }
}
