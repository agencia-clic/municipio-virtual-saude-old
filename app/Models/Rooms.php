<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Rooms extends Model
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
        'initials',
        'IdAccommodations',
        'IdFunctionalUnits',
        'capacity',
        'determining_sex',
        'international_exclusive',
        'IdServiceUnits',
    ];

    protected $primaryKey = 'IdRooms';

    public function list($filter)
    {
        $rooms = DB::table('rooms')->select('rooms.*', 'functional_units.title as functional_units')->where('rooms.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->
        leftjoin('functional_units', 'rooms.IdFunctionalUnits', '=', 'functional_units.IdFunctionalUnits');

        if($filter['IdRooms']):
            $rooms = $rooms->where('IdRooms', $filter['IdRooms']);
        endif;

        if($filter['status']):
            $rooms = $rooms->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $rooms = $rooms->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $rooms->paginate(env('PAGE_NUMBER')), "count" => $rooms->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('rooms')->where('IdRooms', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Rooms::where('status', 'a')->get();
    }
}
