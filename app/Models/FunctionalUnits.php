<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class FunctionalUnits extends Model
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
        'capacity',
        'IdBeds',
        'IdClinics',
        'sector',
        'IdTypeFunctionalUnits',
        'IdServiceUnits',
    ];

    protected $primaryKey = 'IdFunctionalUnits';

    public function list($filter)
    {
        $functional_units = DB::table('functional_units')->select('functional_units.*', 'type_functional_units.title as type_unit', 'beds.title as bads')->where('type_functional_units.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->
        leftjoin('type_functional_units', 'functional_units.IdTypeFunctionalUnits', '=', 'type_functional_units.IdTypeFunctionalUnits')->
        leftjoin('beds', 'functional_units.IdBeds', '=', 'beds.IdBeds');

        if($filter['IdFunctionalUnits']):
            $functional_units = $functional_units->where('IdFunctionalUnits', $filter['IdFunctionalUnits']);
        endif;

        if($filter['status']):
            $functional_units = $functional_units->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $functional_units = $functional_units->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return $functional_units->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('functional_units')->where('IdFunctionalUnits', $id)->first();
        endif;
    }

    public function list_select()
    {
        return FunctionalUnits::where('status', 'a')->get();
    }
}
