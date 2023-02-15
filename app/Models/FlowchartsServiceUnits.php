<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class FlowchartsServiceUnits extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdFlowcharts',
        'IdServiceUnits',
        'status',
    ];

    protected $primaryKey = 'IdFlowchartsServiceUnits';

    public function list()
    {
        return FlowchartsServiceUnits::where('flowcharts_service_units.status', 'a')->where('flowcharts_service_units.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->select('flowcharts_service_units.*', 'flowcharts.title')->
        join('flowcharts', 'flowcharts_service_units.IdFlowcharts', '=', 'flowcharts.IdFlowcharts')->get();
    }

    public function count()
    {
        return $this->hasOne(FlowchartsUsers::class, 'IdFlowchartsServiceUnits')->where('status', 'a')->count();
    }

    public function users()
    {
        return $this->hasOne(FlowchartsUsers::class, 'IdFlowchartsServiceUnits')->where('flowcharts_users.status', 'a')->select('flowcharts_users.*', 'users.name')->join('users', 'flowcharts_users.IdUsers', '=', 'users.IdUsers')->get();
    }
}