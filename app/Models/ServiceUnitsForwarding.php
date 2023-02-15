<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class ServiceUnitsForwarding extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdServiceUnits',
        'IdServiceUnitsReceive',
    ];

    protected $primaryKey = 'IdServiceUnitsForwarding';
    protected $table = "service_units_forwarding";

    public function list($IdServiceUnits)
    {
        $service_units_forwarding = ServiceUnitsForwarding::select('service_units_forwarding.*', 'service_units.name as units')->join('service_units', 'service_units_forwarding.IdServiceUnitsReceive', '=', 'service_units.IdServiceUnits')->where('service_units_forwarding.IdServiceUnits', $IdServiceUnits);

        return array("data" => $service_units_forwarding->paginate(env('PAGE_NUMBER')), "count" => $service_units_forwarding->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return ServiceUnitsForwarding::where('IdServiceUnitsForwarding', $id)->first();
        endif;
    }
}
