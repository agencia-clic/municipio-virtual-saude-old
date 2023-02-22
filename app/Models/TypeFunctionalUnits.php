<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class TypeFunctionalUnits extends Model
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
        'IdServiceUnits',
    ];

    protected $primaryKey = 'IdTypeFunctionalUnits';

    public function list($filter)
    {
        $type_functional_units = DB::table('type_functional_units')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);

        if($filter['IdTypeFunctionalUnits']):
            $type_functional_units = $type_functional_units->where('IdTypeFunctionalUnits', $filter['IdTypeFunctionalUnits']);
        endif;

        if($filter['status']):
            $type_functional_units = $type_functional_units->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $type_functional_units = $type_functional_units->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return $type_functional_units->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('type_functional_units')->where('IdTypeFunctionalUnits', $id)->first();
        endif;
    }

    public function list_select()
    {
        return TypeFunctionalUnits::where('status', 'a')->get();
    }
}
