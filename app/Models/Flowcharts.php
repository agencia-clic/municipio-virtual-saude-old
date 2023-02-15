<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Flowcharts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'status',
    ];

    protected $primaryKey = 'IdFlowcharts';

    public function list($filter)
    {
        $flowcharts = DB::table('flowcharts');

        if(!empty($filter['IdFlowcharts']) AND $filter['IdFlowcharts']):
            $flowcharts = $flowcharts->where('IdFlowcharts', $filter['IdFlowcharts']);
        endif;

        if((!empty($filter['status'])) AND $filter['status']):
            $flowcharts = $flowcharts->where('status', $filter['status']);
        endif;

        if((!empty($filter['title'])) AND $filter['title']):
            $flowcharts = $flowcharts->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $flowcharts->paginate(env('PAGE_NUMBER')), "count" => $flowcharts->count());
    }

    public function count_user_units()
    {
        return $this->hasOne(FlowchartsUsers::class, 'IdFlowcharts')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->where('status', 'a')->count();
    }

    public static function menu()
    {
        return Flowcharts::select('flowcharts.title', 'flowcharts.IdFlowcharts')->join('flowcharts_service_units', 'flowcharts.IdFlowcharts', 'flowcharts_service_units.IdFlowcharts')->
        where('flowcharts_service_units.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->where('flowcharts_service_units.status', 'a')->get();
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('flowcharts')->where('IdFlowcharts', $id)->first();
        endif;
    }
}
