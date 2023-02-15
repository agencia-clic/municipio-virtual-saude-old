<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class CallPanel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'IdServiceUnits',
        'status',
    ];

    protected $primaryKey = 'IdCallPanel';
    protected $table = "call_panel";

    public function list($filter)
    {
        $call_panel = DB::table('call_panel');

        if($filter['IdCallPanel']):
            $call_panel = $call_panel->where('IdCallPanel', $filter['IdCallPanel'])->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);
        endif;

        if($filter['status']):
            $call_panel = $call_panel->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $call_panel = $call_panel->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $call_panel->paginate(env('PAGE_NUMBER')), "count" => $call_panel->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('call_panel')->where('IdCallPanel', $id)->first();
        endif;
    }

    public function list_select()
    {
        return CallPanel::where('status', 'a')->get();
    }
}
